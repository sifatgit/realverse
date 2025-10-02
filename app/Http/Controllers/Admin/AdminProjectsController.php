<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Project;
use App\Models\Floor;
use App\Models\Unit;
use App\Models\City;
use App\Models\Area;


class AdminProjectsController extends Controller
{
    public function index(){

        $projects = Project::orderBy('id','desc')->get();
        return view('backend.admin.pages.projects.index',compact('projects'));
    }

    public function floors($id){

        $floors = Floor::where('project_id',$id)->orderBy('id','desc')->get();
        $project = Project::find($id);

        return view('backend.admin.pages.projects.project_floors',compact('floors','project'));
    }

    public function units($id){

        $units = Unit::where('project_id',$id)->orderBy('id','desc')->get();
        $project = Project::find($id);

        return view('backend.admin.pages.projects.project_units',compact('units','project'));
    }



    public function city_find($id){

        $cities = City::where('state_id',$id)->get();

        $cities_html = view('backend.admin.renders.cities',compact('cities'))->render();

        return response()->json(['cities_html' => $cities_html,]);
    }

    public function area_find($id){

        $areas = Area::where('city_id',$id)->get();

        $areas_html = view('backend.admin.renders.areas',compact('areas'))->render();

        return response()->json(['areas_html' => $areas_html,]);
    }

    public function store(Request $request){
        
    try {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:projects,code',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,svg',
            'address_line' => 'required|string|max:255',
            'state_id' => 'required|integer|exists:states,id',
            'city_id' => 'required|integer|exists:cities,id',
            'area_id' => 'required|integer|exists:areas,id',
            'postal_code' => 'required|integer',
            'floors' => 'required|integer|min:2',
            'units' => 'required|integer|min:1',
            'total_area_rounded_sqft' => 'required|integer|min:2000',
            'total_building_area' => 'required|integer|min:1800',
            'common_area' => 'required|integer|min:180',
            'net_area' => 'required|integer|min:1620',
            'contact' => 'required|string|max:20',
            'status' => 'required|string|max:255',
            'features' => 'array',
            'features.*' => 'nullable',
            'is_sold_out' => 'required|integer',
        ]);

        $validator->after(function ($validator) use ($request) {
            $units = $request->input('units');
            $netArea = $request->input('net_area');

            if ($units && $netArea && ($netArea / $units) < 800) {
                $maxUnits = floor($netArea / 800);
                $minArea = $units * 800;

                $validator->errors()->add('units', "Maximum {$maxUnits} units allowed for {$netArea} sqft of area.");
                $validator->errors()->add('net_area', "Minimum {$minArea} sqft required for {$units} units.");
            }
        });

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

    } catch (ValidationException $e) {
        if ($request->ajax()) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

    // Continue your logic...
    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }

        $project = new Project;

        $project->name = $request->name;        
        $project->code = $request->code;        
        $project->description = $request->description;
        $project->address_line = $request->address_line;
        $project->state_id = $request->state_id;
        $project->city_id = $request->city_id;
        $project->area_id = $request->area_id;
        $project->postal_code = $request->postal_code;
        $project->floors = $request->floors;
        $project->units = $request->units;
        $project->total_area_rounded_sqft = $request->total_area_rounded_sqft;
        $project->total_building_area = $request->total_building_area;
        $project->common_area = $request->common_area;
        $project->net_area = $request->net_area;
        $project->contact = $request->contact;
        $project->status = $request->status;
        $project->features = $request->features ?? [];
        $project->is_sold_out = $request->is_sold_out;

        $image = $request->file('image');

        if($image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='admin/images/projects/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $project->image = $image_url;

        }

        $project->save();

       

        return back()->with('success','Project entered successfully!');        

    }

    public function update(Request $request,$id){

    try{

       
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,webp,svg', // Adjust as needed
            'address_line' => 'required|string|max:255',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'area_id' => 'required|integer',
            'postal_code' => 'required|integer|min:1',
            'floors' => 'required|integer|min:1',
            'units' => 'required|integer|min:1',
            'total_area_rounded_sqft' => 'required|integer|min:2000',
            'total_building_area' => 'required|integer|min:1800',
            'common_area' => 'required|integer|min:180',
            'net_area' => 'required|integer|min:1620',            
            'contact' => 'required|string|max:20',
            'status' => 'required|string|max:255',
            'features' => 'array',
            'features.*' => 'nullable',
            'is_sold_out' => 'required|integer',
        ]);

    }
        catch (ValidationException $e) {

        // For API or custom error response
            if($request->ajax()){
                return response()->json([
                    'errors' => $e->errors()
                ], 422);                
            }
        
        }
        
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }        

        $project = Project::find($id);

        $project->name = $request->name;        
        $project->code = $request->code;        
        $project->description = $request->description;
        $project->address_line = $request->address_line;
        $project->state_id = $request->state_id;
        $project->city_id = $request->city_id;
        $project->area_id = $request->area_id;
        $project->postal_code = $request->postal_code;

        if($request->floors < $project->floors){

            $extra_floors = $project->floors - $request->floors;

            if(count($project->floorslist) > $request->floors){

                $project->floorslist()->orderBy('floor','desc')->limit($extra_floors)->delete();    
            }

            


        }

        $project->floors = $request->floors;

        if($request->units < $project->units){

            $extra_units = $project->units - $request->units;

                    foreach ($project->floorslist as $floor) {
                            
                            if($floor->units > $request->units){
                                $floor->units = $request->units;
                                $floor->save();

                                if(count($floor->unitslist) > $request->units){

                                    $units_to_delete = count($floor->unitslist) - $request->units;
                                    $floor->unitslist()->orderBy('id','desc')->limit($units_to_delete)->delete();

                                  

                                }
                                    $units = $floor->unitslist;
                                    foreach($units as $unit){
                                        $unit->area_sqft = $project->net_area/$request->units;
                                        $unit->save();
                                    }                                  
                            }

                            

                   
                }
                
            


        }

        $project->units = $request->units;
        $project->total_area_rounded_sqft = $request->total_area_rounded_sqft;
        
        if($request->total_building_area !== $project->total_building_area){

            $new_net_area = $request->total_building_area * 0.90;

            foreach($project->floorslist as $floor){

                $per_unit_area = $new_net_area/$floor->units;
                foreach($floor->unitslist as $unit){

                    $unit->area_sqft = $per_unit_area;
                    $unit->save();

                }
            }
        $project->total_building_area = $request->total_building_area;     
        $project->common_area = $request->total_building_area * 0.10;
        $project->net_area = $new_net_area;    
   

        }

        else{

            $project->total_building_area = $request->total_building_area;
            $project->common_area = $request->common_area;
            $project->net_area = $request->net_area;             
        }

        
        $project->contact = $request->contact;
        $project->status = $request->status;
        $project->features = $request->features ?? [];
        $project->is_sold_out = $request->is_sold_out;

        $image = $request->file('image');

        if($image){

            unlink($project->image);

            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='admin/images/projects/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $project->image = $image_url;

        }

        $project->save();

        return back()->with('success','Project entered successfully!');        
        
    }

    public function delete($id){

        $project = Project::find($id);

        $project->delete();

        return back()->with('success','Project removed successfully!');

    }


    public function deleteall(){

        $projects = Project::all();

        $projects->each->delete();  // Will fire deleting/deleted and can cascade if set


        return back()->with('success','Entire project table terminated successfully!');

    }    
}
