<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use App\Http\Requests\MovieRequest;
use App\Services\MovieService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function store(MovieRequest $request)
    {
        $validatedData = $request->validated();

        if (!isset($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['title']);
        }

        $movie = $this->movieService->createMovie($validatedData);

        return redirect()->route('movie.list')->with('success', 'Movie created successfully');
    }

    public function index()
    {
        $movies = $this->movieService->getList();
        return view('movie.movie_list', compact('movies'));
    }

    public function show($slug)
    {
        $movie = Movie::where('slug', $slug)->firstOrFail();
        return view('movie.movie_detail', compact('movie'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.movies.create', compact('genres'));
    }

    public function edit($slug) 
    {
        $movie = Movie::where('slug', $slug)->firstOrFail();
        $genres = Genre::all();
        return view('admin.movies.edit', compact('movie', 'genres'));
    }

    public function update(MovieRequest $request, $slug)
    {
        Log::info('Updating movie with slug: ' . $slug);
        Log::info('Updated data: ', $request->validated());

        $this->movieService->updateMovie($slug, $request->validated());

        return redirect()->route('movie.list')->with('success', 'Movie updated successfully');
    }

    public function destroy($slug)
    {
        $movie = Movie::where('slug', $slug)->firstOrFail();
        $this->movieService->deleteMovie($movie->id);

        return redirect()->route('movie.list')->with('success', 'Movie deleted successfully');
    }
}
