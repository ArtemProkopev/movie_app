<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->take(5)->get(); 
        return view('home', compact('movies'));
    }
}

