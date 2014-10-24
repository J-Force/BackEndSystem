<?php

class ProductController extends BaseController {
	public $restful = true;

	public function showProduct(){
		return View::make('product.product')->with('products',Product::all());
	}

	public function view($id){
		return View::make('product.view')->with('product',Product::find($id));
	}
}