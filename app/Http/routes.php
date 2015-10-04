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

Route::get('/', 'HomeController@index');

Route::get('contact', 'HomeController@contact');

Route::get('tables', 'TableController@index');
Route::post('tables.sort', 'TableController@sortTables');
Route::post('tables.filter', 'TableController@filterTables');
Route::get('tables/show/{id}', 'TableController@show');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);