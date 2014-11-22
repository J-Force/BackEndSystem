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
		        			<?php
					            $ids = ProductImage::where('product_id', '=' ,$order->product_id )->lists('image_id');
					            if(count($ids) == 0){
					              $ids = array(0);
					            }
					            $images = Images::whereIn('id',$ids)->take(1)->get();
					        ?>
		        			 <td>
		        			 	@if($images->count() == 0)
					              <img src="/jf-shop/images/no-image.png" alt="" width="150" height="200">
					            @endif
					            @foreach ($images as $image) 
					              <img src="/jf-shop/{{ $image->link }}" alt="" width="150" height="200">
					            @endforeach
			                    <!-- <a href="#">
			                        <img alt="" src="i"></img>
			                    </a> -->
			                </td>
			                <td class="desc" style="padding-top:45px">
			                    <h6>
			                        <a href="{{ URL::route('product-id',array($order->product_id)) }}" >
										{{ $order->product_name }}
			                        </a>      
			                    </h6>
			                </td>
			                <td class="quantity" style="padding-top:45px">
			                    <div class="input-prepend input-append">
			                        <button class="btn decrease" id="{{ $order->product_id }}">
			                            <i class="glyphicon glyphicon-chevron-left"></i>
			                        </button>
			                        <input class="q_{{$order->product_id}}" id="{{ $order->product_id }}" type="text" value="{{$order->quantity}}" style="text-align:center" size="5" min="1" max="99999">
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
		                                <h2 class="price-total">
		                                    {{ number_format($total_price,2) }}
		                                </h2>
		                            </td>
		                        </tr>
		                        <tr>
		                            <td class="alignRight">
		                                <button class="btn" onclick='location.href="{{ URL::route("catalog-man") }}"'>
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

		$('input').change(function(){

			var product_id = $(this).attr('id');
			var quantity = parseInt($(this).val());

			if(quantity <= 0) {
				$(this).val(1);
				quantity = 1;
			}

			$.post( "/jf-shop/user/orders/add_cart" , 
			       { product_id:product_id , 
			       	quantity:quantity , 
			       	type:'input'} ,
			       function(res,status){
			       	 update();
			       }
			);
			
			
			var total_price = parseFloat( $('.q_'+product_id).val()  
				* parseFloat( $('.sub_price_'+product_id).html() )) ;

			$('.total_price_'+product_id).html( parseFloat(total_price).toFixed(2) );

			
			

		});

		$('.remove').click(function(e){

		    e.preventDefault();

		    var r = confirm('Do you want to remove this order line?');

		    var product_id = $(this).attr("id");

		    if( r ) {
	     		$.post( "/jf-shop/user/orders/remove_cart", 
	     			{ 
	     				product_id:  product_id 
	     			}, function(res,status) {}
	     		);

	     		$('.order_des_'+ product_id).remove();


				var quantity =  parseInt($('.item-total').html());
				var total = parseFloat($('.price-total').html());
				var total_price = parseFloat( $('.q_'+product_id).val() ) 
				* parseFloat( $('.sub_price_'+product_id).html() );

				quantity -= parseInt($('.q_'+product_id).val());
				total -= total_price;

				$('.item-total').html( (quantity) + " item(s) ");
        		$('.price-total').html(parseFloat(total).toFixed(2));

     		}
			
 		});

		
		$('.decrease').click(function(e) {
			e.preventDefault();


			if($(('.q_')+$(this).attr("id")).val() > 1 ) {

				var product_id = $(this).attr("id");

				$.post( "/jf-shop/user/orders/decrease" , 
					{ product_id: $(this).attr("id") ,quantity:1 } ,
					function(res,status){}
				);

				$('.q_'+product_id).val( parseInt( $( '.q_'+product_id ).val() ) - 1);

				var total_price = parseFloat( $('.q_'+product_id).val()  
					* parseFloat( $('.sub_price_'+product_id).html() )) ;

				$('.total_price_'+product_id).html( parseFloat(total_price).toFixed(2) );

				var quantity =  parseInt($('.item-total').html());
				var total = parseFloat($('.price-total').html());
				var sub_price = parseFloat( $('.sub_price_'+product_id).html() );
			
				total -= sub_price;


				$('.item-total').html( (quantity-1) + " item(s) ");
        		$('.price-total').html(parseFloat(total).toFixed(2));

			}
		});
		

		$('.increase').click(function(e) {
			e.preventDefault();

			var product_id = $(this).attr("id");
 
			  $.post( "/jf-shop/user/orders/increase" , 
			  { product_id: product_id , quantity: 1 } ,
			  function(res,status){
			  	console.log(res);
			  }
			);

			$( '.q_'+product_id ).val( parseInt( $( ('.q_')+product_id ).val()) + 1);		
				
			var total_price = parseFloat( $(('.q_')+product_id).val()  
				* parseFloat( $(('.sub_price_')+product_id).html() ));

			$('.total_price_'+product_id).html( parseFloat(total_price).toFixed(2) );

			var total = parseFloat($('.price-total').html());
			var quantity =  parseInt($('.item-total').html());

			var sub_price = parseFloat( $('.sub_price_'+product_id).html() );

			total += sub_price;

			$('.item-total').html( (quantity+1) + " item(s) ");
        	$('.price-total').html(parseFloat(total).toFixed(2));
			
		});

		function update() {
			$.get( "/jf-shop/user/orders/callback" ,
				   {} , 
				   function(res,data) {
				   	 $('.price-total').html(parseFloat(res[0]).toFixed(2));
				   	 $('.item-total').html( (res[1]) + " item(s) "); 
				   }
			);

		
		}

	});
</script>
@endsection

