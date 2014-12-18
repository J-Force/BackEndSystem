@extends('layout.newDefault')

@section('content') 
<!-- Page Content ================================================== -->
@include('layout.newNav')
@include('layout.menu_admin')
	<div style="margin-left:100px">
		<br/>
		<h1>Edit Product : {{ $product->name }}</h1>
		@if($errors->has())
		<ul class="error">
			{{ $errors->first('name','<li>:message</li>') }}
			{{ $errors->first('description','<li>:message</li>') }}
			{{ $errors->first('cost','<li>:message</li>') }}
			{{ $errors->first('price','<li>:message</li>') }}
			{{ $errors->first('weight','<li>:message</li>') }}
			{{ $errors->first('size','<li>:message</li>') }}
			{{ $errors->first('sex','<li>:message</li>') }}
			{{ $errors->first('quantity','<li>:message</li>') }}
		</ul>
		@endif
		{{ Form::open(array('url' => '/admin/products/update', 'method' => 'put')) }}
		{{ Form::token() }}
		<p>
			{{ Form::label('name') }}<br/>
			{{ Form::text('name',$product->name) }}
		</p>
		<p>
			{{ Form::label('description') }}<br/>
			{{ Form::textarea('description',$product->description) }}
		</p>
		<p>
			{{ Form::label('cost : example 10.00') }}<br/>
			{{ Form::text('cost',$product->cost) }}
		</p>
		<p>
			{{ Form::label('price : example 10.00') }}<br/>
			{{ Form::text('price',$product->price) }}
		</p>
		<p>
			{{ Form::label('weight : example 10.00') }}<br/>
			{{ Form::text('weight',$product->weight) }}
		</p>
		<p>
			{{ Form::label('size : example XL') }}<br/>
			{{ Form::text('size',$product->size) }}
		</p>
		<p>
			{{ Form::label('sex : M or F') }}<br/>
			{{ Form::text('sex',$product->sex) }}
		</p>
		<p>{{ Form::label('Category') }} -> Old : {{ $old_category }}<br/>
		   {{ Form::select('category' , $category , array(
		                  'class' => 'btn btn-default dropdown-toggle')) }}
		</p>
		<p>
			{{ Form::label('quantity : example 10') }}<br/>
			{{ Form::text('quantity',$product->quantity) }}
		</p>
		{{ Form::hidden('id',$product->id) }}
		<p>
			{{ Form::submit('Update Product') }}
		</p>
		{{ Form::close() }}
	</div>
	<style>
		.error li {
			color:red;
		}
	</style>
@endsection