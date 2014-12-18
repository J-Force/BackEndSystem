<?php
class PaymentController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth');
	}

	public function index() {

		$arr = $this->getOrder();

		$user = $arr[2];
		$total_price = $arr[1];

		return View::make('payment.payment')->with('user',$user)
					->with('total_price',number_format($total_price,2));
	}

	public function checkout() {

		$user = Auth::user();
		$arr = $this->getOrder();
		$total_price = $arr[1];
		$orders = $arr[0];

		$date = new DateTime();

		$id = DB::table('bills')->insertGetId(
			array(
				'user_id' => $user->id,
				'total_price' => $total_price,
				'created_at' => $date,
				'updated_at' => $date
			)
		);

		$orderf = array();
		$orderf['error'] = false;
		$orderf['order'] = $this->jsonOrder();

		foreach($orders as $o) {
			DB::table('bill_orders')->insert(
				array(
					'bill_id' =>$id,
					'order_id'=> $o->id,
					'created_at' => $date,
					'updated_at' => $date
				)
			);

			$o->status = 0;
			$o->save();

			Active::where('order_id','=',$o->id)
			       ->where('user_id','=',$user->id)->delete();

				    $product_total_price = $this->getPrice($o->product_id);
				    $product_total_price *= $o->quantity;
			Done::create(array(
				'order_id' => $o->id,
				'user_id'  => $user->id,
				'payment_id' => 1,
				'total_price' => $product_total_price,
				'shipment_cost' => 40,
				'total_net_price' => 0,
				'ship_id'	=> 1
			));

		}

		$order_bill = DB::table('bill_orders')
						->where('bill_id','=', $id )->get();

		$total_price = 0.0;
		$orders = [];
		foreach($order_bill as $ob) {

			$order = Order::find($ob->order_id);			
			$product = Product::find($order->product_id);
			$order->product_name = $product->name;

		    $order->price = $this->getPrice($order->product_id);

			$order->product_total_price = $order->price * $order->quantity;
			$total_price += $order->product_total_price;
			array_push($orders, $order);
		}

		
		return $this->sendTofulfill($orderf,$id);

	}

	private function getPrice($product_id){
		$product = Product::find($product_id);
		$promotion = DB::table('product_promotion')->where('product_id',$product_id)->first();
		    $price = $product->price;
		    if($promotion!=null){
		    	if($promotion->type==1)$price -= $promotion->value;
		    	else $price *= (100-$promotion->value)/100;
		    }
		return $price;
	}

	private function sendTofulfill($order, $id){
		$data = array();

		$data_string = json_encode($order);                                                                                   
		 
		$ch = curl_init('http://128.199.132.197/dntk/api/v1/orders');                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		    'Content-Type: application/json',                                                                                
		    'Content-Length: ' . strlen($data_string))                                                                       
		);  
		$result = json_decode(html_entity_decode(curl_exec($ch)),true);
		if(!$result['error']) $this->updateAllOrderStatus();

		DB::table('order_history')->insert(
		    array(
		    	'order_id' => $result['order_id'], 
		    	'user_id' => Auth::user()->id , 
		    	'url' => $result['url'],
		    	'bill_id' => $id
			)
		);
		
		$statusCode = 201;
		return Response::make($id,$statusCode);
	}

	public function addPaymentCallback($id) {
		$url = Input::get('payment_url_callback');
		// $url = "Fuck";
		DB::table('order_history')
			->where('bill_id','=',$id)
			->update(array(
					'payment_url_callback' => $url
				)
			);

	}

	public function getOrder() {

		$user = Auth::user();
		$orders = Order::where('user_id','=',$user->id)
					->where('status','=',1)->get();

		$total_price = 0.0;
		foreach($orders as $o) {
			$price = Product::find($o->product_id);
			$promotion = DB::table('product_promotion')->where('product_id',$o->product_id)->first();
				    $price = $price->price;
				    if($promotion!=null){
				    	if($promotion->type==1)$price -= $promotion->value;
				    	else $price *= (100-$promotion->value)/100;
				    }
			$total_price += $price * $o->quantity;
		}

		$out =[];
		array_push($out,$orders,$total_price,$user);
		return $out;
	}
	private function updateAllOrderStatus(){
		$user = Auth::user();
		DB::table('orders')
            ->where('user_id', $user->id)
            ->where('status' , 1)
            ->update(array('status' => 2));
	}
	private function jsonOrder(){
		$user = Auth::user();
		$orders = Order::where('user_id','=',$user->id)
					->where('status','=',1)->get();

		$total_price = 0.0;
		$out = array();
		$products = array();
		foreach($orders as $o) {
			$productq = Product::find($o->product_id);
			$product = array();
			$product['product_id'] = $o->product_id;
			$product['product_name'] = $productq->name;
			$product['price'] = $this->getPrice($o->product_id);
			$product['quantity'] = $o->quantity;
			$product['weight'] = $productq->weight;
			$total_price += $this->getPrice($o->product_id) * $o->quantity;
			array_push($products, $product);
		}
		$out['site'] = 'jf-shop';
		$out['products'] = $products;
		$out['totalprice'] = $total_price;
		$out["customer_id"] = $user->id;
		$out["customer_name"] = $user->first_name." ".$user->last_name;
		$out["email"] = $user->email;
		$out["phone_number"] = $user->phone;
		$out["address"] = $user->address;
		$out["payment_type"] = "credit";
		$out["payment_status"] = "1";
		return $out;
	}

	public function result($id) {
		$bill = Bill::find($id);
		$orders = DB::table('bill_orders')->where('bill_id', '=', $id)->get();
		$output = array();
		$total_price = 0.0;
		foreach($orders as $o) {
			$or = Order::find($o->order_id);
			$product = Product::find($or->product_id);
			$temp = array();
			$temp['product_name'] = $product->name;
			$temp['price'] = $this->getPrice($or->product_id);
			$temp['quantity'] = $or->quantity;
			array_push($output, $temp);
			$total_price += $or->quantity*$temp['price'];
		}
		return View::make('payment.result')->with('user',Auth::user())
					  ->with('orders',$output)
		              ->with('total_price',number_format($total_price,2));
	}
}