<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Ticket extends Model
{
    protected $fillable = [
        'schedule_id', 'user_id', 'hall_seat_id',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hallSeat(): BelongsTo
    {
        return $this->belongsTo(HallSeat::class, 'hall_seat_id');
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}