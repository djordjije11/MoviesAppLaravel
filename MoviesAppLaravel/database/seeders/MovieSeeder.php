<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movie = new Movie("Godfather", 1972, "The aging patriarch of an organized crime dynasty in postwar New York City transfers control of his clandestine empire to his reluctant youngest son.", "crime");
        $movie->save();
        $movie = new Movie("Fight Club", 1999, "An insomniac office worker and a devil-may-care soap maker form an underground fight club that evolves into much more.", "drama");
        $movie->save();
        $movie = new Movie("Scarface", 1983, "In 1980 Miami, a determined Cuban immigrant takes over a drug cartel and succumbs to greed.", "crime");
        $movie->save();
        $movie = new Movie("Spider-Man", 2002, "After being bitten by a genetically-modified spider, a shy teenager gains spider-like abilities that he uses to fight injustice as a masked superhero and face a vengeful enemy.", "action");
        $movie->save();
    }
}
