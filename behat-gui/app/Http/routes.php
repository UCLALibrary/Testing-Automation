<?php

Route::get('/', function () {
    return redirect()->route('tests.index');
});

Route::resource("tests","TestController");
Route::get('/tests/execute/{tests}', ['as' => 'tests.execute', 'uses' => 'TestController@execute']);

Route::resource("variables","VariableController");
Route::resource("schedulers","SchedulerController");
Route::resource("sets","SetController");
Route::resource("feature_contexts","FeatureContextController");
Route::resource("github","GithubController");
Route::post('/github/payload', ['as' => 'githubs.payload', 'uses' => 'GithubController@payload']);