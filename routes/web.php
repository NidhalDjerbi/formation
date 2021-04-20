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
Route::post('register_etudiant', 'AuthController@register_etudiant');
Route::post('logout_user', 'AuthController@logout');
Route::get('/', function () {
    return view('pages.login');
});
Route::get('/register_user', function () {
    return view('pages.register');
});
Route::get('/register_etudiant', function () {
    return view('pages.register_etudiant');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', function () {
        return view('pages.home');
    });
    Route::get('/waiting', function () {
        return view('pages.waiting');
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
    
    
    //cour routes
    Route::get('cour', ['as' => 'cour.index', 'uses' => 'CourController@index', 'middleware' => ['admin']]);
    Route::get('cour/create', ['as' => 'cour.create', 'uses' => 'CourController@create', 'middleware' => ['admin']]);
    Route::post('cour/create', ['as' => 'cour.store', 'uses' => 'CourController@store', 'middleware' => ['admin']]);
    Route::get('cour/show/{id}', ['as' => 'cour.show', 'uses' => 'CourController@show']);
    Route::get('cour/edit/{id}', ['as' => 'cour.edit', 'uses' => 'CourController@edit']);
    Route::post('cour/inscription/{id}', ['as' => 'cour.inscription', 'uses' => 'CourController@inscription', 'middleware' => ['etudiant']]);
    Route::post('cour/desinscription/{id}', ['as' => 'cour.desinscription', 'uses' => 'CourController@desinscription', 'middleware' => ['etudiant']]);
    Route::put('cour_update/{id}', ['as' => 'cour.update', 'uses' => 'CourController@update',]);
    Route::delete('cour_delete/{id}', ['as' => 'cour.destroy', 'uses' => 'CourController@destroy', 'middleware' => ['admin']]);
    Route::post('cour/search',  [ 'uses' => 'CourController@search', 'middleware' => ['admin']]);
    
    Route::get('cour/formation', ['as' => 'cour.cour_formation', 'uses' => 'CourController@cour_formation', 'middleware' => ['etudiant']]);
    Route::get('cour/etudiant', ['as' => 'cour.cour_etudiant', 'uses' => 'CourController@cour_etudiant', 'middleware' => ['etudiant']]);
    Route::get('cour/planning', ['as' => 'cour.planning', 'uses' => 'CourController@planning']);
    Route::post('cour/searchCourEtudiant',  [ 'uses' => 'CourController@searchCourEtudiant', 'middleware' => ['etudiant']]);
    Route::post('cour/searchCourFormation',  [ 'uses' => 'CourController@searchCourFormation', 'middleware' => ['etudiant']]);
    Route::post('cour/planning/search',  [ 'uses' => 'CourController@planningSearch', 'middleware' => ['etudiant']]);
    
    
    Route::get('cour/enseignant', ['as' => 'cour.cour_enseignant', 'uses' => 'CourController@cour_enseignant', 'middleware' => ['enseignant']]);
    Route::get('cour/planning/enseignant', ['as' => 'cour.planning_enseignant', 'uses' => 'CourController@planningEnseignant', 'middleware' => ['enseignant']]);
});
