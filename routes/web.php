<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::get('/food/{days?}', 'FoodController@index')->where(['days' => '[0-9]+']);
Route::get('/food/add', 'FoodController@add');
Route::get('/food/autocomplete', 'FoodController@autocomplete');
Route::post('/food/store', 'FoodController@store');

Auth::routes();