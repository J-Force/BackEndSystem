@extends('layout.newDefault')

@section('content') 

@include('layout.newNav')

@include('layout.menu_admin')]
<style type="text/css">
.center {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	margin: auto;
}

.menu-left p{
	width: 100%;
	margin: 0px;
	padding: 10px;
}

.element-menu {
	text-align: center;
	border: solid 1px gray;
	padding: 20px;
	border-radius: 5px;
	margin: 10px 0px 10px 0px; 
	font-size: 30px;
}
</style>
<div style="margin-left:100px">
	<div class="container">
		<div class="row">
			<h1><span class="label label-default">Backoffice</span></h1>
		</div>
		<div class="row">
			<center>
				<div class="col-md-4 element-menu"><a href="{{ URL::route('products') }}">Show Products</a></div>
				<div class="col-md-4 element-menu"><a href="{{ URL::route('product-add-view') }}">Add Product</a></div>
				<div class="col-md-4 element-menu"><a href="{{ URL::route('upload') }}">Upload Image</a></div>
				<div class="col-md-4 element-menu"><a href="{{ URL::route('image-all') }}">Show Images</a></div>
				<div class="col-md-4 element-menu"><a href="{{ URL::route('category-add-view') }}">Add Category</a></div>
				<div class="col-md-4 element-menu"><a href="{{ URL::route('get.hot.product') }}">Edit Hot Items</a></div>
				<div class="col-md-4 element-menu"><a href="{{ URL::route('order-active')}}">Show Active Orders</a></div>
				<div class="col-md-4 element-menu"><a href="{{ URL::route('bill-history')}}">Orders History</a></div>
				<div class="col-md-4 element-menu"><a href="{{ URL::route('promotion')}}">Add Promotion</a></div>
				<div class="col-md-4 element-menu"><a href="{{ URL::route('report')}}">Report</a></div>
			</center>
			</div>
		</div>
	</div>
</div>


@endsection