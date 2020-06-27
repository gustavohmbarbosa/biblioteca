<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Reader extends Model
{
    use HasSlug;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'gender', 'grade', 'class', 'course_id', 'registration', 'entry_year', 'status', 'slug'
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
    
    /**
     * Relation with books
     */
    public function books()
    {
        return $this->belongsToMany(Book::class)
            ->withPivot([
                'estimated_date', 
                'return_date', 
                'status'])
            ->withTimestamps();
    }

    /**
     * Relation with courses
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Search reader
     * 
     * @param string $filter
     * @param string $column default: "name"
     */
    public function search($filter = null, $column = "name")
    {
        $results = $this->where(function ($query) use ($filter, $column) {
            if ($filter) {
                $query->where($column, 'LIKE', "%{$filter}%");
            }
        })->paginate(10);

        return $results;
    }
}
