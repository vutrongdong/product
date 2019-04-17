<?php

Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {
	Route::get('/', 'RootController@index');
	Route::get('/{vue_capture?}', 'RootController@index')->where('vue_capture', '[\/\w\.-]*')->name('vue');
});


