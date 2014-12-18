<?php
class BillController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth');
	}

	public function history() {

		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$bills = Bill::all();

				foreach($bills as $b) {
					$order = DB::table('bill_orders')
								->where('bill_id',$b->id)
								->first();
					
				}

				return View::make('order.history')->with('bills',$bills);
			}
		}
		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

// 	public function detail($id) {
// 		if(Auth::check()) {
// 			if( Entrust::hasRole('Admin') ) {

// 				$bill = Bill::find($id);

// 				$orders = DB::table('bill_orders')->where('bill_id','=',$bill->id)->get();

// 				$total_price = 0.0;
// 				$quantity = 0;

// 				foreach($orders as $o) {
// 					$product = Product::find($o->product_id);
// 					$o->product_name = $product->name;
// 					$o->price = $product->price;
// 					$o->total_product_price = $product->price * $o->quantity; 
// 					$quantity += $o->quantity;
// 					$total_price += $product->price * $o->quantity;
// 				}

// 				return View::make('order.detail')->with('orders',$orders)
// 							->with('total_price',$total_price)
// 							->with('bill',$bill)
// 							->with('quantity',$quantity);

// 			}
// 		}
// 		return Redirect::route('home')->with('fail' , 'Permission Denied');
// 	}


}