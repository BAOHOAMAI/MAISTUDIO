<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'rating';
    public $timestamps = false;

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

}
