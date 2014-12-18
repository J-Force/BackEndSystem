@extends('layout.newDefault')

@section('content') 

@include('layout.newNav')

@include('layout.menu_admin')]
<?php
	$product = Product::all();
?>	
 <div style="margin-left:200px;padding:50px">
	<h1> Edit Hot Items </h1>
	{{ Form::open( array('route' => 'update.hot.product' , 'method' => 'put') )}}
	Item 1 : <select name="product1">
			<!-- <option value='-1'>None</option> -->
		@foreach($product as $p)
			<option value={{$p->id}}>{{$p->name}}</option>
		@endforeach
			</select><br><br>
	Item 2 : <select name="product2">
			<!-- <option value='-1'>None</option> -->
		@foreach($product as $p)
			<option value={{$p->id}}>{{$p->name}}</option>
		@endforeach
			</select><br><br>
	Item 3 : <select name="product3">
			<!-- <option value='-1'>None</option> -->
		@foreach($product as $p)
			<option value={{$p->id}}>{{$p->name}}</option>
		@endforeach
			</select><br><br>
	Item 4 : <select name="product4">
			<!-- <option value='-1'>None</option> -->
		@foreach($product as $p)
			<option value={{$p->id}}>{{$p->name}}</option>
		@endforeach
			</select><br><br>
	Item 5 : <select name="product5">
			<!-- <option value='-1'>None</option> -->
		@foreach($product as $p)
			<option value={{$p->id}}>{{$p->name}}</option>
		@endforeach
			</select><br><br>
	Item 6 : <select name="product6">
			<!-- <option value='-1'>None</option> -->
		@foreach($product as $p)
			<option value={{$p->id}}>{{$p->name}}</option>
		@endforeach
			</select><br><br>
	Item 7 : <select name="product7">
			<!-- <option value='-1'>None</option> -->
		@foreach($product as $p)
			<option value={{$p->id}}>{{$p->name}}</option>
		@endforeach
			</select><br><br>
	Item 8 : <select name="product8">
			<!-- <option value='-1'>None</option> -->
		@foreach($product as $p)
			<option value={{$p->id}}>{{$p->name}}</option>
		@endforeach
			</select><br><br>
	{{ Form::submit('Submit',array('class' => 'btn btn-success' , 'style' => 'float:left;'))}}
	{{ Form::token() }}
	{{ Form::close() }}
</div>
@endsection