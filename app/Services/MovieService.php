<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Routing\Route;

class MovieService
{
    public function getList()
    {
        return Movie::paginate(20);
    }
}
