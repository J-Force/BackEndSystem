<?php

class PromotionController extends BaseController {

	public function getAll(){
		$promotions = Promotion::where('status','=',1)->get();
		return View::make('promotion.list')->with('promotions',$promotions);
	}

	public function get($id) {
		$promotion = Promotion::find($id);
		$product_promo = DB::table('product_promotion')->where('promotion_id', '=', $id)->get();
		foreach($product_promo as $p) {
			$product = Product::find($p->product_id);
			$p->name = $product->name;
		}
		return View::make('promotion.detail')->with('promotion' , $promotion)->with('products' , $product_promo);
	}

	public function add() {
			$data = Input::all();

			$validator = Validator::make(Input::all(),
				array(
					'title' 	=> 'required',
					'description'	=> 'required'
				)
			);

			if($validator->fails()){
			return Redirect::route('promotion')
				   ->withErrors($validator)
				   ->withInput();
			}else {

				$date = new DateTime(Input::get('year').'-'.Input::get('month').'-'.Input::get('day'));

				$promotion = DB::table('promotions')->orderBy('id','desc')->first();
				if(count($promotion)>0) {
					return Redirect::route('promotion')->with('fail', 'Cannot create promotion, there is no product to apply.');
				}
				else {
					DB::table('promotions')->where('id','=',$promotion->id)
						->update(array(
							'title' => $data['title'],
							'description' => $data['description'],
							'expire_date' => $date,
							'start_date' => new DateTime(),
							'status' => 1
					));
					return Redirect::route('promotion')->with('success','Add Promotion Success');
				}
			}
	}

	public function addPromotionProduct() {

		if( Entrust::hasRole('Admin') ) {
			$data = Input::all();
			
			$product_id = Input::get('product_id');
			$temp = DB::table('product_promotion')->where('product_id', '=', $product_id)->get();

			if(count($temp)>0) return Response::make('Product already have other promotion.', 400);

			$value = Input::get('value');
			$type = Input::get('type');

			$promotion = Promotion::firstOrCreate(array(
							'title' => 'sale'
						));

			$typeName = 'percent';	
			if($type == 1)
				$typeName = 'discount';

			$product_promo= DB::table('product_promotion')->insert(array(
							'promotion_id' => $promotion->id,
							'product_id' => $product_id,
							'value' => $value,
							'type' => $type,
							'typeName'	=> $typeName
						));

			
		}
	}


	public function showAdd() {
		return View::make('promotion.backend');
	}

	public function delete($id) {
		DB::table('product_promotion')->where('promotion_id', '=', $id)->delete();
		DB::table('promotions')->where('id', '=', $id)->delete();
	}

	public function edit() {

	}

}