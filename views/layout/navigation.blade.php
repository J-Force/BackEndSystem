<script type="text/javascript">
 $(document).ready(function(){
  var submitIcon = $('.searchbox-icon');
  var inputBox = $('.searchbox-input');
  var searchBox = $('.searchbox');
  var rightMenu = $('.navbar-right');
  var isOpen = false;
  submitIcon.click(function(){
   if(isOpen == false){
    searchBox.addClass('searchbox-open');
    inputBox.focus();
    isOpen = true;
    rightMenu.hide();

   } else {
    searchBox.removeClass('searchbox-open');
    inputBox.focusout();
    isOpen = false;
    rightMenu.show();
   }
  }); 
   submitIcon.mouseup(function(){
    return false;
   });
   searchBox.mouseup(function(){
    return false;
   });
  $(document).mouseup(function(){
   if(isOpen == true){
    $('.searchbox-icon').css('display','block');
    submitIcon.click();
  }
  });
});
function buttonUp(){
 var inputVal = $('.searchbox-input').val();
 inputVal = $.trim(inputVal).length;
 if( inputVal !== 0){
  $('.searchbox-icon').css('display','none');
 } else {
  $('.searchbox-input').val('');
  $('.searchbox-icon').css('display','block');
 }
}
</script>
<style type="text/css">
  .searchbox-icon,
  .searchbox-submit{
   width:50px;
   height:30px;
   display:block;
   position:absolute;
   top:0;
   font-family:verdana;
   font-size:18px;
   right:0;
   padding:0;
   margin:0;
   border:0;
   outline:0;
   line-height:30px;
   text-align:center;
   cursor:pointer;
   color:#dcddd8;
   background:#172b3c;
  }
  .searchbox{
   margin-top: 10px;
   margin-left: 10px;
   position:relative;
   min-width:50px;
   width:0%;
   height:30px;
   float:right;
   overflow:hidden;
   -webkit-transition: width 0.3s;
   -moz-transition: width 0.3s;
   -ms-transition: width 0.3s;
   -o-transition: width 0.3s;
   transition: width 0.3s;
  }
  .searchbox-open{
   width:40%;
  }
  .searchbox-input{
   position:absolute;
   top:0;
   right:0;
   border:0;
   outline:0;
   background:#dcddd8;
   width:90%;
   height:30px;
   margin:0;
   padding-left: 20px;
   font-size:18px;
   color:red;
  }
  .searchbox-input::-webkit-input-placeholder {
   color: #d74b4b;
  }
  .searchbox-input:-moz-placeholder {
   color: #d74b4b;
  }
  .searchbox-input::-moz-placeholder {
   color: #d74b4b;
  }
  .searchbox-input:-ms-input-placeholder {
   color: #d74b4b;
  }
</style>
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
        <li class="active"><a id="home" href="{{ URL::route('home') }}">Home</a></li>
        <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Women <b class="caret"></b></a>
              <ul class="dropdown-menu multi-column columns-3 full-width">
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
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Man <b class="caret"></b></a>
              <ul class="dropdown-menu multi-column columns-3 full-width">
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
            <!-- <li>
              <form class="navbar-search" action>
                <input type="text" class="search-query span2" placeholder="Search">
              </form>
            </li> -->
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
          <li class="searchbox">
              <input type="text" placeholder="Search......" name="search" class="searchbox-input" required>
              <input type="submit" class="searchbox-submit" value="GO">
              <span class="searchbox-icon"><span class="glyphicon glyphicon-search"></span></span>
            </li>
          <ul class="nav navbar-nav navbar-right">
          @if(!Auth::check())
            <li><a href="{{ URL::route('account-create') }}">Sign Up</a></li>
            <li><a href="{{ URL::route('account-sign-in') }}">Sign In</a></li>  
          @else
            <li class="cart">
              <a href="#">
                <span class="glyphicon glyphicon-shopping-cart"></span>
                <span class="badge alert-success bakset-count" style="margin-left:-5px">
                  {{ Order::where('user_id' , '=' , Auth::user()->id )->count() }}
                </span>
              </a>
              
              
            </li>
            <li><a href="#"> {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
              <ul class="dropdown-menu">
                  <li><a href="{{ URL::route('profile-user') }}">Account Settings</a></li>
                  <li><a href="{{ URL::route('account-sign-out') }}">Log Out</a></li>
              </ul>
            </li>
          @endif
        </ul>
      </div>

      <div class="cart-pop" style="display:none">
        <!-- <a href="{{ URL::route('user-order') }}">Go to cart page</a>
        </br> -->
      </div>

    </div>
  </div>

  <script>
  $(document).ready(function(){
      $('.navbar-nav > li.cart').click(function() 
      { 
        showOrderCart();
        $('.cart-pop').toggle();
      });
  });

  function showOrderCart() {
    $.get("/jf-shop/user/orders/get" , {} , function(res) {
      var add = "";
      for(var i = 0 ; i < res.length ; i++) {
        add += "<span>" + res[i].product_name + " " + res[i].quantity + "</span></br>";
      }

      var link = '<a href="' + '/jf-shop/user/orders' +'">Go to cart page</a>';

      $('.cart-pop').html(link + '</br>' + add);
     
    });
  }

  </script>