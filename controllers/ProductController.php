<?php

class ProductController extends BaseController {
	public $restful = true;

	public function showProduct(){
		return View::make('product.product')->with('products',Product::all());
	}

	public function view($id){
		return View::make('product.view')->with('product',Product::find($id));
	}

	public function getCatalogMen(){
		$products = DB::table('products')
					->where('sex', 'M')
                    ->orderBy('name', 'desc')
                    ->take(10)
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
                    ->take(5)
                    ->get();
		return View::make('product.catalog_women')->with('products',$products);
	}

	public function showAddProduct(){
		return View::make('product.add-product');
	}

	public function addProduct(){
		$validator= Product::validate(Input::all());
		if($validator->fails()) {
			return Redirect::route('product-add-view')->withErrors($validator)->withInput();
		}
		else {
			Product::create(array(
				'name'=>Input::get('name'),
				'description'=>Input::get('description')
			));
			return Redirect::route('products')
				->with('success','The product was created successfully!');
		}
	}

	public function showEditProduct($id){
		return View::make('product.edit-product')
			->with('product', Product::find($id));
	}

	public function editProduct(){
		$id = Input::get('id');
		$validator = Product::validate(Input::all());
		if($validator->fails()) {
			return Redirect::route('product-edit-view',$id)->withErrors($validator);
		}
		else {
			Product::where('id', $id)->update(array(
				'name'=>Input::get('name'),
				'description'=>Input::get('description')
			));
			return Redirect::route('product',$id)
				->with('success','The product was updated successfully!');
		}
	}

	public function deleteProduct(){
		Product::find(Input::get('id'))->delete();
		return Redirect::route('products')
				->with('success','The product was removed successfully!');
	}

	public function showAddImage($id){
		return View::make('product.product-add-image')
			->with('product', Product::find($id));
	}
}