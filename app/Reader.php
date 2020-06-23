<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Reader extends Model
{
    use HasSlug;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'gender', 'grade', 'class', 'course', 'registration', 'entry_year', 'status', 'slug'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

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
