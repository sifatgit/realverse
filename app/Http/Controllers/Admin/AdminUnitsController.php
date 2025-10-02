<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Unit;
use App\Models\Floor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Rate;



class AdminUnitsController extends Controller
{
    public function index(){

        $units = Unit::orderBy('id','desc')->paginate(50);

        return view('backend.admin.pages.projects.floors.units.index',compact('units'));
    }

    public function floor_find($id){

        $floors = Floor::where('project_id',$id)->where('floor', '>', 0)->get();

        $floors_html = view('backend.admin.renders.floors',compact('floors'))->render();


        return response()->json(['floors_html' => $floors_html]);
    }

    public function area_find($id){

        $floor = Floor::find($id);

        $total_units = count($floor->unitslist);
        $floor_units = $floor->units;

        if(($floor_units - $total_units) == 1){

        $area = 0;

        foreach($floor->unitslist as $units) {

            $area+= $units->area_sqft;
        } 

            $maxarea = floor($floor->project->net_area - $area);
            $minarea = floor($maxarea);    

        }

        elseif(($floor_units - $total_units) == 0){

            $maxarea = 0;
            $minarea = 0;

        }

        else{

            $maxarea = floor($floor->project->net_area/$floor->units);
            $minarea = round($maxarea * 0.70);

        }

        return response()->json(['maxarea' => $maxarea, 'minarea' => $minarea]);
        
    }

    public function store(Request $request){


        try{


        $request->validate([
            'project_id' => 'required|integer|exists:projects,id',

            'floor_id' => [
                'required',
                'integer',
                'exists:floors,id',
                function ($attribute, $value, $fail) {
                    $floor = Floor::find($value);

                    if ($floor) {
                        $unitCount = Unit::where('floor_id', $value)->count();

                        if ($unitCount == $floor->units) {
                            $fail("This floor can only have a maximum of {$floor->units} units.");
                        }
                    }
                },
            ],

            'number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('units')->where(function ($query) use ($request) {
                    return $query->where('project_id', $request->project_id);
                }),
            ],
            'living_room' => 'required|integer|min:1',
            'dining_room' => 'required|integer|min:1',
            'bedrooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'balconies' => 'required|integer|min:1',

            'area_sqft' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    $floor = Floor::with(['unitslist', 'project'])->find($request->floor_id);

                    if (!$floor) {
                        $fail('Invalid floor selected.');
                        return;
                    }

                    $total_units = $floor->unitslist->count();
                    $floor_units = $floor->units;

                    $assigned_area = $floor->unitslist->sum('area_sqft');

                    if (($floor_units - $total_units) == 1) {
                        // Last unit – must use remaining area
                        $maxarea = floor($floor->project->net_area - $assigned_area);
                        $minarea = floor($maxarea);
                    } elseif(($floor_units - $total_units) == 0) {

                        $maxarea = 0;
                        $minarea = 0;
                    }
                    else{
                        // Other units – 70% minimum of equal share
                        $maxarea = floor($floor->project->net_area / $floor_units);
                        $minarea = floor($maxarea * 0.70);
                    }

                    if ($maxarea == 0 && $minarea == 0) {
                        $fail("Maximum number of units in this floor exceeded.");
                        return;
                    }                    

                    if ($value < $minarea || $value > $maxarea) {
                        $fail("The area must be between {$minarea} sqft and {$maxarea} sqft for this unit.");
                    }
                }
            ],

            'is_sold' => 'required|boolean',
            'status' => 'required',
            'price' => 'required|integer|min:3000000',
            'handover_date' => 'required|date',
            'payment_plan' => 'required|string|max:255',
            'latitude' => 'nullable|string|unique:units,latitude',
            'longitude' => 'nullable|string|unique:units,longitude',
            'view' => 'nullable|string|max:1000',
            'direction' => [
                'required',
                'string',
                'max:40',
                Rule::unique('units')->where(function ($query) use ($request) {
                    return $query->where('project_id', $request->project_id)
                                 ->where('floor_id', $request->floor);
                }),
            ],
            'image_path' => 'required|array',
            'image_path.*' => 'required|image|mimes:jpeg,png,jpg,webp',
            'video_path' => 'nullable|mimes:mp4,mov,avi,wmv',
            'pdf_path' => 'nullable|mimes:pdf',
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


        $unit = new Unit;

        $unit->project_id = $request->project_id;
        $unit->floor_id = $request->floor_id;
        $unit->number = $request->number;
        $unit->living_room = $request->living_room;
        $unit->dining_room = $request->dining_room;
        $unit->bedrooms = $request->bedrooms;
        $unit->bathrooms = $request->bathrooms;
        $unit->balconies = $request->balconies;
        $unit->area_sqft = $request->area_sqft;
        $unit->is_sold = $request->is_sold;
        $unit->status = $request->status;
        $unit->price = $request->price;
        $unit->handover_date = $request->handover_date;
        $unit->payment_plan = $request->payment_plan;
        $unit->latitude = $request->latitude;
        $unit->longitude = $request->longitude;
        $unit->view = $request->view;
        $unit->direction = strtolower($request->direction);


       $images=array();
        if($files=$request->file('image_path')){
            $i=0;
            foreach($files as $file){
                $name=time().rand(1,99).'.'.$file->extension();
                $fileNameExtract=explode('.',$name);
                $fileName=$fileNameExtract[0];
                $fileName.=$i;
                $fileName.='.';
                $fileName.=$fileNameExtract[1];
                $path = 'admin/images/units/';
                $file->move($path,$fileName);
                $image_url = $path.$fileName;
                $images[]=$image_url;
                $i++;
            }
            $unit['image_path'] = implode("|",$images);
        }

        if ($request->hasFile('video_path')) {
            // Store the video
            $path = $request->file('video_path')->store('videos', 'public'); 
            // 'videos' is the folder inside storage/app/public

            $unit->video_path = 'storage/'.$path;

            }

        if ($request->hasFile('pdf_path')) {
            // Store the video
            $path = $request->file('pdf_path')->store('pdfs', 'public'); 
            // 'videos' is the folder inside storage/app/public

            $unit->pdf_path = 'storage/'.$path;

            }                    


        $unit->save();


        return back()->with('success','Unit stored successfully!');

    }

    public function update(Request $request,$id){

        try{


        $request->validate([
            'old_project_id' => 'required|integer|exists:projects,id',
            'old_floor_id' => 'required','integer','exists:floors,id',
            'number' => 'required|string|max:255',
            'living_room' => 'required|integer|min:1',
            'dining_room' => 'required|integer|min:1',
            'bedrooms' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'balconies' => 'required|integer|min:1',
            'is_sold' => 'required|boolean',
            'status' => 'required',
            'price' => 'required|integer|min:3000000',
            'handover_date' => 'required|date',
            'payment_plan' => 'required|string|max:255',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'view' => 'nullable|string|max:1000',
            'old_direction' => 'required|string|max:40',
            'image_path.*' => 'image|mimes:jpeg,png,jpg,webp',
            'video_path' => 'nullable|mimes:mp4,mov,avi,wmv',
            'pdf_path' => 'nullable|mimes:pdf',
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

        $unit = Unit::find($id);

        $unit->project_id = $request->old_project_id;
        $unit->floor_id = $request->old_floor_id;
        $unit->number = $request->number;
        $unit->living_room = $request->living_room;
        $unit->dining_room = $request->dining_room;
        $unit->bedrooms = $request->bedrooms;
        $unit->bathrooms = $request->bathrooms;
        $unit->balconies = $request->balconies;
        $unit->area_sqft = $request->area_sqft;
        $unit->is_sold = $request->is_sold;
        $unit->status = $request->status;
        $unit->price = $request->price;
        $unit->handover_date = $request->handover_date;
        $unit->payment_plan = $request->payment_plan;
        $unit->latitude = $request->latitude;
        $unit->longitude = $request->longitude;
        $unit->view = $request->view;
        $unit->direction = $request->old_direction;


       $images=array();
        if($files=$request->file('image_path')){
            $i=0;
            foreach($files as $file){
                $name=time().rand(1,99).'.'.$file->extension();
                $fileNameExtract=explode('.',$name);
                $fileName=$fileNameExtract[0];
                $fileName.=$i;
                $fileName.='.';
                $fileName.=$fileNameExtract[1];
                $path = 'admin/images/units/';
                $file->move($path,$fileName);
                $image_url = $path.$fileName;
                $images[]=$image_url;
                $i++;
            }
            $old_images = explode("|",$unit->image_path);
            foreach($old_images as $oldimg){
                unlink($oldimg);
            }
            $unit['image_path'] = implode("|",$images);
        }

        if ($request->hasFile('video_path')) {

            if ($unit->video_path) {
            $pathToDelete = str_replace('storage/', '', $unit->video_path);
            Storage::disk('public')->delete($pathToDelete);
            }

            // Store the video
            $path = $request->file('video_path')->store('videos', 'public'); 
            // 'videos' is the folder inside storage/app/public

            $unit->video_path ='storage/'.$path;

            }

        if ($request->hasFile('pdf_path')) {

            if($unit->pdf_path){
            $pathToDelete = str_replace('storage/', '', $unit->pdf_path);
            Storage::disk('public')->delete($pathToDelete);                
            }


            // Store the pdf
            $path = $request->file('pdf_path')->store('pdfs', 'public'); 
            // 'videos' is the folder inside storage/app/public

            $unit->pdf_path = 'storage/'.$path;

            }             

        $unit->save();


        return back()->with('success','Unit updated successfully!');
    }

    public function viewPDF($id){
        $unit = Unit::findOrFail($id);

    if (!$unit->pdf_path) {
        abort(404);
    }

    // Remove the "storage/" part to get the actual storage path
    $relativePath = str_replace('storage/', '', $unit->pdf_path);

    if (!Storage::disk('public')->exists($relativePath)) {
        abort(404);
    }

    $path = Storage::disk('public')->path($relativePath);
    $filename = basename($path);

    return response()->file($path, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="' . $filename . '"',
        'Cache-Control' => 'private, max-age=0, must-revalidate',
        'Pragma' => 'public',
    ]);


    }
    
    public function ratedunits(){

        $units = Rate::all();

        return view('backend.admin.pages.ratedunits.index',compact('units'));
    }

    public function ratedunitdelete($id){

        $unit = Rate::findOrFail($id);

        $unit->delete();

        return back()->with('success','Rate removed successfully!');
    }

    public function ratedunitsdelete(){

        $units = Rate::all();

        $units->each->delete();

        return back()->with('success','Entire rate table cleared successfully!');

    }

    public function delete($id){


        $unit = Unit::find($id);

        if($unit->image_path){
            if(file_exists($unit->image_path)){
                $images = explode("|",$unit->image_path);
                foreach($images as $img){

                    unlink($img);
                }                
            }

        }

        if ($unit->video_path) {
        $pathToDelete = str_replace('storage/', '', $unit->video_path);
        Storage::disk('public')->delete($pathToDelete);
        }


        if ($unit->pdf_path) {
        $pathToDelete = str_replace('storage/', '', $unit->pdf_path);
        Storage::disk('public')->delete($pathToDelete);
        }

        $unit->delete();

        return back()->with('success','Unit removed successfully!');

        
    }

    public function deleteall(){

        $units = Unit::all();

        $units->each->delete();  // Will fire deleting/deleted and can cascade if set
        
        return back()->with('success','Entire unit table terminated successfully!');

    }    
}
