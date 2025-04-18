<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HallSeat;
use App\Models\Hall;

class HallSeatSeeder extends Seeder
{
    public function run()
    {
        // Пример: Создаем места для первого зала
        $hall = Hall::first();

        HallSeat::create([
            'seat_number' => 'A1',  // Используем seat_number вместо number
            'row' => 'A',
            'price' => 500,
            'hall_id' => $hall->id
        ]);

        HallSeat::create([
            'seat_number' => 'A2',
            'row' => 'A',
            'price' => 500,
            'hall_id' => $hall->id
        ]);
    }
}