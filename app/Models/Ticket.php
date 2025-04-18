<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'schedule_id', 
        'user_id', 
        'hall_seat_id', 
        'price',
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

    // public function seat(): BelongsTo
    // {
    //     return $this->belongsTo(Seat::class, 'hall_seat_id', 'id');
    // }

    public function getHallNameAttribute()
    {
        return $this->hallSeat?->hall?->name ?? 'Неизвестный зал';
    }

    public function getSeatInfoAttribute()
    {
        return $this->hallSeat 
            ? "Ряд {$this->hallSeat->row}, Место {$this->hallSeat->seat_number}"
            : 'Место не найдено';
    }
}