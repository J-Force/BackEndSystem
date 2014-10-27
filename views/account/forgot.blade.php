@extends('layout.default')

@section('content')
	<div class="modal-dialog" style="margin-top: 100px;">

	      <div class="modal-content">

	        <div class="modal-header">

	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="location.href='{{ URL::route('home') }}'">&times;</button>

	          <h4 class="modal-title" id="myModalLabel2">Forgot Password?</h4>

	        </div>

			<form action="{{ URL::route('account-forgot-password-post')}}" method="post">
				<div class="modal-body" id="forgot_details">
					<div class="field">
						Email : 
						<input type="email" class="form-control" placeholder="example@example.com" name="email" {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }} autofocus >
						@if($errors->has('email'))
							{{ $errors->first('email') }}
						@endif
					</div>
					</br>
					<div class="field">
						Identification Number: 
						<input type="text" class="form-control"  name="identified_number" >
						@if($errors->has('identified_number'))
							{{ $errors->first('identified_number') }}
						@endif
					</div>

					<br/>
					<input type="submit"  class="btn btn-success" value="Recover">
				</div>
			{{ Form::token() }}
			</form>

			</div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

@endsection