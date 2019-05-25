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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('photo/create', 'Admin\PhotoController@add');
    Route::post('photo/create', 'Admin\PhotoController@create');
    Route::get('photo/edit', 'Admin\PhotoController@edit');
    Route::post('photo/edit', 'Admin\PhotoController@update');
    Route::get('photo/delete', 'Admin\PhotoController@delete');
    Route::get('photo', 'Admin\PhotoController@index');

    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::post('profile/create', 'Admin\ProfileController@create');
    Route::get('profile/edit', 'Admin\ProfileController@edit');
    Route::post('profile/edit', 'Admin\ProfileController@update');
    Route::get('profile/delete', 'Admin\ProfileController@delete');
    Route::get('profile', 'Admin\ProfileController@index');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'PhotoController@index');
Route::get('/profile', 'PhotoController@profile');
Route::get('/photo/show/{id}', 'PhotoController@show');

Route::get('/likes/create', 'LikesController@create');
Route::get('/likes/delete', 'LikesController@delete');
Route::post('photo/{post}/likes/{like}', 'LikesController@index');
