<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected static function booted(){

        static::deleting(function($blog){

            if(!empty($blog->image) && file_exists($blog->image) && !filter_var($blog->image, FILTER_VALIDATE_URL)){

                $image_path = $blog->image;
                unlink($image_path);
            }

        });
    }
}
