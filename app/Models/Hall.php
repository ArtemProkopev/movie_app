<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hall extends Model
{
    protected $fillable = [
        'name',
        'type'
    ];

    public function hallSeats(): HasMany
    {
        return $this->hasMany(HallSeat::class, 'hall_id');
    }
}
