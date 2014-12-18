@extends('layout.newDefault')

@section('content') 
<!-- Page Content ================================================== -->
@include('layout.newNav') 
@include('layout.menu_admin')
<script type="text/javascript">
  $(document).on('submit', '.delete-form', function(){
      return confirm('Are you sure?');
  });
</script>
	<div style="margin-left:100px">
		<br/>
		<h1>Add Category</h1>
		@if($errors->has())
		<ul class="errors">
			{{ $errors->first('name','<li>:message</li>') }}	
		</ul>
		@endif
		{{ Form::open(array('url' => '/admin/category/create')) }}
		{{ Form::token() }}
		<p>
			{{ Form::label('name') }}<br/>
			{{ Form::text('name',Input::old('name')) }}
		</p>
		<p>
			{{ Form::submit('Add Category',array('class'=>'btn btn-success')) }}
		</p>
		{{ Form::close() }}
		<table>
			@foreach($categories as $category)
				<tr>
				<td class="td-right">
				ID : {{ $category->id }} -> Name : {{ $category->name }} 
				</td>
				@if($category->name != "Other")
				<td class="td-right">
				<a href="/jf-shop/admin/category/delete/{{$category->id}}" 
					class="btn btn-danger" 
					data-method="delete" 
					data-confirm="Are you sure?">Remove</a>
				</td>
				@endif
				</tr>
			@endforeach
		</table>
		<br>
	</div>
	<style>
		.errors li {
			color:red;
		}
		.td-right  {
			padding-bottom: 10px;
			padding-right: 10px;
		}
	</style>
@include('scripts.confirmRemove')
@endsection