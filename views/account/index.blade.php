@extends('layout.newDefault')

@section('content')
	@include('layout.newNav')
	<center>
		<table class="table table-striped users-table" >
		  	<tr>
	  			<th> Email </th>
	  			<th> Name </th>
	  		</tr>
		@foreach($users as $user)
	  		<tr>
	  			<td>{{ $user->email }}</td>
	  			<td>{{ $user->first_name . ' ' . $user->last_name }}</td>
	  		</tr>
	  	@endforeach
		</table>
	</center>	

	<style type="text/css">
		.users-table {
			max-width: 80%;
			margin-top: 10%;
		}
	</style>

@endsection
