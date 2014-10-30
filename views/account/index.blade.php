@extends('layout.default')

@section('content')
	
	<table class="table table-striped users-table" align="center">
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
	<style type="text/css">
		.users-table {
			width:600px;
			max-width: 600px;
			margin-top: 10%;
		}
	</style>

@endsection
