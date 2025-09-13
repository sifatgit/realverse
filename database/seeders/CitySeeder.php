<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    public function run(): void
    {
$cities = [
    'alabama' => [
        ['name' => 'Birmingham', 'code' => 'BHM', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Birmingham'],
        ['name' => 'Montgomery', 'code' => 'MGM', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Montgomery'],
        ['name' => 'Mobile', 'code' => 'MOB', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Mobile'],
    ],
    'alaska' => [
        ['name' => 'Anchorage', 'code' => 'ANC', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Anchorage'],
        ['name' => 'Fairbanks', 'code' => 'FAI', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Fairbanks'],
        ['name' => 'Juneau', 'code' => 'JNU', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Juneau'],
    ],
    'arizona' => [
        ['name' => 'Phoenix', 'code' => 'PHX', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Phoenix'],
        ['name' => 'Tucson', 'code' => 'TUS', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Tucson'],
        ['name' => 'Mesa', 'code' => 'MES', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Mesa'],
    ],
    'arkansas' => [
        ['name' => 'Little Rock', 'code' => 'LIT', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...LittleRock'],
        ['name' => 'Fayetteville', 'code' => 'FYV', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Fayetteville'],
        ['name' => 'Fort Smith', 'code' => 'FSM', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...FortSmith'],
    ],
    'california' => [
        ['name' => 'Los Angeles', 'code' => 'LAX', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...LosAngeles'],
        ['name' => 'San Francisco', 'code' => 'SFO', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...SanFrancisco'],
        ['name' => 'San Diego', 'code' => 'SAN', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...SanDiego'],
        ['name' => 'Sacramento', 'code' => 'SMF', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Sacramento'],
    ],
    'colorado' => [
        ['name' => 'Denver', 'code' => 'DEN', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Denver'],
        ['name' => 'Colorado Springs', 'code' => 'COS', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...ColoradoSprings'],
        ['name' => 'Boulder', 'code' => 'BLD', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Boulder'],
    ],
    'connecticut' => [
        ['name' => 'Hartford', 'code' => 'HFD', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Hartford'],
        ['name' => 'New Haven', 'code' => 'HVN', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...NewHaven'],
        ['name' => 'Stamford', 'code' => 'STM', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Stamford'],
    ],
    'delaware' => [
        ['name' => 'Wilmington', 'code' => 'ILG', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Wilmington'],
        ['name' => 'Dover', 'code' => 'DOE', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Dover'],
        ['name' => 'Newark', 'code' => 'NEW', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...NewarkDE'],
    ],
    'florida' => [
        ['name' => 'Miami', 'code' => 'MIA', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Miami'],
        ['name' => 'Orlando', 'code' => 'ORL', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Orlando'],
        ['name' => 'Tampa', 'code' => 'TPA', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Tampa'],
        ['name' => 'Jacksonville', 'code' => 'JAX', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Jacksonville'],
    ],
    'georgia' => [
        ['name' => 'Atlanta', 'code' => 'ATL', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Atlanta'],
        ['name' => 'Savannah', 'code' => 'SAV', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Savannah'],
        ['name' => 'Augusta', 'code' => 'AGS', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Augusta'],
    ],
    'hawaii' => [
        ['name' => 'Honolulu', 'code' => 'HNL', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Honolulu'],
        ['name' => 'Hilo', 'code' => 'ITO', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Hilo'],
        ['name' => 'Kailua', 'code' => 'KAI', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Kailua'],
    ],
    'idaho' => [
        ['name' => 'Boise', 'code' => 'BOI', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Boise'],
        ['name' => 'Idaho Falls', 'code' => 'IDA', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...IdahoFalls'],
        ['name' => 'Twin Falls', 'code' => 'TWF', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...TwinFalls'],
    ],
    'illinois' => [
        ['name' => 'Chicago', 'code' => 'CHI', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Chicago'],
        ['name' => 'Springfield', 'code' => 'SPI', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...SpringfieldIL'],
        ['name' => 'Peoria', 'code' => 'PIA', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Peoria'],
    ],
    'indiana' => [
        ['name' => 'Indianapolis', 'code' => 'IND', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Indianapolis'],
        ['name' => 'Fort Wayne', 'code' => 'FWA', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...FortWayne'],
        ['name' => 'Evansville', 'code' => 'EVV', 'google_map_location' => 'https://www.google.com/maps/embed?pb=!1m18!...Evansville'],
    ],
    // You can continue similarly for all other states...
];


        foreach ($cities as $divisionSlug => $cities) {
            $state = DB::table('states')->where('slug', $divisionSlug)->first();

            if (!$state) {
                $this->command->warn("State with slug '{$divisionSlug}' not found, skipping its cities.");
                continue;
            }

            foreach ($cities as $city) {
                DB::table('cities')->updateOrInsert(
                    [
                        'slug' => Str::slug($city['name']),
                        'state_id' => $state->id,
                    ],
                    [
                        'name'                => $city['name'],
                        'code'                => $city['code'],
                        'slug'                => Str::slug($city['name']),
                        'google_map_location' => $city['google_map_location'],
                        'state_id'            => $state->id,
                        'created_at'          => now(),
                        'updated_at'          => now(),
                    ]
                );
            }
        }

        $this->command->info('✅ All city records seeded with Google Map embed URLs!');
    }
}
