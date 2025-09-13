<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Floor extends Model
{
    public function project(){

        return $this->belongsTo(Project::class,'project_id');
    }

    public function unitslist(){

        return $this->hasMany(Unit::class);
    }

    protected static function booted()
    {
        static::deleting(function ($floor) {
            foreach ($floor->unitslist as $unit) {
                if (!empty($unit->image_path)) {
                    $imagePaths = explode('|', $unit->image_path);

                    foreach ($imagePaths as $image) {
                        if (!empty($image)) {
                            // Convert from 'public/admin/images/units/...' to full path
                            $relativePath = str_replace('public/', '', $image);
                            $fullPath = public_path($relativePath);

                            if (file_exists($fullPath)) {
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
        });
    }
    
}
