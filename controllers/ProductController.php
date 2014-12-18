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
		$category = Category::orderBy('name')->get();
		$products = DB::table('products')
					->where('sex', 'M')
                    ->orderBy('name', 'desc')
                    ->paginate(9);

        foreach($products as $p) {
        	$promo_product = DB::table('product_promotion')->where('product_id','=',$p->id)->first();
        	if($promo_product){
        		$p->type = $promo_product->type;
        		$p->sale = 1;
        		$p->value = $promo_product->value;
        	}else {
        		$p->type = 0;
        		$p->sale = 0;
        		$p->value = 0;
        	}
        }

        if (Request::ajax()) {
            return Response::json(View::make('product.catalog_men-list', array('products' => $products))->render());
        }
		return View::make('product.catalog_men')->with('products',$products)->with('category',$category);
	}

	public function getCatalogMenByCat($cat){
		$category = Category::orderBy('name')->get();
		$cate = Category::where('name','=',$cat)->first();
		$products = DB::table('products')
					->where('sex', 'M')
					->where('category_id',$cate->id)
                    ->orderBy('name', 'desc')
                    ->paginate(9);

        foreach($products as $p) {
        	$promo_product = DB::table('product_promotion')->where('product_id','=',$p->id)->first();
        	if($promo_product){
        		$p->type = $promo_product->type;
        		$p->sale = 1;
        		$p->value = $promo_product->value;
        	}else {
        		$p->type = 0;
        		$p->sale = 0;
        		$p->value = 0;
        	}
        }

        if (Request::ajax()) {
            return Response::json(View::make('product.catalog_men-list', array('products' => $products))->render());
        }
		return View::make('product.catalog_men')->with('products',$products)->with('category',$category);
	}

	public function getCatalogWomen(){
		$category = Category::orderBy('name')->get();
		$products = DB::table('products')
					->where('sex', 'F')
                    ->orderBy('name', 'desc')
                    ->paginate(9);
        foreach($products as $p) {
        	$promo_product = DB::table('product_promotion')->where('product_id','=',$p->id)->first();
        	if($promo_product){
        		$p->type = $promo_product->type;
        		$p->sale = 1;
        		$p->value = $promo_product->value;
        	}else {
        		$p->type = 0;
        		$p->sale = 0;
        		$p->value = 0;
        	}
        }
        if (Request::ajax()) {
            return Response::json(View::make('product.catalog_women-list', array('products' => $products))->render());
        }
		return View::make('product.catalog_women')->with('products',$products)->with('category',$category);
	}

	public function getCatalogWomenByCat($cat){
		$category = Category::orderBy('name')->get();
		$cate = Category::where('name','=',$cat)->first();
		$products = DB::table('products')
					->where('sex', 'F')
					->where('category_id',$cate->id)
                    ->orderBy('name', 'desc')
                    ->paginate(9);

        foreach($products as $p) {
        	$promo_product = DB::table('product_promotion')->where('product_id','=',$p->id)->first();
        	if($promo_product){
        		$p->type = $promo_product->type;
        		$p->sale = 1;
        		$p->value = $promo_product->value;
        	}else {
        		$p->type = 0;
        		$p->sale = 0;
        		$p->value = 0;
        	}
        }

        if (Request::ajax()) {
            return Response::json(View::make('product.catalog_women-list', array('products' => $products))->render());
        }
		return View::make('product.catalog_women')->with('products',$products)->with('category',$category);
	}

	public function showAddProduct(){

		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$category = Category::lists('name', 'id');
				return View::make('product.add-product')->with('category',$category);
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function addProduct(){

		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$validator = Validator::make(Input::all(),array(
						'name' 					=> 'required|max:255',
						'cost'  				=> 'required|regex:/^\d*(\.\d{2})?$/',
						'price' 				=> 'required|regex:/^\d*(\.\d{2})?$/',
						'description'			=> 'required|max:255',
						'weight'				=> 'required|regex:/^\d*(\.\d{2})?$/',
						'size'					=> 'required|max:5',
						'sex'					=> 'required|max:1',
						'quantity'				=> 'required|integer',
					));
				if($validator->fails()) {
					return Redirect::route('product-add-view')
					               ->withErrors($validator)->withInput();
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
						'category_id'=>Input::get('category'),
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
				$product = Product::find($id);
				$old_category = Category::where('id','=',$product->category_id)->pluck('name');
				$category = Category::lists('name', 'id');
				return View::make('product.edit-product')
					->with('product', $product)
					->with('category',$category)
					->with('old_category',$old_category);
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function editProduct(){
		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$id = Input::get('id');
				$validator = Validator::make(Input::all(),array(
						'name' 					=> 'required|max:255',
						'cost'  				=> 'required|regex:/^\d*(\.\d{2})?$/',
						'price' 				=> 'required|regex:/^\d*(\.\d{2})?$/',
						'description'			=> 'required|max:255',
						'weight'				=> 'required|regex:/^\d*(\.\d{2})?$/',
						'size'					=> 'required|max:5',
						'sex'					=> 'required|max:1',
						'quantity'				=> 'required|integer',
					));

				if($validator->fails()) {
					
					return Redirect::route('product-edit-view',$id)
					                ->withErrors($validator)
					                ->withInput();
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
						'category_id'=>Input::get('category'),
						'quantity'=>Input::get('quantity')
					));
					return Redirect::route('product-id',$id)
						->with('success','The product was updated successfully!');
				}
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function deleteProduct($id){
		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$reviews = Review::where('product_id','=',$id)->get();
				Rate::where('product_id','=',$id)->delete();

				foreach($reviews as $r) {
					Comment::where('id' ,'=' , $r->comment_id)->delete();
					$r->delete();
				}

				Product::find($id)->delete();
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
				$id = Input::get('product_id');
				if(is_array($images))
				{
					foreach ($images as $image) {
						ProductImage::create(array(
							'product_id'=>$id,
							'image_id'=>$image
						));
					}
					return Redirect::route('product-id',$id)
							->with('success','Add Images to product was created successfully!');
				}
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function showDetail($id){

		$reviews = Review::where('product_id','=',$id)->orderBy('id','DESC')->get();

		$product = Product::find($id);
		$pp = DB::table('product_promotion')->where('product_id','=',$id)->first();

		$promotion = Promotion::find($pp->promotion_id);
		$promotion->type = $pp->type;
		$promotion->value = $pp->value;
		$promotion->sale = 1;


		return View::make('product.product-detail')->with('product',$product)->with('reviews',$reviews)
					->with('promotion',$promotion);
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

	public function showSearch(){
		$products = Product::all()->take(0);
		return View::make('product.search-product')->with('products',$products);
	}

	public function getData(){
		$term      = Input::get('term');
        $associate = array();
        $search    = DB::table('products')
					->where('name', 'LIKE', '%'.$term.'%')->take(10)->get();

        foreach ($search as $result) {
            $associate[] = $result->name;

        }

        return Response::json($associate);
	}

	public function searchProduct($name){
		// $first = Product::leftJoin('category', 'products.category_id', '=', 'category.id')
  		//           		->where('category.name','=',$name
		$category = Category::where('name','=',$name)->get();
		if(count($category) != 0){
			$first = Product::where('category_id', '=', $category->id);
			$products = Product::where('name', 'LIKE', '%'.$name.'%')->union($first)->get();
		}
		else {
  			$products = Product::where('name', 'LIKE', '%'.$name.'%')->get();
  		}
		return View::make('product.search-product')->with('products',$products);
		// $out = "";

		// foreach ($products as $product) {
  //           $out .= $product->name."<br>";
  //       }
		// return Response::json($out);
	}

	public function addCategory(){
		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$validator = Validator::make(Input::all(),array(
						'name' 					=> 'required|max:255'
					));
				if($validator->fails()) {
					return Redirect::route('category-add-view')
					               ->withErrors($validator)->withInput();
				}
				else {
					Category::create(array(
						'name'=>Input::get('name')
					));
					return Redirect::route('category-add-view')
						->with('success','The category was created successfully!');
				}
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function showAddCategory(){

		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				return View::make('product.add-category')
				->with('categories', Category::all());
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function deleteCategory($id){
		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				Category::find($id)->delete();
				return Redirect::route('category-add-view')
						->with('success','The category was removed successfully!');
			}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}
}