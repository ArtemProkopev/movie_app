<?php

namespace App\Services;

use App\Models\Movie;
use App\Services\GenreService;
use Illuminate\Support\Facades\Log;
use App\Interfaces\MovieServiceInterface;
use Illuminate\Support\Facades\Storage;

class MovieService implements MovieServiceInterface
{
    protected $genreService;

    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }

    public function getList()
    {
        return Movie::paginate(20);
    }

    public function createMovie(array $data): Movie
    {
        Log::info('Movie data for creation:', $data);

        if (isset($data['poster'])) {
            $data['poster'] = $data['poster']->store('posters', 'public');
        }

        $movie = Movie::create($data);

        $genres = $this->genreService->getListByName($data['genres']);
        $movie->genres()->sync($genres->pluck('id'));

        return $movie;
    }

    public function updateMovie($slug, array $data): Movie
    {
        $movie = Movie::where('slug', $slug)->firstOrFail(); 

        Log::info('Updating movie data:', $data);

        if (isset($data['poster'])) {
            if ($movie->poster) {
                Storage::disk('public')->delete($movie->poster);
            }
            $data['poster'] = $data['poster']->store('posters', 'public');
        }

        $movie->update($data);

        if (isset($data['genres'])) {
            $genres = $this->genreService->getListByName($data['genres']);
            $movie->genres()->sync($genres->pluck('id'));
        }

        return $movie;
    }

    public function deleteMovie(int $id): bool
    {
        $movie = Movie::findOrFail($id);

        $movie->genres()->detach();

        if ($movie->poster) {
            Storage::disk('public')->delete($movie->poster);
        }

    return $movie->delete();
    }
}
