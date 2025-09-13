<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Floor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class UnitSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        // Verified working images
        $imageUrls = [
            'https://images.pexels.com/photos/373912/pexels-photo-373912.jpeg',
            'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg',
            'https://images.pexels.com/photos/323705/pexels-photo-323705.jpeg',
            'https://images.pexels.com/photos/221502/pexels-photo-221502.jpeg',
            'https://images.pexels.com/photos/271816/pexels-photo-271816.jpeg',
            'https://images.pexels.com/photos/439391/pexels-photo-439391.jpeg',
            'https://images.pexels.com/photos/259588/pexels-photo-259588.jpeg',
            'https://images.pexels.com/photos/280229/pexels-photo-280229.jpeg',
            'https://images.pexels.com/photos/259962/pexels-photo-259962.jpeg',
            'https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg'
        ];

        $floors = Floor::with('project')->get();

        foreach ($floors as $floor) {
            // Skip ground floor (floor = 0)
            if ($floor->floor == 0) {
                continue;
            }

            $project = $floor->project;
            $floorIndex = $floor->floor - 1; // Ground = 0, A = 1st
            $floorLetter = chr(65 + $floorIndex); // A = 1st floor

            $actualUnits = rand(1, $floor->units);
            $areaPerUnit = floor($project->net_area / max(1, $actualUnits));

            $usedUnitNumbers = [];

            for ($i = 1; $i <= $actualUnits; $i++) {
                // Ensure unique unit number on this floor
                do {
                    $numberSuffix = $faker->numberBetween(1, $floor->units * 2);
                    $unitNumber = $floorLetter . $numberSuffix;
                } while (in_array($unitNumber, $usedUnitNumbers));

                $usedUnitNumbers[] = $unitNumber;

                // Pick 3 random images
                $imageSet = collect($imageUrls)->random(3)->implode(',');

                DB::table('units')->insert([
                    'project_id' => $project->id,
                    'floor_id' => $floor->id,
                    'number' => $unitNumber,
                    'image_path' => $imageSet,
                    'video_path' => $faker->boolean(50) ? 'https://www.youtube.com/embed/' . $faker->uuid : null,
                    'pdf_path' => $faker->boolean(50) ? 'https://example.com/unit-info/' . $faker->uuid . '.pdf' : null,
                    'living_room' => 1,
                    'dining_room' => 1,
                    'bedrooms' => $faker->numberBetween(1, 5),
                    'bathrooms' => $faker->numberBetween(1, 3),
                    'balconies' => $faker->numberBetween(0, 3),
                    'area_sqft' => $areaPerUnit,
                    'is_sold' => $faker->boolean(20),
                    'status' => $faker->randomElement(['complete', 'under_construction']),
                    'price' => $faker->numberBetween(3000000, 30000000),
                    'handover_date' => $faker->dateTimeBetween('+6 months', '+2 years')->format('Y-m-d'),
                    'payment_plan' => $faker->randomElement(['Installment', 'Instantly']),
                    'latitude' => $faker->latitude,
                    'longitude' => $faker->longitude,
                    'view' => $faker->sentence,
                    'direction' => $faker->randomElement([
                        'north', 'south', 'east', 'west',
                        'north-south', 'east-west', 'south-west', 'north-east'
                    ]),
                    'build_date' => Carbon::createFromDate(
                        $faker->numberBetween(2020, 2025),
                        $faker->numberBetween(1, 12),
                        $faker->numberBetween(1, 28)
                    )->format('Y-m-d'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}