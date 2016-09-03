<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'user_id'
    ];

    protected $casts = [
        'tests' => 'array',
        'results' => 'array'
    ];
}
