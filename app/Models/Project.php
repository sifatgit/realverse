<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{


    protected $casts = [
    'features' => 'array',
];


    public function state(){

        return $this->belongsTo(State::class,'state_id');
    }
    public function city(){

        return $this->belongsTo(City::class,'city_id');
    }
    public function area(){

        return $this->belongsTo(Area::class,'area_id');
    }

    public function floorslist(){

        return $this->hasMany(Floor::class);
    }

    public function unitslist(){

        return $this->hasMany(Unit::class);
    }

    protected static function booted()
    {
        static::deleting(function ($project) {
            foreach ($project->unitslist as $unit) {
                if (!empty($unit->image_path)) {
                    $imagePaths = explode('|', $unit->image_path);

                    foreach ($imagePaths as $image) {
                        if (!empty($image)) {
                            // Convert from 'public/admin/images/units/...' to full path
                            $relativePath = str_replace('public/', '', $image);
                            $fullPath = public_path($relativePath);

                            if (file_exists($fullPath) && !filter_var($fullPath,FILTER_VALIDATE_URL)) {
                                unlink($fullPath);
                            }
                        }
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

            // Optional: delete the units if not using cascade
            // $floor->unitslist()->delete();
            if(!empty($project->image) && !filter_var($project->image,FILTER_VALIDATE_URL)){
                $image = $project->image;
                
                    if(file_exists($image)){
                        unlink($image);
                    }
                
            }            
        });


        

    }
   

}
