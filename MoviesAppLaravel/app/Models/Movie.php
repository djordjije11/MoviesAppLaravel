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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
