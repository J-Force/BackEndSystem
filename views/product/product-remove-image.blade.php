@extends('layout.newDefault')

@section('content') 
<!-- Page Content ================================================== -->
@include('layout.newNav') 
@include('layout.menu_admin')

	<div style="margin-left:100px;">
		<br/>
		<h1>Select Images</h1>
		{{ Form::open(array('url' => 'products/remove-image', 'method' => 'delete')) }}
		{{ Form::token() }}
		{{ Form::hidden('product_id',$product->id) }}
		{{ Form::submit(' Remove ', array('class' => 'btn-danger')) }}
		<br><br>
		<div class="container">
	     	@include('product.product-remove-image-list')
		</div>
		{{ Form::close() }}
	</div>
@endsection