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
    Route::get('pelayanans', 'PelayananController@all');
    Route::post('pelayanans/new', 'PelayananController@new');
    Route::delete('pelayanans/delete/{id}', 'PelayananController@destroy');
    Route::get('pelayanans/{slug}', 'PelayananController@get');
    Route::post('pelayanans/update/{id}', 'PelayananController@update');

    Route::post('images', 'PelayananController@images');
});