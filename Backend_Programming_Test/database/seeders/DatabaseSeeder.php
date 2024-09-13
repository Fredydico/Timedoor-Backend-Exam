<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Category;
use App\Models\Book;
use App\Models\Rating;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Create Authors
        foreach (range(1, 1000) as $index) {
            Author::create(['name' => $faker->name]);
        }

        // Create Categories
        foreach (range(1, 3000) as $index) {
            Category::create(['name' => $faker->word]);
        }

        // Create Books
        foreach (range(1, 100000) as $index) {
            Book::create([
                'title' => $faker->sentence,
                'author_id' => $faker->numberBetween(1, 1000),
                'category_id' => $faker->numberBetween(1, 3000),
            ]);
        }

        // Create Ratings
        foreach (range(1, 500000) as $index) {
            Rating::create([
                'book_id' => $faker->numberBetween(1, 100000),
                'rating' => $faker->numberBetween(1, 10),
            ]);
        }
    }
}

