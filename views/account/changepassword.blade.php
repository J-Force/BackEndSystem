@extends('layout.default')

@section('content')
	<div class="modal-dialog" style="margin-top: 100px;">

	      <div class="modal-content">

	        <div class="modal-header">

	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="location.href='{{ URL::route('home') }}'">&times;</button>

	          <h4 class="modal-title" id="myModalLabel2">Forgot Password?</h4>

	        </div>

			<form action="{{ URL::route('account-change-password-post')}}" method="post">
				<div class="modal-body" id="changepassword_details">
				<div class="field">
					Current password: 
					<input type="password" class="form-control" name="current_password">
					@if($errors->has('current_password'))
						{{ $errors->first('current_password') }}
					@endif
				</div>

				<div class="field">
					New password: 
					<input type="password" class="form-control" name="password">
					@if($errors->has('password'))
						{{ $errors->first('password') }}
					@endif
				</div>

				<div class="field">
					New password confirmation: 
					<input type="password" class="form-control" name="password_confirmation">
					@if($errors->has('password_confirmation'))
						{{ $errors->first('password_confirmation') }}
					@endif
				</div>

				</br>
				<input type="submit" class="btn btn-success" value="Change password">
				{{ Form::token() }}
			</form>
		  </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
@endsection