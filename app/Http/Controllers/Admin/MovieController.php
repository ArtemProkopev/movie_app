<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(10);
        return view('movie.movie_list', compact('movies'));
    }
    
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movie.movie_detail', compact('movie'));
    }
}