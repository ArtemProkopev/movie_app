<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    public function run()
    {
        Seat::create([
            'place' => 1,
            'row' => 1,
            'price' => 500,
        ]);

        Seat::create([
            'place' => 2,
            'row' => 1,
            'price' => 500,
        ]);

        Seat::create([
            'place' => 3,
            'row' => 1,
            'price' => 500,
        ]);
    }
}