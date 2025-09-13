<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [];

        for ($i = 1; $i <= 100; $i++) {
            $padded = str_pad($i, 3, '0', STR_PAD_LEFT); // e.g., 001, 002...
            
            $users[] = [
                'first_name' => "User{$padded}",
                'last_name' => "Test{$padded}",
                'image' => null,
                'username' => "user{$padded}", // ✅ Unique username
                'email' => "user{$padded}@example.com", // ✅ Unique email
                'phone' => "01700000{$padded}", // ✅ Unique phone
                'facebook' => "https://facebook.com/user{$padded}",
                'mail' => "user{$padded}@mail.com",
                'twitter' => "https://twitter.com/user{$padded}",
                'linkedin' => "https://linkedin.com/in/user{$padded}",
                'website' => "https://user{$padded}.com",
                'fax' => "880-2-9000{$padded}",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('users')->insert($users);
    }
}
