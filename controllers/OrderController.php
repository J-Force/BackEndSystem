<?php
class OrderController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth');
	}


	public function getUserOrder() {
		
			$user = Auth::user();

			if($user){
			

				$orders = Order::where('user_id' ,'=' ,$user->id)
								->where('status','=',1)->get();

				foreach ($orders as $order)
				{
				    $product = Product::find($order->product_id);
				    $order->product_name = $product->name;
				    $promotion = DB::table('product_promotion')->where('product_id',$order->product_id)->first();
				    $order->price = $product->price;
				    if($promotion!=null){
				    	if($promotion->type==1)$order->price -= $promotion->value;
				    	else $order->price *= (100-$promotion->value)/100;
				    }
				}
				
				return View::make('order.show')->with('orders', $orders);
			}
		
	}

	public function getActiveOrder() {
		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$actives = Active::all();

				foreach($actives as $active) 
				{
					$order = Order::find($active->order_id);
					$user = User::find($active->user_id);

					$product = Product::find($order->product_id);

					$active->product = $product;
					$active->user = $user;
					$active->order = $order;

				}
				return View::make('order.showactive')->with('actives',$actives);
			}
		}
		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}



	public function getOrderToCartPop() {
			
			$user = Auth::user();

			if($user){
			

				$orders = Order::where('user_id' ,'=' ,$user->id)
								->where('status','=',1)->get();

				foreach ($orders as $order)
				{
				    $product = Product::find($order->product_id);
				    $order->product_name = $product->name;
				    $order->price = $product->price;
				    $promotion = DB::table('product_promotion')->where('product_id',$order->product_id)->first();
				    $order->price = $product->price;
				    if($promotion!=null){
				    	if($promotion->type==1)$order->price -= $promotion->value;
				    	else $order->price *= (100-$promotion->value)/100;
				    }
				}

				return $orders;
			}
		
	}

	public function addCart() {		
			$user = Auth::user();

			if($user){

				$quantity = Input::get('quantity');
				$product_id = Input::get('product_id');

				$order = Order::firstOrCreate( 
					array(
						'product_id' => $product_id , 
						'user_id' 	 => $user->id ,
						'status'	 => 1
					) 
				);

				$active = Active::firstOrCreate(
					array(
						'user_id' => $user->id,
						'order_id' => $order->id
					)
				);

				if(Input::get('type')) {
					$order->quantity = $quantity;
				} else {
					$order->quantity += $quantity;
				}
				$order->save();

			}


	}

	public function increaseOrder() {

		
			$user = Auth::user();

			if($user) {
				$quantity = Input::get('quantity');
				$product_id = Input::get('product_id');

				$order = Order::where('status','=',1)
								->where('user_id' , '=' , $user->id )
				                ->where('product_id','=',$product_id)->get();    

				foreach( $order as $o ) {
					$o->quantity += $quantity;
					$o->save();
				}
			}
		

	}

	public function decreaseOrder() {

		
			$user = Auth::user();

			if($user) {

				$quantity = Input::get('quantity');
				$product_id = Input::get('product_id');

				$order = Order::where('status','=',1)
								->where('user_id' , '=' , $user->id )
				                ->where('product_id','=',$product_id)->get();

				foreach( $order as $o ) {
					$o->quantity -= $quantity;
					$o->save();
				}

			}
		
	}

	public function removeCart(){

		
			$user = Auth::user();

			if($user) {

				$product_id = Input::get('product_id');
				$order_id = Input::get('order_id');
				DB::table('active_orders')->where('order_id' , '=' , $order_id )->delete();
				DB::table('orders')->where('user_id','=',$user->id)->
				where('product_id' , '=' , $product_id )->delete();

			}
		
	}

	public function callbackTotalPrice() {

		$user = Auth::user();

		$orders = Order::where('status','=',1)->
						where('user_id','=',$user->id)->get();
		$total_price = 0;
		$total_quantity = 0;

		$total = [];

		foreach ($orders as $order) {
			$product = Product::find($order->product_id);
			$total_price += $order->quantity * $product->price;
			$total_quantity += $order->quantity;
		}

		array_push($total,$total_price,$total_quantity);
		return $total;

	}
}