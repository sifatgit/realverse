<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Project;

class FloorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Fetch all existing projects
        $projects = Project::all();

        foreach ($projects as $project) {
            $floorCount = $project->floors;
            $unitLimit = $project->units;

        foreach (range(0, $floorCount) as $floorNumber) {
            DB::table('floors')->insert([
                'project_id' => $project->id,
                'floor' => $floorNumber,
                'label' => $this->getFloorLabel($floorNumber),
                'units' => $faker->numberBetween(1, $unitLimit), // Now unbounded up to project->units
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        }
    }

    private function getFloorLabel($floor)
    {
        return match($floor) {
            0 => 'Ground Floor',
            default => 'Floor ' . $floor,
        };
    }
}
