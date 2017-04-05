<?php

	Route::get('/', function () {
	    return redirect()->route('courier_home');
	    //return view('welcome');
	});
	Route::group(
	    [ 'prefix' => '/courier'],
	    function () {
			Route::get('/', 'HomeController@index')
				->name('courier_home');

			Route::get('/home', 'HomeController@index');
			
			// Authentication generated
			// Route::auth();

			// Authentication Routes...
			Route::get('/login', ['uses' => 'Auth\AuthController@showLoginForm']);
			Route::post('/login', ['uses' => 'Auth\AuthController@login']);
			Route::get('/logout', ['uses' => 'Auth\AuthController@logout']);

			//Courier user registration
			Route::get('/register', ['uses' => 'CourierUserController@showRegistrationForm']);
			Route::post('/register', ['uses' => 'CourierUserController@register']);
			Route::get('/user/activation/{activationLink}', ['uses' => 'CourierUserController@activateUser'])
				->name('user.activate');

			//Loan a book
			Route::post('/loan', ['uses' => 'TransactionController@loan']);

			//cancel an failed transaction
			Route::post('/confirmFailed', ['uses' => 'TransactionController@confirmFailed']);
			Route::post('/confirmDelivered', ['uses' => 'TransactionController@confirmDelivered']);
			Route::post('/cancelTransaction', ['uses' => 'TransactionController@cancelTransaction']);

			//Profile
			Route::get('/profile', ['uses' => 'CourierUserController@profile']);
			Route::get('/profile/update', ['uses' => 'CourierUserController@profileUpdate']);
			Route::post('/profile/save', ['uses' => 'CourierUserController@profileSave']);
			Route::post('/profile/saveId', ['uses' => 'CourierUserController@profileSaveId']);

		}
	);


