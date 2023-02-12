<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'year',
        'synopsis',
        'genre'
    ];
    function __construct(string $title = null, int $year = null, string $synopsis = null, string $genre = null){
        $this->title = $title;
        $this->year = $year;
        $this->synopsis = $synopsis;
        $this->genre = $genre;
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
