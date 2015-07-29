<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(array('middleware' => 'auth'), function()
{
    Route::resource('articles', 'ArticlesController',
        ['only' => ['create', 'store', 'update', 'destroy', 'edit']]);
});


Route::resource('articles', 'ArticlesController',
    ['only' => ['index', 'show']]);

Route::get('/', ['as' => 'main', 'uses' => 'ArticlesController@index']);
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');

// Posts
Route::get('{id}', ['as' => 'post_by_id', 'uses' => 'ArticlesController@show'])
    ->where(['id' => '[0-9]+']);
Route::get('{path}.html', ['as' => 'post', 'uses' => 'ArticlesController@show'])
    ->where(['path' => '.+']);