<?php

class ProductController extends BaseController {
	public $restful = true;

	public function showProduct(){
		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				return View::make('product.product')->with('products',Product::orderBy('id','DESC')->get() );
				}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function view($id){
		return View::make('product.view')->with('product',Product::find($id));
	}

	public function getCatalogMen(){
		$products = DB::table('products')
					->where('sex', 'M')
                    ->orderBy('name', 'desc')
                    ->paginate(9);
        if (Request::ajax()) {
            return Response::json(View::make('product.catalog_men-list', array('products' => $products))->render());
        }
		return View::make('product.catalog_men')->with('products',$products);
	}

	public function getCatalogWomen(){
		$products = DB::table('products')
					->where('sex', 'F')
                    ->orderBy('name', 'desc')
                    ->paginate(9);
        if (Request::ajax()) {
            return Response::json(View::make('product.catalog_women-list', array('products' => $products))->render());
        }
		return View::make('product.catalog_women')->with('products',$products);
	}

	public function showAddProduct(){

		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				return View::make('product.add-product');
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function addProduct(){

		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$validator= Product::validate(Input::all());
				if($validator->fails()) {
					return Redirect::route('product-add-view')->withErrors($validator)->withInput();
				}
				else {
					Product::create(array(
						'name'=>Input::get('name'),
						'description'=>Input::get('description'),
						'cost'=>Input::get('cost'),
						'price'=>Input::get('price'),
						'weight'=>Input::get('weight'),
						'size'=>Input::get('size'),
						'sex'=>Input::get('sex'),
						'quantity'=>Input::get('quantity')
					));
					return Redirect::route('products')
						->with('success','The product was created successfully!');
				}
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function showEditProduct($id){


		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				return View::make('product.edit-product')
					->with('product', Product::find($id));
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function editProduct(){
		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$id = Input::get('id');
				$validator = Product::validate(Input::all());
				if($validator->fails()) {
					return Redirect::route('product-edit-view',$id)->withErrors($validator);
				}
				else {
					Product::where('id', $id)->update(array(
						'name'=>Input::get('name'),
						'description'=>Input::get('description'),
						'cost'=>Input::get('cost'),
						'price'=>Input::get('price'),
						'weight'=>Input::get('weight'),
						'size'=>Input::get('size'),
						'sex'=>Input::get('sex'),
						'quantity'=>Input::get('quantity')
					));
					return Redirect::route('product',$id)
						->with('success','The product was updated successfully!');
				}
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function deleteProduct(){
		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				Product::find(Input::get('id'))->delete();
				return Redirect::route('products')
						->with('success','The product was removed successfully!');
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function showAddImage($id){

		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$ids = ProductImage::distinct() -> lists('image_id');
				if(count($ids) == 0){
					$images = Images::orderBy('id','DESC')->paginate(12);
				}
				else{
					$images = Images::whereNotIn('id',$ids)->orderBy('id','DESC')->paginate(12);
				}
				if (Request::ajax()) {
		            return Response::json(View::make('product.catalog-add-image-list', array('products' => Product::find($id),'images'=> $images))->render());
		        }
				return View::make('product.product-add-image')
					->with('product', Product::find($id))
					->with('images', $images);
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function addProductImage(){

		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$images = Input::get('image');
				if(is_array($images))
				{
					foreach ($images as $image) {
						ProductImage::create(array(
							'product_id'=>Input::get('product_id'),
							'image_id'=>$image
						));
					}
					return Redirect::route('products')
							->with('success','Add Images to product was created successfully!');
				}
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function showDetail($id){
		return View::make('product.product-detail')->with('product',Product::find($id));
	}

	public function showRemoveImage($id){
		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$ids = ProductImage::where('product_id',$id)-> distinct() -> lists('image_id');
				if(count($ids) == 0){
					return Redirect::route('products')->with('fail' , 'No Image');
				}
			    $images = Images::whereIn('id', $ids)->orderBy('id','DESC')->paginate(12);
				if (Request::ajax()) {
		            return Response::json(View::make('product.product-remove-image-list', array('product' => Product::find($id),'images'=> $images))->render());
		        }
				return View::make('product.product-remove-image')
					->with('product', Product::find($id))
					->with('images', $images);
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function removeProductImage(){

		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$images = Input::get('image');
				if(is_array($images))
				{
					foreach ($images as $image) {
						ProductImage::where("image_id", $image)->delete();
					}
					return Redirect::route('products')
							->with('success','Remove images from product successfully!');
				}
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}
}