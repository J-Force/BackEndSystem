<?php
class OrderController extends BaseController {

	public function getUserOrder() {
		$user = Auth::user();

		if($user){

			$orders = Order::where('user_id' , '=' , $user->id )
					  ->where('status' , '=' , 0)
					  ->get();

			foreach ($orders as $order)
			{
			    $product = Product::find($order->product_id);
			    $order->product_name = $product->name;
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
                 ->groupBy('product_id')
                 ->take(5)
                 ->get();

			foreach ($orders as $order)
			{
			    $product = Product::find($order->product_id);
			    $order->product_name = $product->name;
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

	public function removeCart(){

		$user = Auth::user();

		if($user){

			$order_id = Input::get('order_id');
			Order::destroy($order_id);
			

		}
		
		return Redirect::route('user-order');
	}
}