<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'origin', 'price', 'isbn', 'synopsis', 'pages', 'language', 'observations', 'edition', 'publication_date', 'color', 'cdd', 'cape', 'company', 'author'
    ];
}
