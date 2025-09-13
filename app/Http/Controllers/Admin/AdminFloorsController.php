<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Floor;
use App\Models\Project;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;

class AdminFloorsController extends Controller
{
    public function index(){

        $floors = Floor::with('project')
                ->orderByDesc('floor')
                ->get();


        // Get the highest floor_number per project
        $topFloors = Floor::select('project_id', DB::raw('MAX(floor) as top_floor'))
            ->groupBy('project_id')
            ->get()
            ->pluck('top_floor', 'project_id')
            ->toArray();

            return view('backend.admin.pages.projects.floors.index',compact('floors','topFloors'));
    
    }

    public function floor_find($id){

        $project = Project::where('id',$id)->first();

        return response()->json(['project' => $project]);
    }

    public function store(Request $request){

    try {
        $request->validate([
            'project_id' => 'required|integer|exists:projects,id',
        ]);

        $project = Project::find($request->project_id);
        $lastFloorNumber = \App\Models\Floor::where('project_id', $project->id)->max('floor');

        $request->validate([
            'floor' => [
                'required',
                'integer',
                'max:' . $project->floors,
                Rule::unique('floors')->where(function ($query) use ($project) {
                    return $query->where('project_id', $project->id);
                }),
                function ($attribute, $value, $fail) use ($lastFloorNumber) {
                    // Allow 0 only if no floors exist yet
                    if (is_null($lastFloorNumber)) {
                        if ((int)$value !== 0) {
                            $fail("The first floor number must be 0 (e.g., for parking).");
                        }
                    } else {
                        // After the first floor (0), next must be sequential
                        if ((int)$value !== $lastFloorNumber + 1) {
                            $fail("The floor number must be " . ($lastFloorNumber + 1) . " to maintain sequential order.");
                        }
                    }
                },
            ],
            'units' => [
                'required',
                'integer',
                'max:' . $project->units,
                'min:1',
            ],
        ], [
            'units.max' => 'The unit number must not be greater than the total units in the project.',
            'floor.max' => 'The floor number must not be greater than the total floors in the project.',
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


        $floor = new Floor;

        $floor->project_id = $request->project_id;               
        $floor->floor = $request->floor;        
        $floor->units = $request->units;

        $floor->save();


        return back()->with('success','Floor stored successfully!');        

    }

    public function update(Request $request,$id){

        try {

            $request->validate([

                'project_id' => 'required|integer',
                'floor' => 'required|integer',
                'units' => 'required|integer|min:1',


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

        $floor = Floor::find($id);

        if($floor->units > $request->units){

            $extra_units = $floor->units - $request->units;
                                if(count($floor->unitslist) > $request->units){

                                    $units_to_delete = count($floor->unitslist) - $request->units;
                                    $floor->unitslist()->orderBy('id','desc')->limit($units_to_delete)->delete();

                                    

                                }

                                    $units = $floor->unitslist;
                                    foreach($units as $unit){
                                        $unit->area_sqft = $floor->project->net_area/$request->units;
                                        $unit->save();
                                    }
        }
        if($floor->units < $request->units){

            $update_units = $request->units;
                                    $units = $floor->unitslist;
                                    foreach($units as $unit){
                                        $unit->area_sqft = $floor->project->net_area/$update_units;
                                        $unit->save();
                                    }
        }

        $floor->units = $request->units;
        $floor->label = $request->label;

        $floor->save();

        return back()->with('success','Floor updated successfully!');
    }

    public function units($id){

        $units = Unit::where('floor_id',$id)->orderBy('id','desc')->get();
        $floor = Floor::find($id);

        return view('backend.admin.pages.projects.floors.floor_units',compact('units','floor'));
    }

    public function delete($id){

        $floor = Floor::find($id);

        $floor->delete();

        return back()->with('success','Floor removed successfully!');

    }

    public function deleteall(){

        $floors = Floor::all();

        $floors->each->delete();  // Will fire deleting/deleted and can cascade if set


        return back()->with('success','Entire floor table terminated successfully!');

    }
}
