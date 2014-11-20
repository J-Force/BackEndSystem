@include('scripts.ajax-paging')

<style type="text/css">
  .sub-title{
    font-size: 20px;
    color: #ed4e6e;
  }
</style>
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
              <!-- <div><img src="http://i1371.photobucket.com/albums/ag320/peterpanhihi/1_zps8e1ff6d4.png" alt="" width="360" height="400"></div> -->
              @if( $images->count() == 0)
                <div><img src="/jf-shop/images/no-image.png" alt="" width="360" height="360"></div>
              @endif
              
              @foreach($images as $image) 
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
              @if(Auth::check())
                <a href="#" id="{{ $product->id }}" class="shop-cart" name="{{ $product->name }}" ><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart </a>
              @else
                <a href="{{URL::route('account-sign-in')}}" ><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart </a>
              @endif
            </div>
            <!-- <div class="ratings">
              <p class="pull-right">15 reviews</p>
              <p>
                  <span class="glyphicon glyphicon-star"></span>
                  <span class="glyphicon glyphicon-star"></span>
                  <span class="glyphicon glyphicon-star"></span>
                  <span class="glyphicon glyphicon-star"></span>
                  <span class="glyphicon glyphicon-star"></span>
              </p>
            </div> -->
          </div>
        </div>
         <?php $i++ ?>
      @endforeach
    </div>
    <div style="float:right">
      {{ $products->links() }}
    </div>
  </div> <!--end content-->
   @include('scripts.shop-cart')
