@extends('layout.newDefault')

@section('content') 
<!-- Page Content ================================================== -->
@include('layout.newNav') 
@include('layout.menu_admin')

	<div style="margin-left:100px;">
		<br/>
		<h1>Select Images</h1>
		
		{{ Form::open(array('url' => 'products/add-image', 'method' => 'post')) }}
		{{ Form::token() }}
		{{ Form::hidden('product_id',$product->id) }}
		{{ Form::submit(' ADD IMAGES TO PRODUCT ', array('class' => 'btn-success')) }}
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="{{ URL::route('upload') }}" class="btn btn-primary">Upload image</a>
		<div class="container">
	     	@include('product.catalog-add-image-list')
		</div>
		{{ Form::close() }}
	</div>
@endsection