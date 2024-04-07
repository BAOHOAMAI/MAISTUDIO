<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;
    protected $table = 'favourite';
    public $timestamps = false;
    
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
