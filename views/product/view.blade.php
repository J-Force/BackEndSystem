@extends('layout.default')
@section('content')
<style type="text/css">
	.field {
		padding-left: 20px;
	}
</style>
<div class='field'>
	<h1>{{ $product -> name }}</h1>
	<p>{{ $product -> cost }}</p>
	<p>{{ $product -> price }}</p>
	<p>{{ $product -> description }}</p>
	<p>{{ $product -> weight }}</p>
	<p>{{ $product -> size }}</p>
	<p>{{ $product -> sex }}</p>
	<p>{{ $product -> quantity }}</p>
</div>
@endsection