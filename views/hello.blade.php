@extends('layout.default')

@section('content')

@if(Auth::check())
	
@endif

<div class="btn-group btn-group-justified">
	<div class="btn-group btn-group-justified">
	  <div class="btn-group">
	  	<a href="{{ URL::route('catalog-man') }}">
	    	<button type="button" class="btn btn-default btn-success">Men</button>
	    </a>
	  </div>
	  <div class="btn-group btn-danger">
	  	<a href="{{ URL::route('catalog-women') }}">
	    	<button type="button" class="btn btn-default btn-primary">Women</button>
	    </a>
	  </div>
	</div>
</div>
@endsection