@extends('layout.default')

@section('content') 
@include('layout.menu_admin')
	<div style="margin-left:50px">
		<br/>
		<h1>Add New Products</h1>
		@if($errors->has())
		<ul>
			{{ $errors->first('name','<li>:message</li>') }}
			{{ $errors->first('description','<li>:message</li>') }}
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
			{{ Form::submit('Add Product') }}
		</p>
		{{ Form::close() }}
	</div>
@endsection