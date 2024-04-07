<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'movies';
    public function category () {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function genre () {
        return $this->belongsTo(Genre::class,'genre_id','id');
    }
    public function movie_genre () {
        return $this->belongsToMany(Genre::class,'movie_genre','movie_id','genre_id');
    }
    public function episode () {
        return $this->HasMany(Episode::class);
    }
    public function comment () {
        return $this->HasMany(Comment::class);
    }
    public function rating () {
        return $this->HasMany(Rating::class);
    }
}
