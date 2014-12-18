<?php

class AdminController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth');
	}

	public function index(){

		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				return View::make('admin.index');
				}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function update_hot_item() {
		$data = Input::get();

		$product = Product::all();
		$runner = 0;
		
		// if($data['product1']==-1) {
		// 	for(;$runner<=count($product);$runner++) {
		// 		if($product[$runner]->product_id != $data['product1'] &&
		// 			$product[$runner]->product_id != $data['product2'] &&
		// 			$product[$runner]->product_id != $data['product3'] &&
		// 			$product[$runner]->product_id != $data['product4'] &&
		// 			$product[$runner]->product_id != $data['product5'] &&
		// 			$product[$runner]->product_id != $data['product6'] &&
		// 			$product[$runner]->product_id != $data['product7'] &&
		// 			$product[$runner]->product_id != $data['product8'] ) {
		// 				DB::table('hot_product')->where('id', '=', 1)->update( array(
		// 					'product_id' => $product[$runner]->product_id
		// 				));
		// 				break;
		// 		}
		// 	}
		// }
		// else {
			DB::table('hot_product')->where('id', '=', 1)->update( array(
				'product_id' => $data['product1']
			));
		// }

		// if($data['product2']==-1) {
		// 	for(;$runner<=count($product);$runner++) {
		// 		if($product[$runner]->product_id != $data['product1'] &&
		// 			$product[$runner]->product_id != $data['product2'] &&
		// 			$product[$runner]->product_id != $data['product3'] &&
		// 			$product[$runner]->product_id != $data['product4'] &&
		// 			$product[$runner]->product_id != $data['product5'] &&
		// 			$product[$runner]->product_id != $data['product6'] &&
		// 			$product[$runner]->product_id != $data['product7'] &&
		// 			$product[$runner]->product_id != $data['product8'] ) {
		// 				DB::table('hot_product')->where('id', '=', 2)->update( array(
		// 					'product_id' => $product[$runner]->product_id
		// 				));
		// 				break;
		// 		}
		// 	}
		// }
		// else {	
			DB::table('hot_product')->where('id', '=', 2)->update( array(
				'product_id' => $data['product2']
			));
		// }

		// if($data['product3']==-1) {
		// 	for(;$runner<=count($product);$runner++) {
		// 		if($product[$runner]->product_id != $data['product1'] &&
		// 			$product[$runner]->product_id != $data['product2'] &&
		// 			$product[$runner]->product_id != $data['product3'] &&
		// 			$product[$runner]->product_id != $data['product4'] &&
		// 			$product[$runner]->product_id != $data['product5'] &&
		// 			$product[$runner]->product_id != $data['product6'] &&
		// 			$product[$runner]->product_id != $data['product7'] &&
		// 			$product[$runner]->product_id != $data['product8'] ) {
		// 				DB::table('hot_product')->where('id', '=', 3)->update( array(
		// 					'product_id' => $product[$runner]->product_id
		// 				));
		// 				break;
		// 		}
		// 	}
		// }
		// else {
			DB::table('hot_product')->where('id', '=', 3)->update( array(
				'product_id' => $data['product3']
			));
		// }

		// if($data['product4']==-1) {
		// 	for(;$runner<=count($product);$runner++) {
		// 		if($product[$runner]->product_id != $data['product1'] &&
		// 			$product[$runner]->product_id != $data['product2'] &&
		// 			$product[$runner]->product_id != $data['product3'] &&
		// 			$product[$runner]->product_id != $data['product4'] &&
		// 			$product[$runner]->product_id != $data['product5'] &&
		// 			$product[$runner]->product_id != $data['product6'] &&
		// 			$product[$runner]->product_id != $data['product7'] &&
		// 			$product[$runner]->product_id != $data['product8'] ) {
		// 				DB::table('hot_product')->where('id', '=', 4)->update( array(
		// 					'product_id' => $product[$runner]->product_id
		// 				));
		// 				break;
		// 		}
		// 	}
		// }
		// else {
			DB::table('hot_product')->where('id', '=', 4)->update( array(
				'product_id' => $data['product4']
			));
		// }

		// if($data['product5']==-1) {
		// 	for(;$runner<=count($product);$runner++) {
		// 		if($product[$runner]->product_id != $data['product1'] &&
		// 			$product[$runner]->product_id != $data['product2'] &&
		// 			$product[$runner]->product_id != $data['product3'] &&
		// 			$product[$runner]->product_id != $data['product4'] &&
		// 			$product[$runner]->product_id != $data['product5'] &&
		// 			$product[$runner]->product_id != $data['product6'] &&
		// 			$product[$runner]->product_id != $data['product7'] &&
		// 			$product[$runner]->product_id != $data['product8'] ) {
		// 				DB::table('hot_product')->where('id', '=', 5)->update( array(
		// 					'product_id' => $product[$runner]->product_id
		// 				));
		// 				break;
		// 		}
		// 	}
		// }
		// else {
			DB::table('hot_product')->where('id', '=', 5)->update( array(
				'product_id' => $data['product5']
			));
		// }

		// if($data['product6']==-1) {
		// 	for(;$runner<=count($product);$runner++) {
		// 		if($product[$runner]->product_id != $data['product1'] &&
		// 			$product[$runner]->product_id != $data['product2'] &&
		// 			$product[$runner]->product_id != $data['product3'] &&
		// 			$product[$runner]->product_id != $data['product4'] &&
		// 			$product[$runner]->product_id != $data['product5'] &&
		// 			$product[$runner]->product_id != $data['product6'] &&
		// 			$product[$runner]->product_id != $data['product7'] &&
		// 			$product[$runner]->product_id != $data['product8'] ) {
		// 				DB::table('hot_product')->where('id', '=', 6)->update( array(
		// 					'product_id' => $product[$runner]->product_id
		// 				));
		// 				break;
		// 		}
		// 	}
		// }
		// else {
			DB::table('hot_product')->where('id', '=', 6)->update( array(
				'product_id' => $data['product6']
			));
		// }

		// if($data['product7']==-1) {
		// 	for(;$runner<=count($product);$runner++) {
		// 		if($product[$runner]->product_id != $data['product1'] &&
		// 			$product[$runner]->product_id != $data['product2'] &&
		// 			$product[$runner]->product_id != $data['product3'] &&
		// 			$product[$runner]->product_id != $data['product4'] &&
		// 			$product[$runner]->product_id != $data['product5'] &&
		// 			$product[$runner]->product_id != $data['product6'] &&
		// 			$product[$runner]->product_id != $data['product7'] &&
		// 			$product[$runner]->product_id != $data['product8'] ) {
		// 				DB::table('hot_product')->where('id', '=', 7)->update( array(
		// 					'product_id' => $product[$runner]->product_id
		// 				));
		// 				break;
		// 		}
		// 	}
		// }
		// else {
			DB::table('hot_product')->where('id', '=', 7)->update( array(
				'product_id' => $data['product7']
			));
		// }

		// if($data['product8']==-1) {
		// 	for(;$runner<=count($product);$runner++) {
		// 		if($product[$runner]->product_id != $data['product1'] &&
		// 			$product[$runner]->product_id != $data['product2'] &&
		// 			$product[$runner]->product_id != $data['product3'] &&
		// 			$product[$runner]->product_id != $data['product4'] &&
		// 			$product[$runner]->product_id != $data['product5'] &&
		// 			$product[$runner]->product_id != $data['product6'] &&
		// 			$product[$runner]->product_id != $data['product7'] &&
		// 			$product[$runner]->product_id != $data['product8'] ) {
		// 				DB::table('hot_product')->where('id', '=', 8)->update( array(
		// 					'product_id' => $product[$runner]->product_id
		// 				));
		// 				break;
		// 		}
		// 	}
		// }
		// else {
			DB::table('hot_product')->where('id', '=', 8)->update( array(
				'product_id' => $data['product8']
			));
		// }

		return View::make('admin.hot_product');
	}

	public function get_hot_product() {
		return View::make('admin.hot_product');
	}

}