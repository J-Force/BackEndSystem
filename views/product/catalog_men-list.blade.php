@include('scripts.ajax-paging')
<style type="text/css">
  .sub-title{
    font-size: 20px;
    color: #ed4e6e;
  }
</style>
  <div id="content">
    {{ $products->links() }}
      <?php $i=0 ?>
      <div class="row">
      @foreach($products as $product)
        
        @if($i % 3 == 0 )
          </div><div class="row">
        @endif

        <div class="col-md-4 grid cs-style-4">
          <?php
            $images = ProductImage::where('product_id', '=' ,$product->id )->take(1)->get();
            foreach ($images as $image)
              {
                  echo $image->link;
              }
          ?>
          <div class="thumbnail">
            <figure>
              <div><img src="http://i1371.photobucket.com/albums/ag320/peterpanhihi/1_zpsfcda112b.jpg" alt="" width="360" height="400"></div>
              <figcaption>
                <h3>ID : {{ $product->id }}</h3>
                <div class="sub-title">Size : {{ $product->size }}</div>
                <div class="sub-title">Quantity : {{ $product->quantity }}</div>
                <a href="{{ URL::route('product',array($product -> id)) }}">Take a look</a>
              </figcaption>
            </figure>
            <div class="caption text-center">
              <h5>{{ $product -> name }}</h5>
              <h6>THB {{ $product -> price }}</h6>
              <a href="#" id="{{ $product->id }}" class="shop-cart" name="{{ $product->name }}" ><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart </a>
            </div>
            <div class="ratings">
              <p class="pull-right">15 reviews</p>
              <p>
                  <span class="glyphicon glyphicon-star"></span>
                  <span class="glyphicon glyphicon-star"></span>
                  <span class="glyphicon glyphicon-star"></span>
                  <span class="glyphicon glyphicon-star"></span>
                  <span class="glyphicon glyphicon-star"></span>
              </p>
            </div>
          </div>
        </div>
        <?php $i++ ?>
      @endforeach
    </div>
    <div style="float:right">
      {{ $products->links() }}
    </div>
  </div> <!--end content-->
