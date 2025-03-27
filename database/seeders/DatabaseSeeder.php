<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            GenreSeeder::class,
            MovieSeeder::class,
            UserSeeder::class,
            ScheduleSeeder::class,
            HallSeeder::class,
            SeatSeeder::class,
            HallSeatSeeder::class,
        ]);
    }
}
