<?php
class OrderController extends BaseController {

	public function getUserOrder() {
		$user = Auth::user();

		if($user){
			$orders = DB::table('orders')
			                 ->select('id','product_id', DB::raw('count(*) as quantity'))
			                 ->where('user_id' ,'=' , $user->id)
			                 ->where('status' ,'=' ,0)
			                 ->groupBy('product_id')
			                 ->get();

			foreach ($orders as $order)
			{
			    $product = Product::find($order->product_id);
			    $order->product_name = $product->name;
			    $order->price = $product->price;
			}
			
			return View::make('order.show')->with('orders', $orders);
		}
		return App::abort(404);
	}

	public function getOrderToCartPop() {
		$user = Auth::user();

		if($user){
			$orders = DB::table('orders')
                 ->select('product_id', DB::raw('count(*) as quantity'))
                 ->where('user_id' ,'=' , $user->id)
                 ->where('status' ,'=' ,0)
                 ->groupBy('product_id')
                 ->get();

			foreach ($orders as $order)
			{
			    $product = Product::find($order->product_id);
			    $order->product_name = $product->name;
			    $order->price = $product->price;
			}

			return $orders;
		}

	}

	public function addCart(){

		if(Auth::check()) {
			$user = Auth::user();

			if($user){
				
				Order::create(array(
				   	'user_id' => $user->id, 
				   	'product_id' => Input::get('product_id'),
				   	'status' => 0,
				));
			}

			return Redirect::route('user-order');

		} else {

			return Redirect::route('account-create');
		}
	}

	public function increaseOrder() {

		if(Auth::check()) {
			$user = Auth::user();

			if($user) {
				Order::create(array(
				   	'user_id' => $user->id, 
				   	'product_id' => Input::get('product_id'),
				   	'status' => 0,
				));
			}
		}

	}

	public function decreaseOrder() {

		if(Auth::check()) {
			$user = Auth::user();

			if($user) {

				$order = DB::table('orders')
				         ->where('product_id' ,'=' , Input::get('product_id'))
				         ->first();

				if($order) {
					Order::destroy($order->id);
				}

			}
		}
	}

	public function removeCart(){

		$user = Auth::user();

		if($user){

			$product_id = Input::get('product_id');
			DB::table('orders')->where('product_id' , '=' , $product_id )->delete();

		}
		
		return Redirect::route('user-order');
	}
}