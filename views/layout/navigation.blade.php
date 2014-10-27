<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::route('home') }}"><img alt="Brand" src="/jf-shop/glyphicons/png/J.png"></a>
      </div>
      <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-left">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#about">About</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catalog <b class="caret"></b></a>
            <ul class="dropdown-menu multi-column columns-3">
              <div class="row">
                <div class="col-sm-4">
                  <ul class="multi-column-dropdown">
                    <li><a href="#">NEW</a></li>
                    <li><a href="#">SPECIAL PRICES</a></li>
                    <li class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </div>
                <div class="col-sm-4">
                  <ul class="multi-column-dropdown">
                    <li class="dropdown-header">CLOTHING</li>
                    <li class="divider"></li>
                    <li><a href="#">Dresses</a></li>
                    <li><a href="#">Coats</a></li>
                    <li><a href="#">Jackets</a></li>
                    <li><a href="#">Cardigans and sweaters</a></li>
                    <li><a href="#">Blouses and shirts</a></li>
                    <li><a href="#">T-shirts and tops</a></li>
                    <li><a href="#">Trousers</a></li>
                    <li><a href="#">Jeans</a></li>
                    <li><a href="#">Skirts</a></li>
                    <li><a href="#">Shorts</a></li>
                    <li><a href="#">Jumpsuits</a></li>
                    <li><a href="#">Intimates</a></li>
                    <li><a href="#">Sport</a></li>
                  </ul>
                  </div>
                  <div class="col-sm-4">
                    <ul class="multi-column-dropdown">
                      <li class="dropdown-header">ACCESSORIES</li>
                      <li class="divider"></li>
                      <li><a href="#">Shoes</a></li>
                      <li><a href="#">Bags</a></li>
                      <li><a href="#">Jewellery</a></li>
                      <li><a href="#">Leather goods</a></li>
                      <li><a href="#">Belts</a></li>
                      <li><a href="#">Hats and caps</a></li>
                      <li><a href="#">Foulards and scarves</a></li>
                      <li><a href="#">Gloves</a></li>
                      <li><a href="#">Sunglasses</a></li>
                      <li><a href="#">Other accessories</a></li>
                    </ul>
                  </div>
                </div>
              </ul>
            </li>
          </ul>
          <!-- <ul class="nav navbar-nav navbar-center">
            <form class="navbar-form" role="search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="q">
                  <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                  </div>
              </div>
            </form>
          </ul> -->
          <ul class="nav navbar-nav navbar-right">
          @if(Auth::check())
            <li><a href="{{URL::route('profile-user')}}">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a></li>
          	<li><a href="{{URL::route('account-sign-out')}}">Sign Out</a></li>
          @else
            <li><a href="{{URL::route('account-create')}}">Sign Up</a></li>
            <li><a href="{{URL::route('account-sign-in')}}">Sign In</a></li> 
          @endif   
          </ul>
      </div>
    </div>
  </div>