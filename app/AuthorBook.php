<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorBook extends Model
{
    protected $table = 'author_book';

    protected $fillable = [
        'author_id', 'book_id'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class)
            ->withPivot([
                'estimated_date', 
                'return_date', 
                'status'])
            ->withTimestamps();
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class)
            ->withTimestamps();
    }
}
