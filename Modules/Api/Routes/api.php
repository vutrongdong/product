<?php

use Illuminate\Http\Request;

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
    Route::get('/categories/blog/', 'CategoryController@getCategoriesForBlog');
    Route::get('/categories/children/', 'CategoryController@getCategoriesForMenu');
    Route::post('/category/create', 'CategoryController@createCategory');
    Route::put('/category/update/{id}', 'CategoryController@updadeCategory');
    Route::delete('/category/{id}', 'CategoryController@removeCategory');
    Route::post('/blogs/upload', 'BlogController@uploadImage');
    Route::post('/blog/create/', 'BlogController@createBlog');
    Route::get('/blogs', 'BlogController@index');
    Route::get('/blog/{id}', 'BlogController@show');
    Route::put('/blog/update/{id}', 'BlogController@updadeBlog');
    Route::delete('/blog/{id}', 'BlogController@removeBlog');
});