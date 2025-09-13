<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;

class AdminStatesController extends Controller
{
    public function index(){

        $states = State::all();

        return view('backend.admin.pages.states.index',compact('states'));

    }

    public function store(Request $request){

        try{
            $request->validate([
                'name' => 'required|string|max:255|unique:states,name',
                'slug' => 'nullable',
                'code' => 'nullable|unique:states,code',
                'description' => 'nullable|string',
                'seo_title' => 'nullable|string',
                'seo_keywords' => 'nullable|string',
                'seo_description' => 'nullable|string',
                'latitude' => 'nullable|string|unique:states,latitude',
                'longitude' => 'nullable|string|unique:states,longitude',
                'google_map_location' => 'nullable|url',
                'priority' => 'required|integer|unique:states,priority|min:1',

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


        $state = new State;

        $state->name = $request->name;
        $state->slug = $request->slug;
        $state->code = $request->code;
        $state->description = $request->description;
        $state->seo_title = $request->seo_title;
        $state->seo_keywords = json_encode(array_map('trim', explode(',', $request->seo_keywords)));
        $state->seo_description = $request->seo_description;
        $state->latitude = $request->latitude;
        $state->longitude = $request->longitude;
        $state->google_map_location = $request->google_map_location;
        $state->priority = $request->priority;

        $state->save();

        return back()->with('success','State entered successfully!');


    }

    public function delete($id){

        $state = State::find($id);

        $state->delete();

        return back()->with('success','State removed successfully!');
    }
}
