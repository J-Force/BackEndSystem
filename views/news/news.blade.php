@extends('layout.newDefault')
@section('content')

@include('layout.newNav')

	<table class="table table-striped news-table" align="center">
	  	<tr>
  			<th> Title </th>
  			<th> Description </th>
  		</tr>
	@foreach($news as $each_news)
  		<tr>
  			<td>{{ $each_news->title }}</td>
  			<td>{{ $each_news->description  }}</td> 
  		</tr>
  	@endforeach
	</table>
	<style type="text/css">
		.news-table {
			width:600px;
			max-width: 600px;
			margin-top: 10%;
		}
	</style>
@endsection