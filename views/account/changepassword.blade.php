@extends('layout.default')

@section('content')
	<form action="{{ URL::route('account-change-password-post')}}" method="post">
		<div class="field">
			Current password: <input type="password" name="current_password">
			@if($errors->has('current_password'))
				{{ $errors->first('current_password') }}
			@endif
		</div>

		<div class="field">
			New password: <input type="password" name="password">
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		</div>

		<div class="field">
			New password confirmation: <input type="password" name="password_confirmation">
			@if($errors->has('password_confirmation'))
				{{ $errors->first('password_confirmation') }}
			@endif
		</div>


		<input type="submit" value="Change password">
		{{ Form::token() }}
	</form>
@endsection