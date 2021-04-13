<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('login_user', 'AuthController@authenticate');
Route::post('register_user', 'AuthController@register_user');
Route::post('logout_user', 'AuthController@logout');
Route::get('/', function () {
    return view('pages.login');
});
Route::get('/register_user', function () {
    return view('pages.register');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', function () {
        return view('pages.home');
    });

    // user routes
    Route::get('user', ['as' => 'user.index', 'uses' => 'UserController@index', 'middleware' => ['admin']]);
    Route::get('user/create', ['as' => 'user.create', 'uses' => 'UserController@create', 'middleware' => ['admin']]);
    Route::post('user/create', ['as' => 'user.store', 'uses' => 'UserController@store', 'middleware' => ['admin']]);
    Route::get('user/show/{id}', ['as' => 'user.show', 'uses' => 'UserController@show']);
    Route::get('user/edit/{id}', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
    Route::put('user_update/{id}', ['as' => 'user.update', 'uses' => 'UserController@update',]);
    Route::delete('user_delete/{id}', ['as' => 'user.destroy', 'uses' => 'UserController@destroy', 'middleware' => ['admin']]);
    Route::post('user/search',  [ 'uses' => 'UserController@search', 'middleware' => ['admin']]);

    //formation routes
    Route::get('formation', ['as' => 'formation.index', 'uses' => 'FormationController@index', 'middleware' => ['admin']]);
    Route::get('formation/create', ['as' => 'formation.create', 'uses' => 'FormationController@create', 'middleware' => ['admin']]);
    Route::post('formation/create', ['as' => 'formation.store', 'uses' => 'FormationController@store', 'middleware' => ['admin']]);
    Route::get('formation/show/{id}', ['as' => 'formation.show', 'uses' => 'FormationController@show']);
    Route::get('formation/edit/{id}', ['as' => 'formation.edit', 'uses' => 'FormationController@edit']);
    Route::put('formation_update/{id}', ['as' => 'formation.update', 'uses' => 'FormationController@update',]);
    Route::delete('formation_delete/{id}', ['as' => 'formation.destroy', 'uses' => 'FormationController@destroy', 'middleware' => ['admin']]);

});
