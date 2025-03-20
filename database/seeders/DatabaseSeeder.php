<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GenreSeeder::class,
            MovieSeeder::class,
            UserSeeder::class,
            ScheduleSeeder::class,
            HallSeatSeeder::class,
        ]);
    }
}

