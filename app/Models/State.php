<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class State extends Model
{

    protected $casts = [

    'seo_keywords' => 'array',
    
    ];

    public function cities(){

        return $this->hasMany(City::class);
    }

    public function projects(){

        return $this->hasMany(Project::class);
    }



    protected static function booted()
    {
        static::deleting(function ($state) {
            foreach ($state->projects as $project) {
                foreach($project->unitslist as $unit){
                    if($unit->image_path){
                        $images = explode(",",$unit->image_path);
                        foreach($images as $img){
                            unlink($img);
                        }
                    }
                if ($unit->video_path){
                    $pathToDelete = str_replace('public/storage/', '', $unit->video_path);
                    Storage::disk('public')->delete($pathToDelete);                
                }
                if ($unit->pdf_path){
                    $pathToDelete = str_replace('public/storage/', '', $unit->pdf_path);
                    Storage::disk('public')->delete($pathToDelete);                
                }                    
                }
                if ($project->image) {
                    $imagePath = $project->image;

                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
        });
    }


}    