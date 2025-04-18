<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    public function run()
{

    $hall = \App\Models\Hall::first();

    Schedule::create([
        'movie_id' => 1,
        'hall_id' => $hall->id,
        'date' => '2025-03-21',
        'time_from' => '12:00:00',
        'time_to' => '14:00:00',
        'start_time' => '2025-03-21 12:00:00',
    ]);
    
    Schedule::create([
        'movie_id' => 1,
        'hall_id' => $hall->id,
        'date' => '2025-03-22',
        'time_from' => '15:00:00',
        'time_to' => '17:00:00',
        'start_time' => '2025-03-22 15:00:00',
    ]);
}
}
