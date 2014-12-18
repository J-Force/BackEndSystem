<div id="navigation">
	<nav class="navbar navbar-custom " role="navigation">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<div class="site-logo">
						<a href="{{ URL::route('home') }}" class="brand">J Force SHOP</a>
					</div>
				</div>
				<div class="col-md-10">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
						<i class="fa fa-bars"></i>
						</button>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="menu">
						<ul class="nav navbar-nav navbar-left">
							<!-- Search box -->
			        	</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="active"><a href="{{ URL::route('catalog-man') }}">Men</a></li>
              <li class="active"><a href="{{ URL::route('catalog-women') }}">Women</a></li>
							<li><a href="{{ URL::route('promotions') }}">Promotion</a></li>
              <li><a href="{{ URL::route('product-search-view') }}">Search</a></li>
							@if(!Auth::check())
								<li><a href="{{ URL::route('account-create') }}">Sign Up</a></li>
								<li><a href="{{ URL::route('account-sign-in') }}">Sign In</a></li>
              @else
                @if(Entrust::hasRole('Admin'))                 
                  <li><a href="{{ URL::route('admin') }}"> Admin </a></li>
                @endif
                <li class="wishlist"><a href="{{ URL::route('user-wishlist') }}">WishList</a></li>
                <li style="margin-top: 5px">
                    <div >
                      <div id="cart" class="btn-group btn-block" >
                        <button id="cart-dropdown" type="button" data-toggle="dropdown" class="btn btn-block btn-lg dropdown-toggle">
                          <i class="fa fa-shopping-cart"></i>
                          <span class="hidden-md">Cart:</span> 
                          <span id="cart-total"><span class="item-total">{{ Order::where('user_id' , '=' , Auth::user()->id )->count() }} item(s) </span> - THB <span class="price-total">0.00</span>
                          <i class="fa fa-caret-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" style="background: #B4FFF8">
                               
                        </ul>
                      </div>
                    </div>
                  </li>
								<li class="user_name"><a href="#" onclick="return false;" style="cursor: default"> {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
									<ul class="dropdown-menu">
										<li><a href="{{ URL::route('profile-user') }}">Account Settings</a></li>
                    <li><a href="{{ URL::route('bill-history-user') }}">Order History</a></li>
										<li><a class="sign_out" href="{{ URL::route('account-sign-out') }}">Log Out</a></li>
									</ul>
								</li>
							@endif
						</ul>
						
					</div>
					<!-- /.Navbar-collapse -->
				</div>
			</div>
		</div>
		<!-- /.container -->
	</nav>
</div>
<script>
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
<script>
$(document).ready(function(){

  updateCart();

  $("#cart").click(function(e) {
    
    updateCart();

  });

  function centerOfCartPop(product) {
    var output = [ "<tr >",
                      "<td class='text-left' style='background: #B4FFF8'>",
                          "<a href='/jf-shop/products/show/", product.product_id ,"'>",
                              (product.product_name).substring(0,15)+"...",
                          "</a>",
                      "</td>",                               
                      "<td class='text-left' style='color: #000000; background: #B4FFF8'>",
                        "x " , product.quantity ,
                      "</td>",
                      "<td class='text-left' style='color: #000000; background: #B4FFF8'>THB ",
                        (parseFloat(product.price * product.quantity)).toFixed(2),
                      "</td>",
                    "</tr>"].join("");
    return output;
  }

  function bottomOfCartPop() {

    var output = "";

    output += [     "</tbody>",
                      "</table>",
                   "</li>"].join("");

    output +=     ["<li>",
                      "<table class='table table-bordered total'>",
                          "<tbody>",
                              "<tr>",
                                "<td class='text-right'><strong>Total</strong></td>",
                                "<td class='text-left'>THB <span class='price-total'></span></td>",
                              "</tr>",
                          "</tbody>",
                      "</table>",
                      "<p class='text-center btn-block1' style='padding:0px'>",
                        "<a href='/jf-shop/user/orders'>",
                            "View Cart",
                        "</a>",
                        "<a href='/jf-shop/user/payment'>",
                          "Checkout",
                        "</a>",
                      "</p>",
                    "</li>"].join("");

    return output;
  }

  function updateCart() {
    $.get("/jf-shop/user/orders/get" , {} , function(res,status) {
        
        var output = [ "<li>" , 
                        "<table class='table table-striped hcart order'>",
                          "<thead>",
                            "<tr>",
                              "<th > Name</th>",
                              "<th> Qty. </th>",
                              "<th > Price </th>",
                            "</tr>",
                          "</thead>",
                          "<tbody>"].join("");

        for(var i = 0 ; i < res.length ;i++) {
          output += centerOfCartPop(res[i]);
        }

        output += bottomOfCartPop();

        $('#cart ul').html(output);
        update(res);
       
      });
  }


  function update(res) {
          var total = 0;
          var quantity = 0;
        
          for(var i = 0 ; i < res.length ;i++) {
            total += res[i].price * res[i].quantity;
            quantity += parseInt(res[i].quantity); 
          }

          $('.item-total').html( quantity + " item(s) ");
          $('.price-total').html(parseFloat(total).toFixed(2));
  }

});
</script>
<style>

  #cart-dropdown {
    background-color: #40E0D0;
  }

  .order {
    border-spacing: 0;
  }

  .order > thead > tr > th {
    padding-left: 42px;
    margin-left: 10px;
  }

  .order tbody , .order thead tr {
    display: block;
  }

  .order tbody {
    height: 200px;
    min-height: 200px;
    overflow-y: auto;
    overflow-x: hidden;
  }


</style>
	