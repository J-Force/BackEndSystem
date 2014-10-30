@include('scripts.ajax-paging')
  <div id="content">
    {{ $products->links() }}
    <div class="row">
      @foreach($products as $product)
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
                <h4>Size : {{ $product->size }}</h4>
                <h4>Quantity : {{ $product->quantity }}</h4>
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
      @endforeach
    </div>
    {{ $products->links() }}
  </div> <!--end content-->
