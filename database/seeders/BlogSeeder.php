<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();


        $imageUrls = [
            "https://images.pexels.com/photos/1396122/pexels-photo-1396122.jpeg", // modern home
            "https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg",   // house with pool
            "https://images.pexels.com/photos/259588/pexels-photo-259588.jpeg",   // suburban home
            "https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg",   // contemporary building
            "https://images.pexels.com/photos/439391/pexels-photo-439391.jpeg",   // modern kitchen interior
            "https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg", // real estate agent handing key
            "https://images.pexels.com/photos/259957/pexels-photo-259957.jpeg",   // luxury living room
            "https://images.pexels.com/photos/271618/pexels-photo-271618.jpeg",   // tall buildings
            "https://images.pexels.com/photos/323705/pexels-photo-323705.jpeg",   // cozy home exterior
            "https://images.pexels.com/photos/276724/pexels-photo-276724.jpeg",   // backyard patio
        ];


        foreach(range(1,10) as $index){

            DB::table('blogs')->insert([

                'topic' => $faker->word,
                'title' => $faker->sentence,
                'image' => $faker->randomElement($imageUrls),
                'details' => $faker->text(500),
                'author' => $faker->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }        
    }
}
