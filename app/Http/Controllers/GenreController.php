<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function create()
    {
        return view('genre.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:genres,name'],
        ]);

        Genre::create([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('genre.create')->with('success', 'Жанр добавлен!');
    }

    public function index()
    {
        $genres = Genre::all();
        return view('genre.index', compact('genres'));
    }
}

