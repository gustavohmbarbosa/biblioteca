<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Book extends Model
{
    use HasSlug;

    protected $fillable = [
        'title', 'subtitle', 'origin', 'price', 'isbn', 'synopsis', 'pages', 'language', 'observations', 'edition', 'publication_date', 'color', 'cdd', 'cape', 'company', 'author', 'slug'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
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
