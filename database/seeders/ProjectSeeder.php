<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\State;
use App\Models\City;
use App\Models\Area;
use Faker\Factory as Faker;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $imageUrls = [
            'https://images.pexels.com/photos/373912/pexels-photo-373912.jpeg',
            'https://cdn.pixabay.com/photo/2016/11/29/03/53/apartment-1867187_1280.jpg',
            'https://cdn.pixabay.com/photo/2016/02/19/11/53/architecture-1207957_1280.jpg',
            'https://cdn.pixabay.com/photo/2015/02/03/18/58/hall-621741_1280.jpg',
            'https://cdn.pixabay.com/photo/2017/02/28/15/00/apartment-2106172_1280.jpg',
            'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg',
            'https://images.pexels.com/photos/323705/pexels-photo-323705.jpeg',
            'https://images.pexels.com/photos/221502/pexels-photo-221502.jpeg',
            'https://cdn.pixabay.com/photo/2016/11/29/03/53/apartment-1867187_1280.jpg',
            'https://cdn.pixabay.com/photo/2016/02/19/11/53/architecture-1207957_1280.jpg',
        ];

        $stateIds = State::pluck('id')->toArray();
        $cityIds = City::pluck('id')->toArray();
        $areaIds = Area::pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            $total_area = $faker->numberBetween(5000, 60000);
            $total_building_area = (int) round($total_area * 0.90);
            $net_area = (int) round($total_building_area * 0.90);
            $common_area = (int) round($total_building_area * 0.10);

            DB::table('projects')->insert([
                'name' => $faker->company . ' Tower',
                'code' => 'RV-BLD-' . str_pad($index, 3, '0', STR_PAD_LEFT),
                'description' => $faker->paragraph,
                'image' => $imageUrls[$index - 1],
                'address_line' => $faker->streetAddress,
                'state_id' => fake()->randomElement($stateIds), // Replace with valid IDs
                'city_id' => fake()->randomElement($cityIds),
                'area_id' => fake()->randomElement($areaIds),
                'postal_code' => $faker->numberBetween(1000, 9999),
                'floors' => $faker->numberBetween(5, 20),
                'units' => $faker->numberBetween(1, 10),
                'total_area_rounded_sqft' => $total_area,
                'total_building_area' => $total_building_area,
                'common_area' => $common_area,
                'net_area' => $net_area,
                'contact' => $faker->phoneNumber,
                'status' => $faker->randomElement(['complete', 'under_construction']),
                'features' => json_encode($faker->randomElements([
                    'wifi', 'elevator', 'parking', 'center', 'gym', 'swimming', 'generator'
                ], rand(2, 6))),
                'is_sold_out' => $faker->boolean(30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}