@extends('layout.newDefault')
@section('content')
@include('layout.newNav')

@if(Entrust::hasRole('Admin'))
	@include('layout.menu_admin')
@endif
<div style="margin-left:100px">
	<br/>
	<h1>{{ $product -> name }}</h1>
	<p>{{ $product -> cost }}</p>
	<p>{{ $product -> price }}</p>
	<p>{{ $product -> description }}</p>
	<p>{{ $product -> weight }}</p>
	<p>{{ $product -> size }}</p>
	<p>{{ $product -> sex }}</p>
	<p>{{ $product -> quantity }}</p>

@if(Entrust::hasRole('Admin'))
	<a href="{{ URL::route('product-edit-view',array($product -> id)) }}">Edit Product</a>
	{{ Form::open(array('url' => 'products/delete','method' => 'delete')) }}
	{{ Form::token() }}
	{{ Form::hidden('id',$product->id) }}
	{{ Form::submit('Delete') }}
	{{ Form::close() }}
	<br>
@endif
@endsection