<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsLetterController extends Controller
{
    public function store(Request $request){

        
        $subscibed = Newsletter::where('email',$request->email)->first();

        if($subscibed){

            return response()->json(['status' => 'warning']);            
        }    

        else{
            $newsletter = new Newsletter;

            $newsletter->email = $request->email;

            $newsletter->save();      
            
            return response()->json(['status' => 'success']);      
        }



        
    }
}
