@extends('layout.newDefault')
@section('content')
@include('layout.newNav')
@if(Entrust::hasRole('Admin'))
    @include('layout.menu_admin')]
@endif
<style type="text/css">
  .sub-title{
    font-size: 20px;
    color: #ed4e6e;
  }
</style>
<script src="/jf-shop/js/jquery-ui.js"></script>	
<link href="/jf-shop/css/jquery-ui.css" rel="stylesheet">

  <section id="search" class="color-dark bg-white">
         <div class="container margintop-50 marginbot-50">
            <div class="row">
               <div class="col-lg-8 col-lg-offset-2">
                  <div class="animatedParent">
                     <div class="section-heading text-center animated bounceInDown">
                        <h2 class="h-bold">Search</h2>
                        <div class="divider-header"></div>
                        <br>
                        
                     </div>
                  </div>
               </div>
               <center>
	                        <form class="navbar-form" role="search">
	  							<div class="form-group">
	    							<input id="auto" name="auto" type="text" style="width: 500px"class="form-control" placeholder="Search">
	  							</div>
	  							<button id="button" class="btn btn-default">Submit</button>
							</form>
						</center>
						<br><br><br>
                <div id="content">
      <?php $i=0 ?>
      <div class="row">
      @foreach($products as $product)
        
        @if($i % 3 == 0 )
          </div><div class="row">
        @endif

        <div class="col-md-4 grid cs-style-4">
          <?php
            $ids = ProductImage::where('product_id', '=' ,$product->id )->lists('image_id');
            if(count($ids) == 0){
              $ids = array(0);
            }
            $images = Images::whereIn('id',$ids)->take(1)->get();
          ?>
          <div class="thumbnail">
            <figure>
              @if($images->count() == 0)
                <div><img src="/jf-shop/images/no-image.png" alt="" width="360" height="360"></div>
              @endif
              @foreach ($images as $image) 
                <div><img src="/jf-shop/{{ $image->link }}" alt="" width="360" height="360"></div>
              @endforeach
              <figcaption>
                <h3>ID : {{ $product->id }}</h3>
                <div class="sub-title">Size : {{ $product->size }}</div>
                <div class="sub-title">Quantity : {{ $product->quantity }}</div>
                <a href="{{ URL::route('product-id',array($product -> id)) }}">Take a look</a>
              </figcaption>
            </figure>
            <div class="caption text-center">
              <h5>{{ $product -> name }}</h5>
              <h6>THB <span class="price_{{ $product->id }}">{{ $product -> price }}</span></h6>
              
                <a href="#" id="{{ $product->id }}" class="shop-cart" name="{{ $product->name }}" ><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart </a>
                <br>
                <a href="#" id="{{ $product->id }}" class="add-wish" ><span class="glyphicon glyphicon-star"></span> Add to Wishlist </a>
            </div>
          </div>
        </div>
        <?php $i++ ?>
      @endforeach
    </div>
  </div> <!--end content-->
            </div>
         </div>
         <br><br>
      </section>
<script>

$(function() {

	$("#button").click(function(e) {
		e.preventDefault();
		window.location.href = "/jf-shop/search/" + $("#auto").val();
	});
	$("#auto").keyup(function(e) {
		if (e.keyCode == 13) {
			window.location.href = "/jf-shop/search/" + $(this).val();
		}
	});
    $("#auto").autocomplete({
      source: "/jf-shop/getdata",
      select: function(event, ui){
        $('#auto').val(ui.item.id);
    	}
    });
});
</script>
@include('scripts.shop-cart')
@include('scripts.shop-wishlist')
@endsection