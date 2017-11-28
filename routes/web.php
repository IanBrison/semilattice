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

Route::view('/', 'top');
Route::group(['prefix' => '/admin', 'middleware' => 'auth:web'], function () {
    Route::get('/', 'AdminController@getIndex');
    Route::get('/categories', 'AdminController@getCategories');
    Route::post('/category', 'AdminController@createCategory');
    Route::post('/connection', 'AdminController@createConnection');
});
Route::get('/login', 'Auth\LoginController@getLogin')->name('login');
Route::post('/login', 'Auth\LoginController@login');