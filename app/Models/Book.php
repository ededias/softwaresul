<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    use HasFactory;

    //
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'genre',
        'year',
        'image',
        'quantity',
        'description',
        'published_at',
    ];


    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

}
