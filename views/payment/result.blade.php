@extends('layout.newDefault')
@section('content')
	<?php 
		$uri = $_SERVER['REQUEST_URI'];
		$uri = explode("/",$uri);

	?>
	@include('layout.newNav')
	<!-- Section: result -->
		<section id="resultPayment" class="color-dark bg-white">
			<div class="container margintop-50 marginbot-50">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="animatedParent">
							<div class="section-heading text-center animated bounceInDown">
								<h2 class="h-bold">Thank you for your payment</h2>
								<div class="divider-header"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<h6>Congratulations. your payment was sent.</h6>
				<big>Transaction ID:</big><span id="transaction-id"><strong> {{ $uri[5] }} </strong></span>
				<p>Keep this Transaction ID and contact details in case you need to contact us.<br/>
					We have also emailed a receipt of this transaction to you.
				</p>
				<table class="table">
					<thead>
						<tr>
							<th>YOUR ORDER IS BEING SENT TO</th>
							<th>OUR CONTACT</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{$user->first_name.' '.$user->last_name}}</td>
							<td>J FORCE Contact</td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Quantity</th>
							<th>Unit Price</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
					@foreach($orders as $o)
						<tr>
							<td>{{$o['product_name']}}</td>
							<td>{{$o['quantity']}}</td>
							<td>{{number_format($o['price'],2)}}</td>
							<td>{{number_format($o['price']*$o['quantity'],2)}}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<div class="row col-md-12 text-right marginbot-40" style="font-size: 40px;">Total : <strong>{{$total_price}}</strong></div>
				<button type="button" class="btn btn-primary btn-success pull-right marginbot-50" onclick="location.href='{{URL::route('home')}}'">Home</button>
			</div>
		</section>

@endsection