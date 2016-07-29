<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trigger extends Model
{
    protected $fillable = [
        'key',
        'value',
        'namespace'
    ];
}
