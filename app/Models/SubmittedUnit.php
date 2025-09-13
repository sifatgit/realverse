<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmittedUnit extends Model
{
    protected $casts = [
    'features' => 'array',
    'build_date' => 'date'
    ];


    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }

    public function state(){

        return $this->belongsTo(State::class,'state_id');
    }
    public function city(){

        return $this->belongsTo(City::class,'city_id');
    }
    public function area(){

        return $this->belongsTo(Area::class,'area_id');
    }

    protected static function booted()
    {
        static::deleting(function($unit){
            if(!filter_var($unit->image_path,FILTER_VALIDATE_URL)){
                $images = explode(",",$unit->image_path);
                foreach($images as $image){
                    if(file_exists($image)){
                        unlink($image);
                    }
                }
            }            
        });
    }    
    
}
