<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HallSeat;

class HallSeatSeeder extends Seeder
{
    public function run()
    {
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
    }
}
