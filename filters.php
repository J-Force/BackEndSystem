<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	$now = new DateTime();
	$wishlist = DB::table('wishlist_time')->get();
	foreach($wishlist as $wish){
		$interval = date_diff(new DateTime($wish->created_at), $now);
		$interval = 2 - $interval->format('%a');
		if($interval <=0){
			$products = DB::table('wishlist')->where('id','=',$wish->id)->first();
			// DB::table('products')->where('id', $products->id)->decrement('quantity', $wish->quantity);
			DB::table('wishlist_time')->where('wish_id', '=', $wish->id)->delete();
			
		}
	}
	$promotion =DB::table('promotions')->get();
	foreach($promotion as $pro){
		if(new DateTime($pro->expire_date)<$now){
			DB::table('promotions')->where('id',$pro->id)->update(array('status'=>'0'));
		}
	}
	// Controller::call('WishListController@checkingTime');
	//
	//$request->headers->set('content-type','application/json');
});



App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{	
		if(Request::ajax()) {
			return Response::json(array('fail' => 'you must to sign in'));
		} else {
			return Redirect::guest('/user/sign_in');
		}		
	}

});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


Route::filter('can_edit' , function() {
	if (! Entrust::can('can_edit') ) // Checks the current user
    {
        return Redirect::intended('/')->with('failed', 'You don\'t have access!');;
    }
});
