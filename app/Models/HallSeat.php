<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HallSeat extends Model
{
    protected $fillable = [
        'seat_number',
        'row',
        'price',
        'hall_id',
        // 'seat_id'
    ];

    // public function seat(): BelongsTo
    // {
    //     return $this->belongsTo(Seat::class);
    // }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }
}