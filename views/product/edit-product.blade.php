@extends('layout.newDefault')

@section('content') 
<!-- Page Content ================================================== -->
@include('layout.newNav')
@include('layout.menu_admin')
	<div style="margin-left:100px">
		<br/>
		<h1>Edit Product : {{ $product->name }}</h1>
		@if($errors->has())
		<ul>
			{{ $errors->first('name','<li>:message</li>') }}
			{{ $errors->first('description','<li>:message</li>') }}
		</ul>
		@endif
		{{ Form::open(array('url' => 'products/update', 'method' => 'put')) }}
		{{ Form::token() }}
		<p>
			{{ Form::label('name') }}<br/>
			{{ Form::text('name',$product->name) }}
		</p>
		<p>
			{{ Form::label('description') }}<br/>
			{{ Form::textarea('description',$product->description) }}
		</p>
		{{ Form::hidden('id',$product->id) }}
		<p>
			{{ Form::submit('Update Product') }}
		</p>
		{{ Form::close() }}
	</div>
@endsection