<?php

namespace App\Services;

use App\Models\Genre;

class GenreService
{
    public function getListByName(array $data)
    {
        return Genre::query()->whereIn('name', $data)->get();
    }
}
