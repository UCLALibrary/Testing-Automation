<?php

namespace App\Http\Controllers;

use App\TestResult;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReportController extends Controller
{
    public function index(){

        $results = TestResult::where('id', '!=', 0)->orderBy('created_at', 'desc')->get();
        return view('reports.index', compact('results'));
    }
}
