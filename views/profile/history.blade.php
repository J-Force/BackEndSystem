@extends('layout.newDefault')

@section('content')
	@include('layout.newNav')
<!-- Section: order-history -->
		<section id="order-history" class="color-dark bg-white">
			<div class="container margintop-50 marginbot-50">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="animatedParent">
							<div class="section-heading text-center animated bounceInDown">
								<h2 class="h-bold">Order History</h2>
								<div class="divider-header"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="container">
	            <table class="table table-hover">
	               <tr class="info">
		               <thead>
		                  <th>Bill ID</th>
		                  <th>Create Date</th>
		                  <th>Tracking URL</th>
		                  <th>Status</th>
		               </thead>
	               </tr>
	               @foreach( $orders as $order )
	               <tbody>
	                  <tr>
	                     <td>
	                     	<h4>
	                           <a href="{{URL::route('payment-result-last',$order->bill_id)}}">
	                           {{$order->bill_id}}
	                           </a>
	                        </h4> 
	                     </td>
	                     <td>
	                        <p>{{$order->created_at}}</p>
	                     </td>
	                     <td><a href='{{$order->url}}'>{{$order->url}}</a></td>
	                     @if($order->status == 'wait for customer acceptance')
	                     	<td><a href="{{$order->payment_url_callback.'/accept'}}">Accept Payment</a></td>
	                     @else
	                     	<td>{{$order->status}}</td>
	                     @endif
	                  </tr>
	               </tbody>
	               @endforeach
	               
	            </table>
         	</div>
      	</section>
      	<!-- /Section: order-history -->
@endsection