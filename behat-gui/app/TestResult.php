<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $table = 'tests_results';

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
