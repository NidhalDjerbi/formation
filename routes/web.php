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
});
