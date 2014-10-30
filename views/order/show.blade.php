@extends('layout.default')
@section('content')
<div id = "cart">
	<table class="table">
		<tr>
    		<th>Product</th>
    		<th></th>
  		</tr>
		@foreach( $orders as $order ) 
		<tr class="order_des_{{ $order->id }}">
			<td >{{ $order->product_name }}</td>
			<td>
				<button id="{{ $order->id }}" class="btn btn-danger remove" name="order_id" value="{{ $order->quantity }}">
					Remove
				</button>
			</td>
		</tr>
		@endforeach

	</table>

</div>
<script type="text/javascript">
	$(document).ready(function(){

		$('.remove').click(function(e){
			var id = $(this).attr("id");
			
		    e.preventDefault();
		    if( $('.badge').text() > 0 )
		    	$(".badge").html( parseInt($(".badge").html()) - 1 );
		    else
		    	$(".badge").html( 0 );

		    $(('.order_des_')+ $(this).attr("id")).hide();
     		$.post( "/jf-shop/user/orders/remove_cart", 
     			{ 
     				order_id:  $(this).attr("id")  
     			}, function(res,status) {
     			
			});
			
 		});
	});
</script>
@endsection

