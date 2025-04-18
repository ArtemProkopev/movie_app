<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hall;

class HallSeeder extends Seeder
{
    public function run()
    {
        Hall::create([
            'name' => 'Основной зал',
            'type' => 'regular'
        ]);
        
        Hall::create([
            'name' => 'IMAX Зал',
            'type' => 'IMAX'
        ]);
    }
}