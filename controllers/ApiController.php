<?php
class ApiController extends BaseController {
	public function getOrder()
	{
		$user = Auth::user();

			if($user){
			

				$orders = Order::where('user_id' ,'=' ,$user->id)->get();

				foreach ($orders as $order)
				{
				    $status = $order->status;
				    if($status=="0") $order->status = "In Process";
				}
				
				return Response::json(array(
	        	'error' => false,
	        	'orders' => $orders->toArray()),
	        	200
	    		);
			}
		return Response::json(array('error'=>true,'Message' => 'permission denined'),550);
	    
	}

	public function getOrderByID($id){
		$orders = Order::where('id' ,'=' ,$id)->get()->first();	
		if(sizeof($orders)!=0){
			return Response::json(array(
	        	'error' => false,
	        	'order' => $orders),
	        	200
	    		);
		}
		else{
			return Response::json(array('error'=>true,'Message' => 'Error Not Found'),404);
		}
	}
	public function getProduct(){
		$products = Product::orderBy('id','ASC')->get();
		return Response::json(array(
	        	'error' => false,
	        	'products' => $products->toArray()),
	        	200
	    		);
	}

	public function getProductByID($id){
		$products = Product::where('id' ,'=' ,$id)->get()->first();	
		if(sizeof($products)!=0){
			return Response::json(array(
	        	'error' => false,
	        	'product' => $products),
	        	200
	    		);
		}
		else{
			return Response::json(array('error'=>true,'Message' => 'Error Not Found'),404);
		}
	}
	public function updateOrder(){
		// if( Request::get('error')){
		// 	return Response::json(array(
	 //        	'error' => false,
	 //        	'message' => Request::get('error')),
	 //        	200
	 //    		);
		// }
		// else{
		// 	return Response::json(array('error'=>true,'Message' => 'Error Not Found'),404);
		// }
		$data = Input::all();
		$msg = $data['order'];
		return Response::json(array('error'=>false,'Message' => $msg),200);
	}
}
?>
