<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hall;

class HallSeeder extends Seeder
{
    public function run()
    {
        Hall::create([
            'id' => 1,
            'name' => 'Зал 1',
            'type' => 'regular',
        ]);
    }
}
