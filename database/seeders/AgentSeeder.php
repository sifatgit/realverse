<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $imageUrls = [
                "https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg",
                "https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg",
                "https://images.pexels.com/photos/2379005/pexels-photo-2379005.jpeg",
                "https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg",
                "https://images.pexels.com/photos/1130626/pexels-photo-1130626.jpeg",
                "https://images.pexels.com/photos/1181690/pexels-photo-1181690.jpeg",
                "https://images.pexels.com/photos/1987301/pexels-photo-1987301.jpeg",
                "https://images.pexels.com/photos/733872/pexels-photo-733872.jpeg",
                "https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg",
                "https://images.pexels.com/photos/1704488/pexels-photo-1704488.jpeg",
        ];

        foreach(range(1,10) as $index){

        DB::table('agents')->insert([
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'phone' => $faker->phoneNumber,
            'license_number' => 'LIC'. strtoupper(Str::random(6)),
            'profile_photo' => $faker->randomElement($imageUrls),
            'designation' => $faker->randomElement(['Senior Agent', 'Junior Agent', 'Lead Broker', 'Sales Executive']),
            'bio' => $faker->paragraph,
            'is_active' => $faker->boolean(90),
            'created_at' => now(),
            'updated_at' => now(),
            ]);
        }
    }
}
