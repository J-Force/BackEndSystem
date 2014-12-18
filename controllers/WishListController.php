<?php
class WishListController extends BaseController {
	public function getUserWishList() {
		$this->checkingTime();
		$user = Auth::user();
		if($user){
			$now = new DateTime();
			$wishlist = DB::table('user_wish')
			->select(DB::raw('user_wish.user_id , wishlist.product_id ,SUM(wishlist_time.quantity) as quantity,MIN(wishlist_time.created_at) as createTime'))
			->leftJoin('wishlist', 'user_wish.wish_id', '=', 'wishlist.id')
			->leftJoin('wishlist_time' , 'wishlist_time.wish_id','=','wishlist.id')
			->groupBy('wishlist.product_id')
			->where('user_wish.user_id','=',$user->id)
			->get();

			foreach($wishlist as $wish){
				$product = Product::find($wish->product_id);
				$wish->product_name = $product->name;
				$wish->product_price = $product->price;
				// $seconds_diff = $now - strtotime($wish->createTime);
				$interval = date_diff(new DateTime($wish->createTime), $now);
				$interval = 2 - $interval->format('%a');
				$wish->time = $interval." days left";
			}
			return View::make('wishlist.show')->with('wishlist', $wishlist);
		}
	}
	public function addWishList(){
		$user = Auth::user();
			if($user){
				$quantity = Input::get('quantity');
				$product_id = Input::get('product_id');

				$wishlist = DB::table('user_wish')
				->select('user_wish.wish_id')
				->leftJoin('wishlist', 'user_wish.wish_id', '=', 'wishlist.id')
				->where('user_wish.user_id','=',$user->id)
				->where('wishlist.product_id','=',$product_id)
				->first();
				if(sizeof($wishlist)==0){
					$dt = new DateTime();

					$id = DB::table('wishlist')->insertGetId(
					    array('product_id' => $product_id , 'created_at' => $dt , 'updated_at' => $dt)
					);


					DB::table('user_wish')->insert(
					    array('user_id' => $user->id, 'wish_id' => $id )
					);
					
					DB::table('wishlist_time')->insert(
						array('wish_id' => $id , 'quantity' => $quantity , 'created_at' => $dt , 'updated_at' => $dt)
					);
				}
				else{
					$dt = new DateTime();
					DB::table('wishlist_time')->insert(
						array('wish_id' => $wishlist->wish_id , 'quantity' => $quantity , 'created_at' => $dt , 'updated_at' => $dt)
					);
				}
				DB::table('products')->where('id', $product_id)->decrement('quantity', $quantity);
			}
	}

	public function removeWishList(){
		$user = Auth::user();
		if($user){
			$product_id = Input::get('product_id');
					$wishlist = DB::table('user_wish')
			->select(DB::raw('wishlist.id AS w_id , wishlist_time.id as wt_id,wishlist_time.quantity as quantity'))
			->leftJoin('wishlist', 'user_wish.wish_id', '=', 'wishlist.id')
			->leftJoin('wishlist_time' , 'wishlist_time.wish_id','=','wishlist.id')
			->where('user_wish.user_id','=',$user->id)
			->where('wishlist.product_id','=',$product_id)
			->get();

			$wid = 0;
			$q = 0;
			foreach($wishlist as $wish){
				$q += (int)$wish->quantity;
				DB::table('wishlist_time')->where('id', '=', $wish->wt_id)->delete();
				$wid = $wish->w_id;
			}
			DB::table('user_wish')->where('wish_id', '=', $wid)->delete();
			DB::table('wishlist')->where('id', '=', $wid)->delete();
			DB::table('products')->where('id', $product_id)->increment('quantity', $q);
		}
	}

	public function addWishlistToCart() {
		$user = Auth::user();
		if($user){
			
			$wishlists = DB::table('user_wish')
						->where('user_id','=',$user->id)->get();

			foreach($wishlists as $w) {
				$wt = DB::table('wishlist_time')->where('wish_id','=',$w->wish_id)->get();

				$wish = DB::table('wishlist')->where('id','=',$w->wish_id)->first();

				$order = 
				$order = Order::firstOrCreate( 
					array(
						'product_id' => $wish->product_id , 
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

				$order->quantity += count($wt);
				$order->save();	
			}	


			foreach ($wishlists as $w) {
				DB::table('user_wish')->where('wish_id','=',$w->wish_id)->delete();
				DB::table('wishlist_time')->where('wish_id','=',$w->wish_id)->delete();
				DB::table('wishlist')->where('id','=',$w->wish_id)->delete();
			}
		}
	}

	public function checkingTime(){
		$now = new DateTime();
		$wishlist = DB::table('wishlist_time')->get();
		foreach($wishlist as $wish){
			$interval = date_diff(new DateTime($wish->created_at), $now);
			$interval = 2 - $interval->format('%a');
			if($interval <=0){
				DB::table('wishlist_time')->where('wish_id', '=', $wish->id)->delete();
			}
		}
	}
}
?>