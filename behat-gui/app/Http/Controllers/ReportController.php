<?php

namespace App\Http\Controllers;

use App\TestResult;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReportController extends Controller
{
    public function index(){

        $results = TestResult::all();
        return view('reports.index', compact('results'));
    }
}
