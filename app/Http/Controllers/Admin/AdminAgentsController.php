<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;

class AdminAgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = Agent::all();

        return view('backend.admin.pages.agents.index',compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {

        try{

            $request->validate([
                'name' => 'required|string|max:255|unique:agents,name',
                'email' => 'required|unique:agents,email',
                'phone' => 'required|unique:agents,phone',
                'license_number' => 'nullable|unique:agents,license_number',
                'profile_photo' => 'nullable',
                'designation' => 'required|string',
                'bio' => 'string|nullable',
                'is_active' => 'nullable',

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


        $agent = new Agent;

        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->phone = $request->phone;
        $agent->license_number = $request->license_number;
        
        $image = $request->file('profile_photo');

        if($image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='admin/images/agents/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $agent->profile_photo = $image_url;

        }

        $agent->designation = $request->designation; 
        $agent->bio = $request->bio; 
        $agent->is_active = $request->is_active;


        $agent->save();

         return back()->with('success','Agent has been registered successfully!');


    }

    /**
     * Display the specified resource.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function remove($id)
    {
        $agent = Agent::findOrFail($id);

        $agent->delete();

        return back()->with('success','Agent removed successfully!');
    }

    public function removeall(){

        $agents = Agent::all();

        $agents->each->delete();

        return back()->with('success','Entire agents row cleared successfully!');
    }
}
