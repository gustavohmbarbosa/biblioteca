<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'id','name'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class)
            ->withTimestamps();
    }
}
