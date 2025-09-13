<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
         $this->call(AdminSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(StateSeeder::class);
         $this->call(CitySeeder::class);
         $this->call(AreaSeeder::class);
        //User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);
         $this->call(ProjectSeeder::class);
         $this->call(FloorSeeder::class);
         $this->call(AgentSeeder::class);
         $this->call(BlogSeeder::class);
         $this->call(SubmittedUnitSeeder::class);
    }
}
