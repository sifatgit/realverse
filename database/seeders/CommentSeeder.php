<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogPosts = DB::table('blogs')->get();
        $userIds = DB::table('users')->pluck('id')->toArray();

        foreach ($blogPosts as $blog) {
            for ($i = 1; $i <= 10; $i++) {
                DB::table('comments')->insert([
                    'user_id' => rand(0, 1) ? fake()->randomElement($userIds) : null, // 50% chance of being null
                    'blog_id' => $blog->id,
                    'name' => fake()->name(),
                    'email' => fake()->safeEmail(),
                    'comment' => fake()->paragraph(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
