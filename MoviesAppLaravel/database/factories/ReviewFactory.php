<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Reviewer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'movie_id' => random_int(1, Movie::count()),
            'reviewer_id' => random_int(1, Reviewer::count()),
            'rating' => random_int(1, 5),
            'comment' => fake()->text()
        ];
    }
}
