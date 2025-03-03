<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
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
        Book::factory(33)->create()->each(function (Book $book) {
            $numberOfReviews = random_int(5, 30);
            Review::factory()->count($numberOfReviews)->good()->for($book)->create();
        });

        Book::factory(33)->create()->each(function (Book $book) {
            $numberOfReviews = random_int(5, 30);
            Review::factory()->count($numberOfReviews)->average()->for($book)->create();
        });

        Book::factory(count: 34)->create()->each(function (Book $book) {
            $numberOfReviews = random_int(5, 30);
            Review::factory()->count($numberOfReviews)->bad()->for($book)->create();
        });
    }
}
