@extends('layout.newDefault')
@section('content')

@include('layout.newNav')
<section id="about" class="color-dark bg-white">
			<div class="container margintop-50 marginbot-50">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="animatedParent">
							<div class="section-heading text-center animated bounceInDown">
								<h2 class="h-bold">CART</h2>
								<div class="divider-header"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php $total_price = 0 ?>

			<div class="container" style = "margin-bottom: 100px">
		    <div class="row">
		        <div class="span12">
    			<table class="table">
    				<!-- table head -->
		        	<thead>
			            <tr>
			                <th><span> Image </span></th>
			                <th class="desc"><span> Product's Name </span></th>
			                <th><span> Quantity </span></th>
			                <th><span> Unit Price </span></th>
			                <th><span> Price </span></th>
			                <th><span> Remove </span></th>
			            </tr>
		        	</thead>
		        	<tbody>
		        	@foreach( $orders as $order )
		        		<tr class="order_des_{{ $order->product_id }}" >
		        			 <td>
			                    <a href="#">
			                        <img alt="" src="img/cart-item.png"></img>
			                    </a>
			                </td>
			                <td class="desc" style="padding-top:45px">
			                    <h6>
			                        <a href="#" >
										{{ $order->product_name }}
			                        </a>      
			                    </h6>
			                </td>
			                <td class="quantity" style="padding-top:45px">
			                    <div class="input-prepend input-append">
			                        <button class="btn decrease" id="{{ $order->product_id }}">
			                            <i class="glyphicon glyphicon-chevron-left"></i>
			                        </button>
			                        <input class="q_{{$order->product_id}}" type="text" value="{{$order->quantity}}" style="text-align:center" size="5">
			                        <button class="btn increase" id="{{ $order->product_id }}" >
			                            <i class="glyphicon glyphicon-chevron-right"></i>
			                        </button>
			                    </div>
			                </td>
			                <td class="sub-price" style="padding-top:45px">
			                    <h6 class="sub_price_{{$order->product_id}}">
			                       {{ $order->price }}
			                    </h6>
			                </td>
			                <?php $total_price += $order->price * $order->quantity ?>
			                <td class="total-price" style="padding-top:45px">
			                    <h6 class="total_price_{{$order->product_id}}">
			                        {{ number_format(($order->price * $order->quantity),2) }}
			                    </h6>
			                </td>
			                <td>
			                	<button class="btn btn-small btn-danger remove" data-tip="tooltip" data-placement="top" data-title="Remove" data-original-title="" style="margin-top:32.5px"
			                	name="product_id" id="{{ $order->product_id }}" >
			                        <i class="glyphicon glyphicon-trash"></i>
			                    </button>
							</td>
		        		</tr>
		        	@endforeach
		        	</tbody>
		        </table>
		        <br><br>
		        </div>

		        <div class="span5">
		            <div class="cart-receipt">
		                <table class="table table-receipt">
		                    <tbody>
		                            <td class="alignRight">
		                                <h2>
		                                    Total
		                                </h2>
		                            </td>
		                            <td class="alignLeft">
		                                <h2 id="total-price">
		                                    {{ number_format($total_price,2) }}
		                                </h2>
		                            </td>
		                        </tr>
		                        <tr>
		                            <td class="alignRight">
		                                <button class="btn">
		                                    Contuine Shoping
		                                </button>
		                            </td>
		                            <td class="alignLeft">
		                                <button class="btn btn-primary">
		                                    Checkout
		                                </button>
		                            </td>
		                        </tr>
		                    </tbody>
		                </table>
		            </div>
		        </div>
		    </div>
		    </div>
</section>

<script type="text/javascript">

	$(document).ready(function(){

		$('.remove').click(function(e){

		    e.preventDefault();

		    var r = confirm('Do you want to remove this order line?');

		    if( r ) {
	     		$.post( "/jf-shop/user/orders/remove_cart", 
	     			{ 
	     				product_id:  $(this).attr("id")  
	     			}, function(res,status) {
	     				updatePrice();
				});

	     		$(('.order_des_')+ $(this).attr("id")).hide();
			
			    $(".badge").html( parseInt( $(".badge").html() ) - parseInt( $( ('.q_')+$(this).attr("id") ).val() ) );
		
     		}
			
 		});

		
		$('.decrease').click(function(e) {
			e.preventDefault();


			if($(('.q_')+$(this).attr("id")).val() > 1 ) {

				$.post( "/jf-shop/user/orders/decrease" , { product_id: $(this).attr("id") } ,function(res,status){
					updatePrice();
				});

				$(('.q_')+$(this).attr("id")).val( parseInt( $( ('.q_')+$(this).attr("id") ).val() ) - 1);

				var total = parseInt( $(('.q_')+$(this).attr("id")).val() ) * parseFloat( $(('.sub_price_')+$(this).attr("id")).html() );

				$(('.total_price_')+$(this).attr("id")).html( parseFloat( total).toFixed(2));
				$(".badge").html( parseInt($(".badge").html()) - 1 );

				updatePrice();
			}
		});
		

		$('.increase').click(function(e) {
			e.preventDefault();

			$.post( "/jf-shop/user/orders/increase" , { product_id: $(this).attr("id") } ,function(res,status){
				updatePrice();

			});

			$( ('.q_')+$(this).attr("id") ).val( parseInt( $( ('.q_')+$(this).attr("id") ).val()) + 1);
			var total = parseInt( $(('.q_')+$(this).attr("id")).val() ) * parseFloat( $(('.sub_price_')+$(this).attr("id")).html() );

			$(('.total_price_')+$(this).attr("id")).html( parseFloat(total).toFixed(2) );
			$(".badge").html( parseInt($(".badge").html()) + 1 );

			
			
		});

		function updatePrice() {
			$.get("/jf-shop/user/orders/get" , {} , function(res,status) {
				
				var total = 0;
				for(var i = 0 ; i < res.length ;i++) {
					total += res[i].price * res[i].quantity;
				}

				$('#total-price').html(parseFloat(total).toFixed(2));
			});
		}

	});
</script>
@endsection

