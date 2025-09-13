<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomerReviewSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $roles = [
            'Homeowner', 'Investor', 'Tenant', 'Landlord',
            'First-time Buyer', 'Real Estate Developer',
            'Renter', 'Buyer', 'Seller', 'Property Manager'
        ];

        $reviews = [
            "Realverse made buying my first home feel easy and exciting. Highly recommended!",
            "Thanks to Realverse, I found a perfect apartment within my budget in just two days.",
            "Realverse’s agents were incredibly patient and guided me through every step.",
            "As a property investor, I always rely on Realverse for accurate listings and great support.",
            "Realverse simplified the home-buying process for me. Everything was transparent and quick.",
            "I listed my house on Realverse and got multiple offers within a week!",
            "Realverse helped us relocate smoothly. Their platform made it stress-free.",
            "I love how easy it is to filter and compare properties on Realverse.",
            "Realverse customer service was responsive and very professional throughout.",
            "Found my dream studio thanks to Realverse. It’s a platform you can trust.",
            "Realverse turned my renting experience into a breeze—fast, clear, and helpful.",
            "Every detail was taken care of with Realverse. I felt supported all the way.",
            "I’ve used other platforms before, but Realverse stands out with its reliability.",
            "The Realverse website is easy to use and full of great listings in my area.",
            "With Realverse, I was able to rent out my apartment within just 3 days!",
            "Realverse connected me with trustworthy buyers and made the selling process smooth.",
            "As a first-time renter, Realverse gave me all the tools I needed to choose wisely.",
            "Realverse helped me find a family-friendly neighborhood with great schools nearby.",
            "I never imagined finding the right home could be this simple. Thank you, Realverse!",
            "My entire experience with Realverse was flawless, from browsing to finalizing the deal."
        ];

        foreach ($reviews as $index => $review) {
            $gender = $faker->randomElement(['men', 'women']);
            $profileIndex = $faker->numberBetween(1, 99);
            $image = "https://randomuser.me/api/portraits/{$gender}/{$profileIndex}.jpg";

            DB::table('reviews')->insert([
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'role' => $faker->randomElement($roles),
                'image' => $image,
                'review' => $review,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
