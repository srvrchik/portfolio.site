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

Route::get('/', 'FrontController@index');

Route::get('/about', 'FrontController@about')->name('about');

Route::get('/portfolio', 'FrontController@portfolio')->name('portfolio');

Route::get('/contact', 'FrontController@contact')->name('contact');

Route::get('/admin{any}', function () {
    return view('admin.pages.index');
})->where('any', '.*')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user', 'UserController@user')->name('user');
Route::post('/user/change/theme', 'UserController@changeTheme')->name('user.change.theme');
