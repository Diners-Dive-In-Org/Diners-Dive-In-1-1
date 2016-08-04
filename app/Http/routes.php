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

Route::get('/', function () {
    return view('home.index');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/business/home', 'BusinessController@index');
Route::get('/business/register', 'BusinessController@register');
Route::post('/business', 'BusinessController@store');
Route::delete('/business/{business}', 'BusinessController@destroy');
