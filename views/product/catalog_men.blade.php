@extends('layout.default')

@section('content') 
<!-- Page Content ================================================== -->

  <script>
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getPosts(page);
            }
        }
    });
 
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            getPosts($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });
 
    function getPosts(page) {
        document.getElementById("content").innerHTML='<div id="wait"><img src="/jf-shop/images/wait.gif" alt="" /><br /><br />Loading...</div>';
        $.ajax({
            url : '?page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $('.posts').html(data);
            location.hash = page;
        }).fail(function () {
            alert('Posts could not be loaded.');
        });
        //$('html, body').animate({ scrollTop: "600px" });
    }
  </script>
    <div class="container">
      <div class="col-md-12">
        <div class="col-md-6 text-right">
          <h4><a href="{{URL::route('catalog-women')}}">WOMEN</a></h4>
        </div>
        <div class="col-md-6">
            <h3><U><a href="{{URL::route('catalog-man')}}">MAN</a></U></h3>
        </div>
      </div>
<!-- ROW 0 -->
        <div class="row">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                              <!-- 1170 x 500 -->
                                <div class="item active">
                                    <img class="slide-image" style="" src="http://i1371.photobucket.com/albums/ag320/peterpanhihi/1_zpsbe861110.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://i1371.photobucket.com/albums/ag320/peterpanhihi/2_zpsd038e7bd.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://i1371.photobucket.com/albums/ag320/peterpanhihi/3_zps7923aafb.jpg" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>
                <ol class="breadcrumb">
                  <li><a href="{{ URL::route('home') }}">Home</a></li>
                  <li class="active">Man</li>
                </ol>
<!-- ROW 1 -->
                {{ $products->links() }}
                <div id="content">
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
              </div> <!--end content-->
                 {{ $products->links() }}
    </div>
<script>

  $(function() {
    $(".shop-cart").click(function(e) {
      e.preventDefault();
      $(".badge").html( parseInt($(".badge").html()) + 1 );
        $.post("/jf-shop/user/orders/add_cart", { product_id:$(this).attr("id") }, function(res) {
         
      });
    });
  });

</script>

@endsection