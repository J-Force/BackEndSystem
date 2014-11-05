@extends('layout.newDefault')

@section('content') 
<!-- Page Content ================================================== -->
@include('layout.newNav') 
@include('layout.menu_admin')

	<div style="margin-left:100px;">
		<br/>
		<h1>Show All Images</h1>
		<div class="container">
			
	     	@include('images.list-images')
		    
		</div>
	</div>
@endsection