@extends('layout.newDefault')

@section('content') 
<!-- Page Content ================================================== -->
@include('layout.newNav') 
@include('layout.menu_admin')
<div style="margin-left:100px">
 {{Form::open(array('url'=>'user/upload','class'=>'dropzone', 'method' => 'post'))}}
 {{Form::close()}}
 <a href="{{ URL::route('products') }}" class="btn btn-primary">Add images to product</a>
</div>
@endsection