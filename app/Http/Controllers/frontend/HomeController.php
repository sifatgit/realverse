<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Unit;
use App\Models\Blog;
use App\Models\City;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        
        $sliders = Slider::all();
        $units = Unit::where('is_sold','0')->orderBy('id','asc')->limit(7)->get();
        $customers = User::all();
        $properties = Unit::all();
        $branches = 200;

        $min = [

            'price' => Unit::min('price'),
            'area_sqft' => Unit::min('area_sqft'),
            'bathrooms' => Unit::min('bathrooms'),
            'bedrooms' => Unit::min('bedrooms'),


        ];


        $max = [

            'price' => Unit::max('price'),
            'area_sqft' => Unit::max('area_sqft'),
            'bathrooms' => Unit::max('bathrooms'),
            'bedrooms' => Unit::max('bedrooms'),


        ];
        $cities = City::all(); 

        $reviews = DB::table('reviews')->get();

        return view('frontend.index',compact('sliders','units','min','max','cities','customers','properties','branches','reviews'));
    }

    public function about_us(){

        return view('frontend.pages.about_us');
    }
    
    public function contact(){

            return view('frontend.pages.contact');
        }

    public function terms_conditions(){

        return view('frontend.pages.terms_conditions');
    }

    public function privacy_policy(){

            return view('frontend.pages.privacy_policy');
    }

    public function messageSend(Request $request){

        try{

            $request->validate([

                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'subject' => 'required|string|max:255',
                'message' => 'required',

            ]);
        }

        catch (ValidationException $e) {

            if($request->ajax()){

                return response()->json(['errors' => $e->errors()], 422);
            }
            
        }        

        if($request->all()){

            $message = Message::where('email',$request->email)->where('status', 0)->first();

            if($message){

                return response()->json(['warning' => 'Please wait until your last message is replied, check your email please!']);
            }
            else{
                 $message = Message::create($request->all());
                return response()->json(['message' => 'Message successfully send!']);                
            }
           
        }




    }
}
