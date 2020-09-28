<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorBook extends Model
{
    protected $table = 'author_book';

    protected $fillable = [
        'author_id', 'book_id', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'created_at'     => 'datetime:d/m/Y H:i:s',
        'updated_at'     => 'datetime:d/m/Y H:i:s',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class)
            ->withTimestamps();
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class)
            ->withTimestamps();
    }
}
