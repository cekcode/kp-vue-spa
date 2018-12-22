<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::post('profiles/new', 'ProfileController@new');
    Route::get('profiles', 'ProfileController@all');
    Route::get('profiles/{slug}', 'ProfileController@get');
    Route::get('profiles/edit/{slug}', 'ProfileController@get');
    Route::delete('profiles/delete/{id}', 'ProfileController@destroy');
    Route::post('profiles/update/{id}', 'ProfileController@update');
    Route::get('perans', 'PeranController@all');
    Route::post('perans/new', 'PeranController@new');
    Route::delete('perans/delete/{id}', 'PeranController@destroy');
    Route::post('perans/update/{id}', 'PeranController@update');
    Route::get('kategoris', 'KategoriController@all');
    Route::post('kategoris/new', 'KategoriController@new');
    Route::delete('kategoris/delete/{id}', 'KategoriController@destroy');
    Route::post('kategoris/update/{id}', 'KategoriController@update');
    Route::get('kategoris/{slug}', 'KategoriController@get');
 
    Route::post('images', 'ImageController@upload');
});