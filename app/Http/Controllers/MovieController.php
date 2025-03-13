<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use App\Http\Requests\MovieRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    public function store(MovieRequest $request)
    {
        $validatedData = $request->validated();

        Log::info('Movie data:', $validatedData);

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $validatedData['poster'] = $posterPath;
        }
        $movie = Movie::create($validatedData);

        $genres = Genre::whereIn('id', $validatedData['genres'])->get();
        $movie->genres()->sync($genres->pluck('id'));

        return redirect()->route('movie.list')->with('success', 'Movie created successfully');
    }

    public function index()
    {
        $movies = Movie::paginate(20);
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
}
