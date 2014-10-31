@extends('layout.default')

@section('content') 
@include('layout.menu_admin')
 {{Form::open(array('url'=>'user/upload','class'=>'dropzone', 'method' => 'post'))}}
 {{Form::close()}}
@endsection