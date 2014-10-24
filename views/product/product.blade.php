@extends('layout.default')
@section('content')

<style type="text/css">
	.list {
		color: #0f29ff;
		font-size: 30px;
	}
	.field {
		padding-left: 20px;
	}
</style>
<div class='box field'>
	<h1>Product list</h1>
	<ul>
	@foreach($products as $product)
		<li class='list'>{{ link_to_route('product',$product -> name,array($product -> id)) }}</li>
	@endforeach
	</ul>
</div>
@endsection

