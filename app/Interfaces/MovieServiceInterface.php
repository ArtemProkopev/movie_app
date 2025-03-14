<?php

namespace App\Interfaces;

use App\Models\Movie;

interface MovieServiceInterface
{
    public function getList();
    
    public function createMovie(array $data): Movie;
    
    public function updateMovie(int $id, array $data): Movie;

    public function deleteMovie(int $id): bool;
}

