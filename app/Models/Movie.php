<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int $duration
 * @property string $country
 * @property \Carbon\Carbon $release_date
 * @property int $rating
 * @property string $poster
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Genre[] $genres
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Schedule[] $schedules
 */
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

    public function genres(): BelongsToMany 
    {
        return $this->belongsToMany(Genre::class, 'movie_genre', 'movie_id', 'genre_id');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
