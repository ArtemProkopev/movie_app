<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'duration',
        'country',
        'release_date',
        'rating',
        'poster',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($movie) {
            if (empty($movie->slug)) {
                $movie->slug = Str::slug($movie->title);
            }
        });
    }

    public function getImageUrlAttribute()
    {
        return $this->poster ? asset('storage/' . $this->poster) : asset('storage/posters/default-poster.jpg');
    }

    public function genres(): BelongsToMany 
    {
        return $this->belongsToMany(Genre::class, 'movie_genre', 'movie_id', 'genre_id');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
