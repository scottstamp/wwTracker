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

Route::get('/food/{days?}', 'FoodDiaryController@index')->where(['days' => '^\-?[0-9]+']);
Route::get('/food/add', 'FoodDiaryController@add');
Route::get('/food/autocomplete', 'FoodDiaryController@autocomplete');
Route::get('/food/remove/{id}', 'FoodDiaryController@remove')->where(['id' => '[0-9]+']);
Route::post('/food/store', 'FoodDiaryController@store');

Auth::routes();