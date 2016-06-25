<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource("tests","TestController");
Route::get('/tests/execute/{tests}', ['as' => 'tests.execute', 'uses' => 'TestController@execute']);

Route::resource("variables","VariableController");
Route::resource("schedulers","SchedulerController");
