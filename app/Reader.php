<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'gender', 'year', 'class', 'course', 'registration', 'status'
    ];

    protected $hidden = [
        'password',
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
    
    public function addBook($book_id, $data)
    {   
        return $this->books()->attach($book_id,[
            'estimated_date' => $data['estimated_date'], 
            ]);
    }

    public function removeBook($book_id)
    {
        return $this->books()->detach($book_id);
    }
}
