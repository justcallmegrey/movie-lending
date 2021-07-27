<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lending extends Model
{
    use SoftDeletes;

    public $table = 'lendings';

    protected $fillable = [
        'movie_id',
        'member_id',
        'lending_date',
        'due_date',
        'returned_date',
        'lateness_charge',
    ];

    protected $dates = [
        'lending_date',
        'due_date',
        'returned_date',
    ];

    # Relationships
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

    # Scopes
    public function scopeActiveRent($query)
    {
        return $query->where('returned_date', '=', null);
    }

    public function scopeSearchByMovieTitle($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->whereHas('movie', function($query) use ($keyword) {
                $query->where('title', 'LIKE', '%'.$keyword.'%');
            })->get();
        }
        return $query;
    }

    public function scopeSearchByMemberName($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->whereHas('member', function($query) use ($keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
            })->get();
        }
        return $query;
    }
}
