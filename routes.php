<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@home')
);

Route::get('product' , array('as' => 'products' , 'uses' => 'ProductController@showProduct') );

Route::get('product/{id}', array('as' => 'product' , 'uses' => 'ProductController@view') );

Route::get('news', array('uses' => 'NewsController@showNews') );

Route::get('/user/profile' , array(
	'as' => 'profile-user',
	'uses' => 'ProfileController@user'
));



/*
	Authenticated group
*/
Route::group(array('before' => 'auth'),function(){

	/*
		CSRF protection group
	*/
	Route::group( array('before' => 'crsf' ) ,function() {
		/*
			Change password (POST)
		*/
		Route::post('user/change_password' ,array(
			'as' => 'account-change-password-post',
			'uses' => 'AccountController@postChangePassword'
		)); 
	});

	/*
		Change password (GET)
	*/
	Route::get('user/change_password', array(
		'as' => 'account-change-password',
		'uses' => 'AccountController@getChangePassword'
	));

	/*
		Sign Out (GET)
	*/
	Route::get('user/sign_out',array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut'
	));

});



/*
	Unauthenticated group
*/
Route::group( array('before' => 'guest'), function(){

	/*
		CSRF protection group
	*/
	Route::group( array('before' => 'csrf') , function(){
		/*
			Create account(POST)
		*/
		Route::post('/user/register' , array(
			'as' => 'account-create-post' ,
			'uses' => 'AccountController@postCreate'
		));

		/*
			Sign in(POST)
		*/
		Route::post('/user/sign_in' , array(
			'as' => 'account-sign-in-post',
			'uses' => 'AccountController@postSignIn'
		));

		/*
			Forgot password(POST)
		*/
		Route::post('/user/forgot-password' , array(
			'as' => 'account-forgot-password-post',
			'uses' => 'AccountController@postForgotPassword'
		));

	});

	/*
		Forgot password(GET)
	*/
	Route::get('/user/forgot-password' , array(
		'as' => 'account-forgot-password',
		'uses' => 'AccountController@getForgotPassword'
	));

	/*
		Sign in(GET)
	*/
	Route::get('/user/sign_in' , array(
		'as' => 'account-sign-in',
		'uses' => 'AccountController@getSignIn'
	));

	/*
		Create account(GET)
	*/
	Route::get('/user/register' , array(
		'as' => 'account-create' ,
		'uses' => 'AccountController@getCreate'
	));




});



