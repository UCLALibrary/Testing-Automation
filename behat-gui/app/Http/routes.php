<?php

Route::get('/', function () {
    return redirect()->route('tests.index');
});

Route::resource("tests","TestController");
Route::resource("variables","VariableController");
Route::resource("schedulers","SchedulerController");
Route::resource("sets","SetController");
Route::resource("feature_contexts","FeatureContextController");
Route::resource("githubs","GithubController");
Route::post('/github/payload', ['as' => 'githubs.payload', 'uses' => 'GithubController@payload']);
Route::get('/tests/execute/{tests}/', ['as' => 'tests.execute', 'uses' => 'TestController@execute']);
