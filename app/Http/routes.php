<?php

	/*
	|--------------------------------------------------------------------------
	| Application Routes
	|--------------------------------------------------------------------------
	|
	| This route group applies the "web" middleware group to every route
	| it contains. The "web" middleware group is defined in your HTTP
	| kernel and includes session state, CSRF protection, and more.
	|
	*/

	Route::group( [ 'middleware' => [ 'web' ] ], function () {
		Route::get( '/', 'HomeController@index' );
		// Authentication Routes...
		Route::get( 'login', 'Auth\AuthController@showLoginForm' );
		Route::get( 'logout', 'Auth\AuthController@logout' );

		Route::get( 'auth/google', 'Auth\AuthController@redirectToProvider' )->name( 'auth.google' );
		Route::get( 'auth/google/callback', 'Auth\AuthController@handleProviderCallback' );

		Route::group( [ 'middleware' => [ 'auth' ] ], function () {
			Route::resource( 'group', 'GroupController' );
			Route::resource( 'password', 'PasswordController' );
		} );
	} );
