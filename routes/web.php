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

Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    Route::get('news/create', 'Users\NewsController@add');
    Route::post('news/create', 'Users\NewsController@create');
    Route::get('news', 'Users\NewsController@index');
    Route::get('news/edit', 'Users\NewsController@edit');
    Route::post('news/edit', 'Users\NewsController@update');
    Route::get('news/delete', 'Users\NewsController@delete');
    // Route::get('profile/create', 'Users\ProfileController@add');
    // Route::post('profile/create', 'Users\ProfileController@create');
    Route::get('profile/edit', 'Users\ProfileController@edit');
    Route::post('profile/edit', 'Users\ProfileController@update');

});

Auth::routes();
Route::get('admin/', 'Admin\AdminController@index')->middleware('auth');
Route::get('profile/{id}/show', 'ProfileController@show');

Route::get('news/{id}/show', 'NewsController@show');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'NewsController@index');
