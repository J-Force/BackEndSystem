@extends('layout.newDefault')
@section('content')
@include('layout.newNav')
@include('layout.menu_admin')
<script type="text/javascript">
  $(document).on('submit', '.delete-form', function(){
      return confirm('Are you sure?');
  });
</script>
<br>
<a href="{{ URL::route('product-add-view') }}" class="btn btn-success" style="margin-left:100px">Add New Product</a>
<br><br>
	<table class="table table-striped" style="margin-left:7%;width:90%" align="center">  
	  	<tr>
        <th><center> Product ID </center></th>
  			<th> Product Name </th>
  			<th><center> Price </center></th>
  			<th><center> Gender </center></th>
  			<th><center> Quantity </center></th>
        <th><center> Edit </center></th>   
        <th><center> Add Image </center></th>
        <th><center> Remove Image </center></th>
        <th><center> Delete Product </center></th>

  		</tr>
	@foreach($products as $product)
  		<tr>
        <td><center>{{ $product->id  }}</center></td>
  			<td><a href="{{ URL::route('product-id',array($product -> id)) }}">{{ $product->name }}</a></td>
  			<td><center>{{ $product->price  }}</center></td>
  			<td><center>{{ $product->sex }}</center></td>
  			<td><center>{{ $product->quantity }}</center></td>
        <td><center><a href="{{ URL::route('product-edit-view',array($product -> id)) }}" class="btn btn-primary">Edit</a></center></td>
        
         <td><center><a href="{{ URL::route('product-add-image',array($product -> id)) }}" class="btn btn-primary">Add Image</a></center></td>
         <td><center><a href="{{ URL::route('product-remove-image',array($product -> id)) }}" class="btn btn-danger">Remove Image</a></center></td>
         <td><center>
          <a href="/admin/products/delete/{{$product->id}}" class="btn btn-danger" data-method="delete" data-confirm="Are you sure?">Remove</a>
          <!-- {{ Form::open(array('url' => 'products/delete','method' => 'delete')) }}
          {{ Form::token() }}
          {{ Form::hidden('id',$product->id) }}
          {{ Form::submit('Delete') }}
          {{ Form::close() }} -->
        </center></td>
  		</tr>
  	@endforeach
	</table>
	<style type="text/css">
		.users-table {
			width:600px;
			max-width: 600px;
		}
	</style>
@include('scripts.confirmRemove')
@endsection

