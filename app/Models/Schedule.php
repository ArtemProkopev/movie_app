<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Schedule extends Model
{
    protected $fillable = [
        'date',
        'time_from',
        'time_to',
        'movie_id',
        'hall_id',
        'start_time', // Добавлено
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime', // Добавлено
    ];

    protected $appends = ['start_date_time'];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'schedule_id');
    }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class, 'hall_id');
    }

    public function getStartDateTimeAttribute()
    {
        return Carbon::parse($this->start_time);
    }

    public function getFormattedDate()
    {
        return $this->date ? $this->date->format('d.m.Y') : 'Дата не задана';
    }
}
