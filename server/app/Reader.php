<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Reader extends Authenticatable implements JWTSubject
{
    use HasSlug;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'gender', 'grade', 'class', 'course_id', 'registration', 'entry_year', 'status', 'slug', 'image'
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
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Search reader
     *
     * @param string $filter
     * @param string $column
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
