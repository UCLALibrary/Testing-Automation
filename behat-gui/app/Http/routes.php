<?php
/**
 * Auth Routes
 */
Route::get('logout', 'Auth\AuthController@logout');
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');
/**
 * Route for github payloads
 */
Route::post('/github', ['as' => 'triggers.githubpayload', 'uses' => 'TriggerController@github']);
/**
 * Route group to require authentication in all of the system routes
 */
Route::group(['middleware' => 'auth'], function(){
    /**
     * Redirect the root to the tests page.
     */
    Route::get('/', function () {
        return redirect()->route('tests.index');
    });
    /**
     * Map all of the routes for the tests controller
     */
    Route::resource("tests","TestController");
    /**
     * All of the custom routes for the tests
     */
    Route::group(['prefix' => 'tests'], function(){
        Route::get('/results', ['as' => 'tests.results', 'uses' => 'TestController@get_results']);
        Route::post('/execute/category', ['as' => 'tests.executeCategory', 'uses' => 'TestController@execute_category']);
        Route::post('/comments/{id}', ['as' => 'tests.comments', 'uses' => 'TestController@put_comments']);
        Route::get('/search', function(){
            return redirect()->route('tests.index');
        });
        Route::get('/search/{search}', ['as' => 'tests.search', 'uses' => 'TestController@search']);
        Route::get('/multiple/{tests}', ['as' => 'tests.destroy_multiple', 'uses' => 'TestController@destory_multiple']);
        Route::group(['prefix' => 'category'], function(){
            Route::get('/delete/{test}', ['as' => 'tests.category.delete', 'uses' => 'TestController@delete_category']);
            Route::get('/{test}', ['as' => 'tests.category', 'uses' => 'TestController@category']);
            Route::post('/{test}', ['as' => 'tests.category', 'uses' => 'TestController@category_store']);
        });
        Route::group(['prefix' => 'groups'], function(){
            Route::get('/{groupid}', ['as' => 'tests.groups.show', 'uses' => 'TestController@group_show']);
        });
        Route::get('/execute/{tests}/', ['as' => 'tests.execute', 'uses' => 'TestController@execute']);
        Route::get('/compiled/{test}/{set}', ['as' => 'tests.compiled', 'uses' => 'TestController@compiled']);
    });

    Route::post('/tests', ['as' => 'tests.store', 'uses' => 'TestController@store']);

    /**
     * Reports Routes
     */
    Route::group(['prefix' => 'reports'], function(){
        Route::get('/', ['as' => 'reports.index', 'uses' => 'ReportController@index']);
    });
    /**
     * Variables Routes
     */
    Route::resource("variables","VariableController");
    Route::group(['prefix' => 'variables'], function(){
        Route::get('/variables/delete/{id}/{set}', ['as' => 'variables.deleteValue', 'uses' => 'VariableController@delete_value']);
        Route::get('/variables/upload', ['as' => 'variables.upload', 'uses' => 'VariableController@upload']);
        Route::post('/variables/upload', ['as' => 'variables.upload', 'uses' => 'VariableController@upload_store']);
    });
    /**
     * Ajax Routes
     */
    Route::group(['prefix' => 'ajax'], function(){
        Route::get('/notifications', ['uses' => 'AjaxController@notification']);
        Route::get('/kill_notifications/{id}', ['uses' => 'AjaxController@kill_notification']);
    });

    /**
     * Triggers Routes
     */
    Route::group(['prefix' => 'triggers'], function(){
        Route::get('/github', ['as' => 'triggers.github', 'uses' => 'TriggerController@github_config']);
        Route::post('/github/save', ['as' => 'triggers.github_save', 'uses' => 'TriggerController@github_config_post']);
        Route::get('/jira', ['as' => 'triggers.jira', 'uses' => 'TriggerController@jira_config']);
        Route::post('/jira', ['as' => 'triggers.jira_save', 'uses' => 'TriggerController@jira_config_post']);
    });

    /**
     * Resources that are mapped without customization
     */
    Route::resource("schedulers","SchedulerController");
    Route::resource("sets","SetController");
    Route::resource("feature_contexts","FeatureContextController");
    Route::resource("roles","RoleController");
    Route::resource("permissions","PermissionController");
    Route::resource("categories","CategoryController");

});