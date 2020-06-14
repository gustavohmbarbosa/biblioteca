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
    
}
