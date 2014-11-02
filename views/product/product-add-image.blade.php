@extends('layout.newDefault')

@section('content') 
<!-- Page Content ================================================== -->
@include('layout.newNav') 
@include('layout.menu_admin')

<style type="text/css">
	.thumbnail_img {
	    position: relative;
	    height: 300px;
	    overflow: hidden;
	}
</style>
	<div style="margin-left:30px;">
		<br/>
		<h1>Show All Images</h1>
		<br/>
		<div class="container">
	     	@include('images.list-images')
		</div>
	</div>
@endsection