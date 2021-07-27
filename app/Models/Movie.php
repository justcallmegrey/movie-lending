<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;

    public $table = 'movies';

    protected $fillable = [
        'title',
        'genre',
        'released_date',
        'is_rented',
    ];

    # Relationship
    public function lendings()
    {
        return $this->hasMany(Lending::class);
    }

    # Scopes
    public function scopeFilterByGenre($query, $genre)
    {
        if (!empty($genre)) {
          $query = $query->where('genre', $genre);
        }
        return $query;
    }

    public function scopeIsAvailable($query)
    {
        return $query->where('is_rented', false);
    }
}
