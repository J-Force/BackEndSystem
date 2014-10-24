@extends('layout.default')

@section('content')
	<form action="{{ URL::route('account-sign-in-post') }}" , method="post">

		<div class="field">
			Email: <input type="email" name="email" {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }} >
			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif
		</div>

		<div class="field">
			Password: <input type="password" name="password">
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		</div>

		<input type="submit" value="Sign in">
		{{ Form::token() }}
	</form>
@endsection