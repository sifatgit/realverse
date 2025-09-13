<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    public function run()
    {
        // List of US states with code and some basic SEO placeholders
        $states = [
            ['name' => 'Alabama', 'code' => 'AL'],
            ['name' => 'Alaska', 'code' => 'AK'],
            ['name' => 'Arizona', 'code' => 'AZ'],
            ['name' => 'Arkansas', 'code' => 'AR'],
            ['name' => 'California', 'code' => 'CA'],
            ['name' => 'Colorado', 'code' => 'CO'],
            ['name' => 'Connecticut', 'code' => 'CT'],
            ['name' => 'Delaware', 'code' => 'DE'],
            ['name' => 'Florida', 'code' => 'FL'],
            ['name' => 'Georgia', 'code' => 'GA'],
            ['name' => 'Hawaii', 'code' => 'HI'],
            ['name' => 'Idaho', 'code' => 'ID'],
            ['name' => 'Illinois', 'code' => 'IL'],
            ['name' => 'Indiana', 'code' => 'IN'],
            ['name' => 'Iowa', 'code' => 'IA'],
            ['name' => 'Kansas', 'code' => 'KS'],
            ['name' => 'Kentucky', 'code' => 'KY'],
            ['name' => 'Louisiana', 'code' => 'LA'],
            ['name' => 'Maine', 'code' => 'ME'],
            ['name' => 'Maryland', 'code' => 'MD'],
            ['name' => 'Massachusetts', 'code' => 'MA'],
            ['name' => 'Michigan', 'code' => 'MI'],
            ['name' => 'Minnesota', 'code' => 'MN'],
            ['name' => 'Mississippi', 'code' => 'MS'],
            ['name' => 'Missouri', 'code' => 'MO'],
            ['name' => 'Montana', 'code' => 'MT'],
            ['name' => 'Nebraska', 'code' => 'NE'],
            ['name' => 'Nevada', 'code' => 'NV'],
            ['name' => 'New Hampshire', 'code' => 'NH'],
            ['name' => 'New Jersey', 'code' => 'NJ'],
            ['name' => 'New Mexico', 'code' => 'NM'],
            ['name' => 'New York', 'code' => 'NY'],
            ['name' => 'North Carolina', 'code' => 'NC'],
            ['name' => 'North Dakota', 'code' => 'ND'],
            ['name' => 'Ohio', 'code' => 'OH'],
            ['name' => 'Oklahoma', 'code' => 'OK'],
            ['name' => 'Oregon', 'code' => 'OR'],
            ['name' => 'Pennsylvania', 'code' => 'PA'],
            ['name' => 'Rhode Island', 'code' => 'RI'],
            ['name' => 'South Carolina', 'code' => 'SC'],
            ['name' => 'South Dakota', 'code' => 'SD'],
            ['name' => 'Tennessee', 'code' => 'TN'],
            ['name' => 'Texas', 'code' => 'TX'],
            ['name' => 'Utah', 'code' => 'UT'],
            ['name' => 'Vermont', 'code' => 'VT'],
            ['name' => 'Virginia', 'code' => 'VA'],
            ['name' => 'Washington', 'code' => 'WA'],
            ['name' => 'West Virginia', 'code' => 'WV'],
            ['name' => 'Wisconsin', 'code' => 'WI'],
            ['name' => 'Wyoming', 'code' => 'WY'],
            // optionally add DC
            ['name' => 'District of Columbia', 'code' => 'DC'],
        ];

        foreach ($states as $index => $state) {
            DB::table('states')->insert([
                'name' => $state['name'],
                'slug' => Str::slug($state['name']),
                'code' => $state['code'],
                'description' => null,
                'seo_title' => $state['name'] . ' State Information',
                'seo_keywords' => '['.'"'.$state['name'].'"' . ', "state", "USA"'.']',
                'seo_description' => 'Learn more about ' . $state['name'] . ', a state in the USA.',
                'latitude' => null,
                'longitude' => null,
                'google_map_location' => null,
                'priority' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
