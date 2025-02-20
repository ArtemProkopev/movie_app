<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seat extends Model
{
    protected $fillable = [
        'place',
        'row',
        'price'
    ];

    public function hallSeats(): HasMany
    {
        return $this->hasMany(HallSeat::class, 'seat_id');
    }
}
