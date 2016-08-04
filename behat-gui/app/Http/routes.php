<?php

Route::get('logout', 'Auth\AuthController@logout');
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', function () {
        return redirect()->route('tests.index');
    });
    Route::get('/reports', ['as' => 'reports.index', 'uses' => 'ReportController@index']);
    Route::get('/tests/results', ['as' => 'tests.results', 'uses' => 'TestController@get_results']);
    Route::post('/tests/execute/category', ['as' => 'tests.executeCategory', 'uses' => 'TestController@execute_category']);
    Route::post('/tests/comments/{id}', ['as' => 'tests.comments', 'uses' => 'TestController@put_comments']);
    Route::get('/tests/search', function(){
        return redirect()->route('tests.index');
    });
    Route::get('/tests/search/{search}', ['as' => 'tests.search', 'uses' => 'TestController@search']);

    Route::resource("tests","TestController");
    Route::resource("variables","VariableController");
    Route::resource("schedulers","SchedulerController");
    Route::resource("sets","SetController");
    Route::resource("feature_contexts","FeatureContextController");

    Route::get('/github', ['as' => 'triggers.github', 'uses' => 'TriggerController@github_config']);
    Route::post('/github/save', ['as' => 'triggers.github_save', 'uses' => 'TriggerController@github_config_post']);

    Route::get('/jira', ['as' => 'triggers.jira', 'uses' => 'TriggerController@jira_config']);
    Route::post('/jira', ['as' => 'triggers.jira_save', 'uses' => 'TriggerController@jira_config_post']);

    Route::get('/tests/category/delete/{test}', ['as' => 'tests.deleteCategory', 'uses' => 'TestController@delete_category']);
    Route::get('/tests/category/{test}', ['as' => 'tests.category', 'uses' => 'TestController@category']);
    Route::post('/tests/category/{test}', ['as' => 'tests.category', 'uses' => 'TestController@category_store']);
    Route::get('/tests/execute/{tests}/', ['as' => 'tests.execute', 'uses' => 'TestController@execute']);
    Route::get('/tests/compiled/{test}/{set}', ['as' => 'tests.compiled', 'uses' => 'TestController@compiled']);

    Route::get('/variables/delete/{id}/{set}', ['as' => 'variables.deleteValue', 'uses' => 'VariableController@delete_value']);

    Route::get('/ajax/notifications', ['uses' => 'AjaxController@notification']);
    Route::get('/ajax/kill_notifications/{id}', ['uses' => 'AjaxController@kill_notification']);

    Route::resource("roles","RoleController");
    Route::resource("permissions","PermissionController");
    Route::resource("categories","CategoryController");

});

Route::post('/github', ['as' => 'triggers.github', 'uses' => 'TriggerController@github']);