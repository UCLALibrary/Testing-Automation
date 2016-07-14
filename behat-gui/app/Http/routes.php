<?php

Route::get('/', function () {
    return redirect()->route('tests.index');
});
Route::get('/reports', ['as' => 'reports.index', 'uses' => 'ReportController@index']);
Route::get('/tests/results', ['as' => 'tests.results', 'uses' => 'TestController@get_results']);
Route::post('/tests/execute/category', ['as' => 'tests.executeCategory', 'uses' => 'TestController@execute_category']);
Route::post('/tests/comments/{id}', ['as' => 'tests.comments', 'uses' => 'TestController@put_comments']);
Route::resource("tests","TestController");
Route::resource("variables","VariableController");
Route::resource("schedulers","SchedulerController");
Route::resource("sets","SetController");
Route::resource("feature_contexts","FeatureContextController");
Route::resource("githubs","GithubController");
Route::post('/github/payload', ['as' => 'githubs.payload', 'uses' => 'GithubController@payload']);

Route::get('/tests/category/delete/{test}', ['as' => 'tests.deleteCategory', 'uses' => 'TestController@delete_category']);
Route::get('/tests/category/{test}', ['as' => 'tests.category', 'uses' => 'TestController@category']);
Route::post('/tests/category/{test}', ['as' => 'tests.category', 'uses' => 'TestController@category_store']);
Route::get('/tests/execute/{tests}/', ['as' => 'tests.execute', 'uses' => 'TestController@execute']);

Route::get('/variables/delete/{id}/{set}', ['as' => 'variables.deleteValue', 'uses' => 'VariableController@delete_value']);

Route::get('/services', ['as' => 'services.index', 'uses' => 'ServiceController@index']);