<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    
    protected static function booted(){

        static::deleting(function($agent){

            if(!empty($agent->profile_photo) && file_exists($agent->profile_photo) && !filter_var($agent->profile_photo, FILTER_VALIDATE_URL)){

                $image_path = $agent->profile_photo;
                unlink($image_path);
            }

        });
    }
}
