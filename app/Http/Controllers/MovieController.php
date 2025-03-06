<?php

namespace App\Http\Controllers;

use App\Services\MovieService;
use App\Models\Movie;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
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
}