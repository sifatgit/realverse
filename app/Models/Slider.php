<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected static function booted(){

        static::deleting(function($slider){

            if(!empty($slider->image) && file_exists($slider->image) && !filter_var($slider->image, FILTER_VALIDATE_URL) ){

                unlink($slider->image);
            }

        });
    }
}
