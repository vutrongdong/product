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

Route::prefix('/')->group(function () {
    Route::get('/user', 'UserController@index');
    Route::put('/user/reset_pass/{id}', 'UserController@resetPass');
    Route::post('/slides/upload', 'SlideController@uploadImage');
    Route::post('/slide/create/', 'SlideController@create');
    Route::put('/slide/update/{id}', 'SlideController@update');
    Route::get('/slides', 'SlideController@index');
    Route::get('/slide/{id}', 'SlideController@show');
    Route::delete('/slide/{id}', 'SlideController@destroy');
    Route::get('/categories', 'CategoryController@index');
    Route::get('/category/{id}', 'CategoryController@show');
    Route::get('/categories/parent/{diffIdCurent}', 'CategoryController@getCategoriesForSelect');
    Route::get('/categories/children/', 'CategoryController@getCategoriesForMenu');
    Route::post('/category/create', 'CategoryController@createCategory');
    Route::put('/category/update/{id}', 'CategoryController@updadeCategory');
    Route::delete('/category/{id}', 'CategoryController@removeCategory');
});