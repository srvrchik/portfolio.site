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

Route::middleware('auth:api')->post('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users/list', 'Api\UsersController@users');
Route::post('/users/store', 'Api\UsersController@store');
Route::post('/users/{id}', 'Api\UsersController@user');
Route::post('/users/{id}/update', 'Api\UsersController@update');
Route::post('/users/{id}/delete', 'Api\UsersController@delete');
Route::post('/users/{id}/update/password', 'Api\UsersController@updatePassword');


Route::post('/portfolio', 'Api\PortfolioController@all');
Route::post('/portfolio/store', 'Api\PortfolioController@store');
Route::post('/portfolio/{id}', 'Api\PortfolioController@one');
Route::post('/portfolio/{id}/remove/image', 'Api\PortfolioController@removeImage');
Route::post('/portfolio/{id}/update', 'Api\PortfolioController@update');
Route::post('/portfolio/{id}/delete', 'Api\PortfolioController@delete');

Route::post('/skills', 'Api\SkillsController@all');
Route::post('/skills/store', 'Api\SkillsController@store');
Route::post('/skills/{id}', 'Api\SkillsController@skill');
Route::post('/skills/{id}/update', 'Api\SkillsController@update');
Route::post('/skills/{id}/delete', 'Api\SkillsController@delete');

Route::post('/categories', 'Api\CategoriesController@all');
Route::post('/categories/store', 'Api\CategoriesController@store');
Route::post('/categories/{id}', 'Api\CategoriesController@one');
Route::post('/categories/{id}/update', 'Api\CategoriesController@update');
Route::post('/categories/{id}/delete', 'Api\CategoriesController@delete');


