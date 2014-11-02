@extends('layout.newDefault')

@section('content') 
<!-- Page Content ================================================== -->
@include('layout.newNav')
@include('scripts.ajax-paging')
  <section id="about" class="color-dark bg-white">
      <div class="container margintop-50 marginbot-50">
        <div class="row">
          <div class="col-lg-8 col-lg-offset-2">
            <div class="animatedParent">
              <div class="section-heading text-center animated bounceInDown">
                <h2 class="h-bold">WOMEN</h2>
                <div class="divider-header"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <!-- ROW 0 -->
        <div class="row">
          <div class="row marginbot-50">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <!-- 1170 x 500 -->
                <div class="item active">
                  <img class="slide-image" src="http://i1371.photobucket.com/albums/ag320/peterpanhihi/4_zpsad86201c.jpg" alt="">
                </div>
                <div class="item">
                  <img class="slide-image" src="http://i1371.photobucket.com/albums/ag320/peterpanhihi/5_zps81bc2405.jpg" alt="">
                </div>
                <div class="item">
                  <img class="slide-image" src="http://i1371.photobucket.com/albums/ag320/peterpanhihi/6_zps12f82c56.jpg" alt="">
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
                  <li class="active">Women</li>
                </ol>
<!-- ROW 1 -->
                @include('product.catalog_women-list')
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