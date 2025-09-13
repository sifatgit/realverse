<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public function project(){

        return $this->belongsTo(Project::class,'project_id');
    }

    public function floor(){

        return $this->belongsTo(Floor::class,'floor_id');
    }

    public function setDirectionAttribute($value)
    {
        $this->attributes['direction'] = strtolower($value);
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
            if(file_exists($unit->video_path)){

                    $pathToDelete = str_replace('public/storage/', '', $unit->video_path);
                    Storage::disk('public')->delete($pathToDelete);                                

            }
            if(file_exists($unit->pdf_path)){
                    $pathToDelete = str_replace('public/storage/', '', $unit->pdf_path);
                    Storage::disk('public')->delete($pathToDelete);                
            }
        });
    }
        
}
