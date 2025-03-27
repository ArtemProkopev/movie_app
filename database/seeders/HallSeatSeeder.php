<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HallSeat;

class HallSeatSeeder extends Seeder
{
    public function run()
    {
        if (\App\Models\Hall::where('id', 1)->exists()) {
            HallSeat::create([
                'seat_number' => 'A1',
                'row' => 'A',
                'hall_id' => 1,  
                'seat_id' => 1,  
            ]);

            HallSeat::create([
                'seat_number' => 'A2',
                'row' => 'A',
                'hall_id' => 1,
                'seat_id' => 2, 
            ]);

            HallSeat::create([
                'seat_number' => '5',
                'row' => 'A',
                'hall_id' => 1,
                'seat_id' => 3, 
            ]);
        } else {
            $this->command->error('Запись с hall_id = 1 не существует в таблице halls.');
        }
    }
}