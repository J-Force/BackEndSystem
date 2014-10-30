@extends('layout.default')

@section('content') 
@include('layout.menu_admin')
 {{Form::open(array('url'=>'upload','action'=>'ImageController@uploadImage','class'=>'dropzone'))}}
 {{Form::close()}}
@endsection