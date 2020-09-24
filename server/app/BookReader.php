<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookReader extends Model
{
    protected $table = 'book_reader';

    protected $fillable = [
        'reader_id', 'book_id', 'estimated_date',
        'return_date', 'status', 'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at'     => 'datetime:d/m/Y H:i:s',
        'updated_at'     => 'datetime:d/m/Y H:i:s',
        'estimated_date' => 'date:d/m/Y'
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

    public function readers()
    {
        return $this->belongsToMany(Reader::class)
            ->withPivot([
                'estimated_date',
                'return_date',
                'status'])
            ->withTimestamps();
    }
}
