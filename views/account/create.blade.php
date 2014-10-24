@extends('layout.default')
@section('content')

	<form action="{{ URL::route('account-create-post') }}" , method="post" >

		<div class="field">
			Email: <input type="email" name="email" {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }} >
			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif
		</div>

		<div class="field">
			Password: <input type="text" name="password">
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		</div>

		<div class="field">
			Password Confirmation: <input type="password" name="password_confirmation">
			@if($errors->has('password_confirmation'))
				{{ $errors->first('password_confirmation') }}
			@endif
		</div>

		<input type="submit" value="Register">
		{{ Form::token() }}
	</form>
@endsection
