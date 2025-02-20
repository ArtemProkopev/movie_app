<?php

namespace App\Http\Controllers;

use App\Services\MovieService;

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
        // dd($movies);
        return view('movie.movie_list', compact('movies'));
    }
}
