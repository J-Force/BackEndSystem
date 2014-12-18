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

Route::get('/promotions', array('as' => 'promotions', 'uses' => 'PromotionController@getAll') );

Route::get('/promotions/{id}' ,array(
	'as' => 'promotion-detail',
	'uses' => 'PromotionController@get'
));

Route::get('/products/{id}', array('as' => 'product' , 'uses' => 'ProductController@view') );

Route::get('/products/show/{id}', array('as' => 'product-id', 'uses' => 'ProductController@showDetail'));

Route::get('/search', array(
	'as' => 'product-search-view',
	'uses' => 'ProductController@showSearch'
));

Route::get('/getdata', array(
	'as' => 'product-search-getdata',
	'uses' => 'ProductController@getData'
));

Route::get('/search/{name}', array(
	'as' => 'product-search',
	'uses' => 'ProductController@searchProduct'
));

/*
	
*/
Route::get('/catalog/man' , array(
	'as' => 'catalog-man' ,
	'uses' => 'ProductController@getCatalogMen'
));
Route::get('/catalog/man/{cat}' , array(
	'as' => 'catalog-man-category' ,
	'uses' => 'ProductController@getCatalogMenByCat'
));

/*
	
*/
Route::get('/catalog/women' , array(
	'as' => 'catalog-women' ,
	'uses' => 'ProductController@getCatalogWomen'
));
Route::get('/catalog/women/{cat}' , array(
	'as' => 'catalog-women-category' ,
	'uses' => 'ProductController@getCatalogWomenByCat'
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
		Route::post('/user/change_password' ,array(
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

		/*
			Add to Cart
		*/
		Route::post('/user/orders/add_cart' ,array(
			'as' => 'user-order-add',
			'uses' => 'OrderController@addCart'
		));

		Route::post('/user/orders/remove_cart' ,array(
			'as' => 'user-order-remove',
			'uses' => 'OrderController@removeCart'
		));


		/*
			Increase Order for Ajax
		*/
		Route::post('/user/orders/increase' ,array(
			'as' => 'user-order-increase',
			'uses' => 'OrderController@increaseOrder'
		));

		/*
			Decrease Order for Ajax
		*/
		Route::post('/user/orders/decrease' ,array(
			'as' => 'user-order-decrease',
			'uses' => 'OrderController@decreaseOrder'
		));

		/*
			Calculate total price order for Ajax
		*/
		Route::get('/user/orders/callback' ,array(
			'as' => 'user-order-callback',
			'uses' => 'OrderController@callbackTotalPrice'
		));

		/*
			Profile
		*/
		Route::get('/user/profile' , array(
			'as' => 'profile-user',
			'uses' => 'ProfileController@user'
		));

		Route::get('/user/bills/history' , array(
			'as' => 'bill-history-user',
			'uses' => 'ProfileController@historyBill'
		));

		/*
			User Cart GET ( View )
		*/
		Route::get('/user/orders' ,array(
			'as' => 'user-order',
			'uses' => 'OrderController@getUserOrder'
		));

		/*
			User Cart-pop GET
		*/
		Route::get('/user/orders/get' ,array(
			'as' => 'user-order-get',
			'uses' => 'OrderController@getOrderToCartPop'
		));

		Route::post('/products/show/{id}/comment',array(
			'as' => 'comment',
			'uses' => 'ReviewController@commitComment'
		));

		Route::post('/products/show/{id}/comment/{review_id}/delete',array(
			'as' => 'delete-comment',
			'uses' => 'ReviewController@deleteComment'
		));

		Route::post('/products/show/{id}/comment/{review_id}/edit',array(
			'as' => 'edit-comment',
			'uses' => 'ReviewController@editComment'
		));

		/*
			Rating product
		*/
		Route::post('/products/show/{id}/rate',array(
			'as' => 'rate',
			'uses' => 'ReviewController@commitVote'
		));


		/*
			get Rating product
		*/
		Route::get('/products/show/{id}/getRate',array(
			'as' => 'get-rate',
			'uses' => 'ReviewController@getVote'
		));

		/*
			User Wishlist GET ( View )
		*/
		Route::get('/user/wishlist' ,array(
			'as' => 'user-wishlist',
			'uses' => 'WishListController@getUserWishList'
		));

		/*
			Add to Wishlist
		*/
		Route::post('/user/wishlist/addWishlist' ,array(
			'as' => 'user-wishlist-add',
			'uses' => 'WishListController@addWishList'
		));

		/*
			Remove to Wishlist
		*/
		Route::post('/user/wishlist/removeWishlist' ,array(
			'as' => 'user-wishlist-remove',
			'uses' => 'WishListController@removeWishList'
		));

		Route::post('/user/wishlist/addToCart',array(
			'as' => 'user-wishlist-add-cart',
			'uses' => 'WishListController@addWishlistToCart'
		));

		Route::get('/user/payment', array(
			'as' => 'payment',
			'uses' => 'PaymentController@index'
		));

		Route::post('user/payment/create',array(
			'as'  => 'payment-result',
			'uses' => 'PaymentController@checkout'
		));

		Route::get('user/payment/result/{id}', array(
			'as' => 'payment-result-last',
			'uses' => 'PaymentController@result'
		));

		Route::post('user/payment/{id}/addURL',array(
			'as' => 'add-url-to-order-history',
			'uses' => 'PaymentController@addPaymentCallback'
		));
		/*
			Get user ajax
		*/
		Route::get('/user/ajaxuser',array(
			'as' => 'user-ajax',
			'uses' => 'ProfileController@getUserAjax'
		));

	});

	/*
		For Admin
	*/
	Route::group(array('prefix' => 'admin') , function() {
		Route::get('/' , array(
				'as' => 'admin' ,
				'uses' => 'AdminController@index'
		));

		Route::put('/hot', array(
			'as' => 'update.hot.product',
			'uses' => 'AdminController@update_hot_item'
		));
		Route::get('/hot', array(
			'as' => 'get.hot.product',
			'uses' => 'AdminController@get_hot_product'
		));

		Route::get('/products' , array('as' => 'products' , 'uses' => 'ProductController@showProduct') );

		Route::get('/products-add', array('as' => 'product-add-view' , 'uses' => 'ProductController@showAddProduct') );

		Route::post('/products/create', array('before' => 'csrf','uses' => 'ProductController@addProduct'));

		Route::get('/products/{id}/edit', array('as' => 'product-edit-view' , 'uses' => 'ProductController@showEditProduct'));

		Route::put('/products/update', array('before' => 'csrf','uses' => 'ProductController@editProduct'));

		Route::delete('/products/delete/{id}', array('uses' => 'ProductController@deleteProduct'));

		Route::get('/products/{id}/add-image', array('as' => 'product-add-image' , 'uses' => 'ProductController@showAddImage'));

		Route::post('products/add-image', array('before' => 'csrf','uses' => 'ProductController@addProductImage'));

		Route::get('/products/{id}/remove-image', array('as' => 'product-remove-image','uses' => 'ProductController@showRemoveImage'));

		Route::delete('products/remove-image', array('before' => 'csrf','uses' => 'ProductController@removeProductImage'));

		Route::get('/category-add', array('as' => 'category-add-view' , 'uses' => 'ProductController@showAddCategory') );

		Route::post('/category/create', array('before' => 'csrf','uses' => 'ProductController@addCategory'));

		Route::delete('/category/delete/{id}', array('uses' => 'ProductController@deleteCategory'));

		Route::get('/report', array('as' => 'report' ,'uses' => 'ReportController@showReport'));

		Route::post('/report/update', array('as' => 'report-update' ,'uses' => 'ReportController@updateReport'));

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

		Route::post('/user/upload' ,'ImageController@uploadImage');

		Route::delete('image/delete/{id}', array('uses' => 'ImageController@deleteImage'));

		Route::get('/orders/active' , array(
			'as' => 'order-active',
			'uses' => 'OrderController@getActiveOrder'
		));

		Route::get('/bills',array(
			'as' => 'bill-history',
			'uses' => 'BillController@history'
		));

		Route::get('/promotions',array(
			'as'	=> 'promotion',
			'uses'	=> 'PromotionController@showadd'
		));

		Route::post('/promotions',array(
			'as' => 'add-promotion',
			'uses' => 'PromotionController@add'
		));

		Route::post('/promotions/products',array(
			'as' => 'add-promotion-product',
			'uses' => 'PromotionController@addPromotionProduct'
		));

	}); 
	

	/*
		Change password (GET)
	*/
	Route::get('/user/change_password', array(
		'as' => 'account-change-password',
		'uses' => 'AccountController@getChangePassword'
	));

	/*
		Sign Out (GET)
	*/
	Route::get('/user/sign_out',array(
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
Route::group(array('prefix' => 'api/v1'), function()
	{
	     Route::get('/orders' , array(
			'as' => 'get-orders' ,
			'uses' => 'ApiController@getOrder'
		));	
	    Route::get('/orders/{id}' , array(
			'as' => 'get-orders-id' ,
			'uses' => 'ApiController@getOrderByID'
		));	
	    Route::get('/products' , array(
			'as' => 'get-products' ,
			'uses' => 'ApiController@getProduct'
		));	
		Route::get('/products/{id}' , array(
			'as' => 'get-products-id' ,
			'uses' => 'ApiController@getProductByID'
		));
		Route::post('/orders/' , array(
			'as' => 'update-order' ,
			'uses' => 'ApiController@updateOrder'
		));
	 
	});



