<?php

namespace App\Services;

use App\Models\Movie;

class MovieService
{
    public function getList()
    {
        return Movie::paginate(20);
    }
}
