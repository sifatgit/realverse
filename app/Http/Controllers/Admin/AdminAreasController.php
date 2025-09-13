<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;

class AdminAreasController extends Controller
{
    public function index(){

        $areas = Area::all();

        return view('backend.admin.pages.areas.index',compact('areas'));

    }

    public function store(Request $request){

        try{
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable',
            'code' => 'nullable|unique:areas,code',
            'city_id' => 'required|integer|exists:cities,id',            
            'description' => 'nullable|string',
            'seo_title' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'latitude' => 'nullable|string|unique:areas,latitude',
            'longitude' => 'nullable|string|unique:areas,longitude',
            'google_map_location' => 'nullable|url',
            'priority' => 'required|integer|unique:areas,priority|min:1',

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

        $area = new Area;

        $area->name = $request->name;
        $area->slug = $request->slug;
        $area->code = $request->code;
        $area->city_id = $request->city_id;
        $area->description = $request->description;
        $area->seo_title = $request->seo_title;
        $area->seo_keywords = json_encode(array_map('trim', explode(',', $request->seo_keywords)));
        $area->seo_description = $request->seo_description;
        $area->latitude = $request->latitude;
        $area->longitude = $request->longitude;
        $area->google_map_location = $request->google_map_location;
        $area->priority = $request->priority;

        $area->save();

        return back()->with('success','Area entered successfully!');


    }

    public function delete($id){

        $area = Area::find($id);

        $area->delete();

        return back()->with('success','Aity removed successfully!');
    }
}
