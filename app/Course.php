<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'id','name'
    ];

    /**
     * Relation with readers
     */
    public function readers()
    {
        return $this->hasMany(Reader::class)
            ->withPivot([
                'estimated_date', 
                'return_date', 
                'status'])
            ->withTimestamps();
    }
}
