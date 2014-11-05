@extends('layout.newDefault')

@section('content') 
<!-- Page Content ================================================== -->
@include('layout.newNav') 
@include('layout.menu_admin')
	<div style="margin-left:100px">
		<br/>
		<h1>Add New Products</h1>
		@if($errors->has())
		<ul>
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
		{{ Form::open(array('url' => 'products/create')) }}
		{{ Form::token() }}
		<p>
			{{ Form::label('name') }}<br/>
			{{ Form::text('name',Input::old('name')) }}
		</p>
		<p>
			{{ Form::label('description') }}<br/>
			{{ Form::textarea('description',Input::old('description')) }}
		</p>
		<p>
			{{ Form::label('cost : example 10.00') }}<br/>
			{{ Form::text('cost',Input::old('cost')) }}
		</p>
		<p>
			{{ Form::label('price : example 10.00') }}<br/>
			{{ Form::text('price',Input::old('price')) }}
		</p>
		<p>
			{{ Form::label('weight : example 10.00') }}<br/>
			{{ Form::text('weight',Input::old('weight')) }}
		</p>
		<p>
			{{ Form::label('size : example XL') }}<br/>
			{{ Form::text('size',Input::old('size')) }}
		</p>
		<p>
			{{ Form::label('sex : M or F') }}<br/>
			{{ Form::text('sex',Input::old('sex')) }}
		</p>
		<p>
			{{ Form::label('quantity : example 10') }}<br/>
			{{ Form::text('quantity',Input::old('quantity')) }}
		</p>
		<p>
			{{ Form::submit('Add Product') }}
		</p>
		{{ Form::close() }}
	</div>
@endsection