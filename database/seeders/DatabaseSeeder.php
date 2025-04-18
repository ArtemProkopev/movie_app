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
            HallSeeder::class,
            HallSeatSeeder::class,
            ScheduleSeeder::class,
        ]);
    }
}
