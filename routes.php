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

Route::get('/products' , array('as' => 'products' , 'uses' => 'ProductController@showProduct') );

Route::get('/products/{id}', array('as' => 'product' , 'uses' => 'ProductController@view') );

Route::get('/products-add', array('as' => 'product-add-view' , 'uses' => 'ProductController@showAddProduct') );

Route::post('products/create', array('before' => 'csrf','uses' => 'ProductController@addProduct'));

Route::get('/products/{id}/edit', array('as' => 'product-edit-view' , 'uses' => 'ProductController@showEditProduct'));

Route::put('products/update', array('before' => 'csrf','uses' => 'ProductController@editProduct'));

Route::delete('products/delete', array('before' => 'csrf','uses' => 'ProductController@deleteProduct'));

Route::get('/news', array('as' => 'news', 'uses' => 'NewsController@get') );

Route::get('/products/{id}/add-image', array('as' => 'product-add-image' , 'uses' => 'ProductController@showAddImage'));

/*
	
*/
Route::get('/catalog/man' , array(
	'as' => 'catalog-man' ,
	'uses' => 'ProductController@getCatalogMen'
));

/*
	
*/
Route::get('/catalog/women' , array(
	'as' => 'catalog-women' ,
	'uses' => 'ProductController@getCatalogWomen'
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

		/*
			Update Profile (POST)
		*/

		Route::post('/user/profile' , array(
			'as' => 'profile-user-update',
			'uses' => 'ProfileController@postUpdate'
		));

		Route::post('/user/orders/add_cart' ,array(
			'as' => 'user-order-add',
			'uses' => 'OrderController@addCart'
		));

		Route::post('/user/orders/remove_cart' ,array(
			'as' => 'user-order-remove',
			'uses' => 'OrderController@removeCart'
		));

	});

	/*
		For Admin
	*/
	//if(Entrust::hasRole('Admin')) {
		Route::get('/admin' , array(
				'as' => 'admin' ,
				'uses' => 'AdminController@index'
		));
	//}


	Route::get('/users' , array(
		'as' => 'users-all',
		'uses' => 'AccountController@index'
	));

	Route::get('/images-all' , array(
		'as' => 'image-all',
		'uses' => 'ImageController@index'
	));

	Route::get('/upload' , array(
		'as' => 'upload',
		'uses' => 'ImageController@indexUpload'
	));

	Route::post('upload' ,'ImageController@uploadImage');

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

	/*
		Profile
	*/
	Route::get('/user/profile' , array(
		'as' => 'profile-user',
		'uses' => 'ProfileController@user'
	));

	/*
		User Cart GET ( View )
	*/
	Route::get('/user/orders' ,array(
		'as' => 'user-order',
		'uses' => 'OrderController@getUserOrder'
	));

	/*
		User Cart GET
	*/
	Route::get('/user/orders/get' ,array(
		'as' => 'user-order-get',
		'uses' => 'OrderController@getOrderToCartPop'
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



