<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $books = Book::all();
        if ($books->isEmpty())
        {
            return;
        }
        $reviewCount = 1000;
        $bookCount = $books->count();

        for ($i = 0; $i < $reviewCount; $i++)
        {
            $book = $books[$i % $bookCount];

            Review::create([
                'book_id' => $book->id,
                'reviewer' => fake()->name(),
                'rating' => fake()->numberBetween(1, 5),
                'comment' =>fake()->optional()->sentence(),
            ]);
        }
    }
}
