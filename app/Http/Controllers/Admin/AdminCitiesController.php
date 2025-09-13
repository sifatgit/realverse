<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class AdminCitiesController extends Controller
{
    public function index(){

        $cities = City::all();

        return view('backend.admin.pages.cities.index',compact('cities'));

    }

    public function store(Request $request){

        try{


        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable',
            'code' => 'nullable|unique:cities,code',
            'state_id' => 'required|integer|exists:states,id',
            'description' => 'nullable|string',
            'seo_title' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'latitude' => 'nullable|string|unique:cities,latitude',
            'longitude' => 'nullable|string|unique:cities,longitude',
            'google_map_location' => 'nullable|url',
            'priority' => 'required|integer|unique:cities|min:1',

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

        $state = new City;

        $state->name = $request->name;
        $state->slug = $request->slug;
        $state->code = $request->code;
        $state->state_id = $request->state_id;
        $state->description = $request->description;
        $state->seo_title = $request->seo_title;
        $state->seo_keywords = json_encode(array_map('trim', explode(',', $request->seo_keywords)));
        $state->seo_description = $request->seo_description;
        $state->latitude = $request->latitude;
        $state->longitude = $request->longitude;
        $state->google_map_location = $request->google_map_location;
        $state->priority = $request->priority;

        $state->save();

        return back()->with('success','City entered successfully!');


    }

    public function delete($id){

        $city = City::find($id);

        $city->delete();

        return back()->with('success','City removed successfully!');
    }
}
