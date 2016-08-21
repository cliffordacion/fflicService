<?php

Route::group(
    [ 'prefix' => '/frontend'],
    function () {
		Route::get('/', 'HomeController@index');

		Route::get('/home', 'HomeController@index');
		
		// Authentication generated
		// Route::auth();

		// Authentication Routes...
		Route::get('/login', ['uses' => 'Auth\AuthController@showLoginForm']);
		Route::post('/login', ['uses' => 'Auth\AuthController@login']);
		Route::get('/logout', ['uses' => 'Auth\AuthController@logout']);

		//Frontend user registration
		Route::get('/register', ['uses' => 'Auth\AuthController@showRegistrationForm']);
		Route::post('/register', ['uses' => 'Auth\AuthController@register']);
	}
);