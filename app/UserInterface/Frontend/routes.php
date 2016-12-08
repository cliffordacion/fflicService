<?php

	Route::get('/', function () {
	    return redirect()->route('frontend_home');
	    //return view('welcome');
	});
	Route::group(
	    [ 'prefix' => '/frontend'],
	    function () {
			Route::get('/', 'HomeController@index')
				->name('frontend_home');

			Route::get('/home', 'HomeController@index');
			
			// Authentication generated
			// Route::auth();

			// Authentication Routes...
			Route::get('/login', ['uses' => 'Auth\AuthController@showLoginForm']);
			Route::post('/login', ['uses' => 'Auth\AuthController@login']);
			Route::get('/logout', ['uses' => 'Auth\AuthController@logout']);

			//Frontend user registration
			Route::get('/register', ['uses' => 'FrontendUserController@showRegistrationForm']);
			Route::post('/register', ['uses' => 'FrontendUserController@register']);
			Route::get('/user/activation/{activationLink}', ['uses' => 'FrontendUserController@activateUser'])
				->name('user.activate');

			//Loan a book
			Route::post('/loan', ['uses' => 'TransactionController@loan']);

			//cancel an failed transaction
			Route::post('/confirmFailed', ['uses' => 'TransactionController@confirmFailed']);
			Route::post('/confirmDelivered', ['uses' => 'TransactionController@confirmDelivered']);
			Route::post('/cancelTransaction', ['uses' => 'TransactionController@cancelTransaction']);

			//Profile
			Route::get('/profile', ['uses' => 'FrontendUserController@profile']);
			Route::get('/profile/update', ['uses' => 'FrontendUserController@profileUpdate']);
			Route::post('/profile/save', ['uses' => 'FrontendUserController@profileSave']);
			Route::post('/profile/saveId', ['uses' => 'FrontendUserController@profileSaveId']);

		}
	);


