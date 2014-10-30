@extends('layout.default')
@section('content')
@include('layout.menu_admin')
	<table class="table table-striped users-table" align="center">
	  	<tr>
  			<th> Product Name </th>
  			<th> Price </th>
  			<th> Gender </th>
  			<th> Quantity </th>
        <th> Edit </th>
        <th> Delete </th>
        <th> Add Image </th>

  		</tr>
	@foreach($products as $product)
  		<tr>
  			<td><a href="{{ URL::route('product',array($product -> id)) }}">{{ $product->name }}</a></td>
  			<td>{{ $product->price  }}</td>
  			<td>{{ $product->sex }}</td>
  			<td>{{ $product->quantity }}</td>
        <td><a href="{{ URL::route('product-edit-view',array($product -> id)) }}">Edit</a></td>
        <td>
          {{ Form::open(array('url' => 'products/delete','method' => 'delete')) }}
          {{ Form::token() }}
          {{ Form::hidden('id',$product->id) }}
          {{ Form::submit('Delete') }}
          {{ Form::close() }}
        </td>
         <td><a href="{{ URL::route('product-add-image',array($product -> id)) }}">Add Image</a></td>
  		</tr>
  	@endforeach
	</table>
	<style type="text/css">
		.users-table {
			width:600px;
			max-width: 600px;
		}
	</style>
@endsection

