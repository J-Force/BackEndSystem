@extends('layout.newDefault')

@section('content') 
<!-- Page Content ================================================== -->
@include('layout.newNav')
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
                <ul class="nav nav-tabs" role="tablist">
                  
                  <li role="presentation"><a href="{{ URL::route('home') }}">Home</a></li>
                  <li role="presentation"><a href="{{ URL::route('catalog-man') }}">Men</a></li>
                  <li role="presentation" class="active"><a href="{{ URL::route('catalog-women') }}">Women</a></li>
                </ul>
                <ul class="nav nav-pills" role="tablist">
                  <li role="presentation" class="active"><a href="{{ URL::route('catalog-women') }}">All</a></li>
                  @foreach($category as $ca)
                  <li role="presentation"><a href="/jf-shop/catalog/women/{{ $ca->name }}">{{ $ca->name }}</a></li>
                  @endforeach
                </ul>
                <br>
<!-- ROW 1 -->
                @include('product.catalog_women-list')
    </div>


@endsection