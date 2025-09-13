<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\SubmittedUnit; // Assuming this is your model name
use App\Models\User;
use App\Models\State;
use App\Models\City;
use App\Models\Area;

class SubmittedUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
        
        $userIds = User::pluck('id')->toArray();
        $stateIds = State::pluck('id')->toArray();
        $cityIds = City::pluck('id')->toArray();
        $areaIds = Area::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            SubmittedUnit::create([
                'user_id' => $faker->randomElement($userIds),
                'state_id' => $faker->randomElement($stateIds),
                'city_id' => $faker->randomElement($cityIds),
                'area_id' => $faker->randomElement($areaIds),

                'user_photo' => $faker->imageUrl(200, 200, 'people'), // Fake profile photo URL
                'number' => $faker->bothify('Unit-###??'),
                'floor' => $faker->numberBetween(1, 10),

                'image_path' => implode('|', [
                    $faker->imageUrl(400, 300, 'city'),
                    $faker->imageUrl(400, 300, 'city'),
                ]),

                'video_path' => $faker->optional()->url,

                'living_room' => $faker->numberBetween(1, 3),
                'dining_room' => $faker->numberBetween(0, 2),
                'bedrooms' => $faker->numberBetween(1, 5),
                'bathrooms' => $faker->numberBetween(1, 3),
                'balconies' => $faker->numberBetween(0, 3),

                // ✅ This creates an actual array: ["parking", "wifi"]
                'features' => $faker->randomElements([
                    'parking', 'swimming', 'gym', 'center', 'generator', 'wifi', 'elevator'
                ], $faker->numberBetween(1, 4)),


                'area_sqft' => $faker->numberBetween(500, 4000),

                'condition' => $faker->randomElement(['new', 'used']),
                'type' => $faker->randomElement(['sell', 'rent']),

                'price' => $faker->numberBetween(50000, 5000000),

                'build_date' => $faker->date(),

                'description' => $faker->optional()->paragraph,

                'phone' => $faker->phoneNumber,

                'address' => $faker->address,
            ]);
        }                

    }
}
