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

Route::view('/', 'top')->name('top');
Route::get('/register', 'ExperimentController@getRegister');
Route::post('/register', 'ExperimentController@postRegister');
Route::group(['prefix' => '/admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', 'AdminController@getIndex');
    Route::get('/categories', 'AdminController@getCategories');
    Route::get('/results', 'AdminController@getSubjectResults');
    Route::get('/quizzes', 'AdminController@getQuizzes');
    Route::get('/quizzes/search/{keyword}', 'AdminController@getSearchQuizzes');
    Route::post('/quiz/delete', 'AdminController@postCreateQuiz');
    Route::post('/quiz/create', 'AdminController@postDeleteQuiz');
    Route::post('/category', 'AdminController@createCategory');
    Route::post('/connection', 'AdminController@createConnection');
    Route::post('/content', 'AdminController@createContent');
    Route::post('/category_content', 'AdminController@createCategoryContent');
    Route::get('/category_vue', 'AdminController@getCategoryVue');
    Route::get('/category/{id}', 'AdminController@getChilds');
});
Route::group(['prefix' => '/exp', 'middleware' => 'auth:subject'], function () {
    Route::get('/', 'ExperimentController@getIndex');
    Route::get('/{quiz_num}/{category_id}', 'ExperimentController@getExperiment');
    Route::get('/result/{quiz_num}/{content_id}', 'ExperimentController@getResult');
});
Route::get('/thank_you', 'ExperimentController@getThankYou');
Route::get('/login', 'Auth\LoginController@getLogin');
Route::post('/login', 'Auth\LoginController@login');