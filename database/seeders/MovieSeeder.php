<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Movie;
use App\Models\Genre;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $genres = Genre::all();

        foreach ($genres as $genre) {
            $movie = Movie::create([
                'title' => $genre->name . ' Movie',
                'slug' => Str::slug($genre->name . ' Movie'),
                'description' => 'A sample description for ' . $genre->name . ' movie.',
                'country' => 'USA',
                'duration' => rand(90, 150),
                'release_date' => now()->subYears(rand(1, 10)),
                'rating' => rand(1, 10),
                'poster' => 'default.jpg',
                'genre_id' => $genre->id,
            ]);

            $movie->genres()->attach($genre->id);
        }
    }
}
