<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class AdminSettingsController extends Controller
{
    public function index(){

        $data = Setting::first();

        return view('backend.admin.pages.settings.index',compact('data'));
    }

    public function store(Request $request){

    try{

        $request->validate([
            'title' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,webp,svg', // Adjust as needed
            'slider_title' => 'required|string|max:255',
            'slider_description' => 'required|string',
            'phone_no' => 'required|string|min:14|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'location_name' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'longitude' => 'required|string|max:255',
            'googleplus_address' => 'nullable|url|max:255',
            'facebook_address' => 'nullable|url|max:255',
            'instagram_address' => 'nullable|url|max:255',
            'linkedin_address' => 'nullable|url|max:255',
            'twitter_address' => 'nullable|url|max:255',
            'pinterest_address' => 'nullable|url|max:255',
            'whatsapp_address' => 'nullable|url|max:255',
            'about_us_headline' => 'nullable|string|max:255',
            'about_us_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'about_us_description' => 'nullable|string',
            'contact_us_description' => 'nullable|string',
            'terms_conditions' => 'required|string',
            'privacy_policy' => 'required|string',
            'ad_link' => 'nullable|url',
            'ad_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg',
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

        if($request->ajax()){

            return response()->json([

                'success' => true

            ]);
        }



        $setting = new Setting;

        $setting->title = $request->title;
        $setting->slider_title = $request->slider_title;
        $setting->slider_description = $request->slider_description;
        $setting->about_us_headline = $request->about_us_headline;
        $setting->about_us_description = $request->about_us_description;
        $setting->contact_us_description = $request->contact_us_description;
        $setting->phone_no = $request->phone_no;
        $setting->email = $request->email;
        $setting->address = $request->address;
        $setting->terms_conditions = $request->terms_conditions;
        $setting->privacy_policy = $request->privacy_policy;
        $setting->location_name = $request->location_name;
        $setting->latitude = $request->latitude;
        $setting->longitude = $request->longitude;
        $setting->googleplus_address = $request->googleplus_address;
        $setting->facebook_address = $request->facebook_address;
        $setting->instagram_address = $request->instagram_address;
        $setting->twitter_address = $request->twitter_address;
        $setting->pinterest_address = $request->pinterest_address;
        $setting->whatsapp_address = $request->whatsapp_address;
        $setting->linkedin_address = $request->linkedin_address;
        $setting->ad_link = $request->ad_link;
        $setting->ad_image = $request->ad_image;

        $logo = $request->file('logo');
        $about_us_image = $request->file('about_us_image');

        $ad_image = $request->file('ad_image');

        if($ad_image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($ad_image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='admin/images/ad_image/';
            $image_url=$upload_path.$image_full_name;
            $success=$ad_image->move($upload_path,$image_full_name);
                      
            $setting->ad_image = $image_url;


        }        
        

        if($logo){

            $image_name=hexdec(uniqid());
            $ext=strtolower($logo->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='admin/images/logo/';
            $image_url=$upload_path.$image_full_name;
            $success=$logo->move($upload_path,$image_full_name);
            $setting->logo = $image_url;

        }

        if($about_us_image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($about_us_image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='admin/images/about_us_image/';
            $image_url=$upload_path.$image_full_name;
            $success=$about_us_image->move($upload_path,$image_full_name);
            $setting->about_us_image = $image_url;

        }        

        


        $setting->save();


        return back()->with('success','Settings created successfully!');


    }

    public function update(Request $request){
        
    try {
        $request->validate([
            'title' => 'required|string|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,webp,svg', // Adjust as needed
            'slider_title' => 'required|string|max:255',
            'slider_description' => 'required|string',        
            'phone_no' => 'required|string|min:14|max:20',
            'email' => 'required|email|min:11|max:255',
            'address' => 'required|string',
            'location_name' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'longitude' => 'required|string|max:255',
            'googleplus_address' => 'nullable|url|max:255',
            'facebook_address' => 'nullable|url|max:255',
            'instagram_address' => 'nullable|url|max:255',
            'linkedin_address' => 'nullable|url|max:255',
            'twitter_address' => 'nullable|url|max:255',
            'pinterest_address' => 'nullable|url|max:255',
            'whatsapp_address' => 'nullable|url|max:255',
            'about_us_headline' => 'nullable|string|min:10|max:255',
            'about_us_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'about_us_description' => 'nullable|string',
            'contact_us_description' => 'nullable|string',
            'terms_conditions' => 'required|string',
            'privacy_policy' => 'required|string',
            'ad_link' => 'nullable|url',
            'ad_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg',            
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

        if($request->ajax()){

            return response()->json([

                'success' => true

            ]);
        }


        $setting = Setting::first();

        $setting->title = $request->title;
        $setting->slider_title = $request->slider_title;
        $setting->slider_description = $request->slider_description;        
        $setting->about_us_headline = $request->about_us_headline;
        $setting->about_us_description = $request->about_us_description;
        $setting->contact_us_description = $request->contact_us_description;
        $setting->phone_no = $request->phone_no;
        $setting->email = $request->email;
        $setting->address = $request->address;
        $setting->terms_conditions = $request->terms_conditions;
        $setting->privacy_policy = $request->privacy_policy;
        $setting->location_name = $request->location_name;
        $setting->latitude = $request->latitude;
        $setting->longitude = $request->longitude;
        $setting->googleplus_address = $request->googleplus_address;
        $setting->facebook_address = $request->facebook_address;
        $setting->instagram_address = $request->instagram_address;
        $setting->twitter_address = $request->twitter_address;
        $setting->pinterest_address = $request->pinterest_address;
        $setting->whatsapp_address = $request->whatsapp_address;
        $setting->linkedin_address = $request->linkedin_address;
        $setting->ad_link = $request->ad_link;

        $ad_image = $request->file('ad_image');

        if($ad_image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($ad_image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='admin/images/ad_image/';
            $image_url=$upload_path.$image_full_name;
            $success=$ad_image->move($upload_path,$image_full_name);

            if(file_exists($setting->ad_image)){
                unlink($setting->ad_image);
            }             
            $setting->ad_image = $image_url;


        }        


        $logo = $request->file('logo');
        $about_us_image = $request->file('about_us_image');
        $old_photo = $request->old_photo;
        $old_about_us_image = $request->old_about_us_image;


        if($logo){

            $image_name=hexdec(uniqid());
            $ext=strtolower($logo->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='admin/images/logo/';
            $image_url=$upload_path.$image_full_name;
            $success=$logo->move($upload_path,$image_full_name);
            $setting->logo = $image_url;

            if($old_photo){

                unlink($old_photo);
            }
        }

        if($about_us_image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($about_us_image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='admin/images/about_us_image/';
            $image_url=$upload_path.$image_full_name;
            $success=$about_us_image->move($upload_path,$image_full_name);
            $setting->about_us_image = $image_url;

            if($old_about_us_image){

                unlink($old_about_us_image);
            }
        }

        


        $setting->save();


        return back()->with('success','Settings updated successfully!');

    }

    public function delete($id){

        $setting = Setting::find($id);

        if($setting->logo){

            unlink($setting->logo);
        }
        if($setting->about_us_image){

            unlink($setting->about_us_image);
        }

        $setting->delete();

        return back()->with('success','Settings removed successfully!');
    }
}
