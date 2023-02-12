<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'reviewer_id',
        'movie_id',
        'rating',
        'comment'
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    public function reviewer()
    {
        return $this->belongsTo(Reviewer::class);
    }
}
