<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class AdminSlidersController extends Controller
{
    public function index(){

        $sliders = Slider::all();

        return view('backend.admin.pages.sliders.index',compact('sliders'));
    }

    public function store(Request $request){

        try {
            $request->validate([
                
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,svg', // Adjust as needed

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

        if($request()->ajax()){

            return response()->json([

                'success' => true

            ]);
        }        

        $sliders = Slider::get();

        if(count($sliders) > 2) {

        return back()->with('warning','Max 3 slider images allowed!');  
          
        }

        else{

        $slider = new Slider;

        $slider->title = $request->title;

        $image = $request->file('image');

        if($image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/admin/images/sliders/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $slider->image=$image_url;

            
        }

        $slider->save();

        return back()->with('success', 'Slider stored successfully!');    

        }



    }

    public function delete($id){

        $slider = Slider::find($id);

        $slider->delete();

        return back()->with('success','Slider removed successfully!');
    }    
}
