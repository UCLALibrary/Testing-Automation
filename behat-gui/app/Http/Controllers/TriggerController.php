<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TriggerController extends Controller
{
    /*
     * When github sends a payload...
     *
     * do something.
     *
     */
    public function github(Request $request){

    }

    public function github_config(){


        return view('triggers.github');
    }
}
