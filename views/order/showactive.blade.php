@extends('layout.newDefault')
@section('content')
@include('layout.newNav')
@include('layout.menu_admin')
	</br></br>
	<table class="table table-striped" style="margin-left:7%;width:90%" align="center">  
	  	<tr>
	        <th><center> OrderID</center></th>
	  		<th><center> UserID </center></th>
	  		<th><center> FirstName </center></th>
	        <th><center> LastName </center></th>  
	        <th><center> ProductName </center></th>
	        <th><center> Quantity </center></th> 
  		</tr>
  		
		@foreach($actives as $active )
		<tr>
	        	<td><center>{{ $active->id  }}</center></td>	   
		  		<td><center>{{ $active->user->id }}</center></td>
		  		<td><center>{{ $active->user->first_name }}</center></td>
		  		<td><center>{{ $active->user->last_name }}</center></td>
		  		<td><center><a href="{{ URL::route('product-id',array($active->product->id)) }}">{{ $active->product->name }}</a></center></td>
		  		<td><center>{{ $active->order->quantity }}</center></td>
		</tr>
	  	@endforeach
	  	
  	</table>
@endsection