@extends('layout.newDefault')

@section('content')
	@include('layout.newNav')
	<div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="location.href='{{ URL::route('home') }}'">&times;</button>
          <h4 class="modal-title">Sign In</h4>

        </div>

        <form action="{{ URL::route('account-sign-in-post') }}" , method="post">
        <div class="modal-body" id="login_details">

	       
	          <span> Already have an account? </span> </br></br>

	          *<span style="font-weight:bold;"> Your Email</span><br />
	          <input type="email" class="form-control" placeholder="example@example.com" name="email" {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }} autofocus/>
	          <br />
	          @if($errors->has('email'))
					<p class="imt">{{ $errors->first('email') }}</p>
			  @endif

	          *<span style="font-weight:bold;" > Password</span><br />
	          <input type="password" class="form-control" name="password" /><br />
	          @if($errors->has('password'))
					<p class="imt">{{ $errors->first('password') }}</p>
			  @endif

	          <input type="checkbox" name="remember" id="remember" >
			  <label for="remember">
					Remember me
			  </label>
			  <br/>
			 
        </div>

        <div class="modal-footer" >
   		 <input style="float: left" type="submit" class="btn btn-success" value="Sign In" /> 
         <span class="fp-link"> <a href="{{ URL::route('account-forgot-password') }}">Forgot Password?</a></span>
         </br></br>

      	 <span> Not a member yet?</span>

      	 <span style="cursor:pointer;" class="text-info" onClick="location.href='{{ URL::route('account-create') }}'">Sign Up!</span>

        </div>
        {{ Form::token() }}

	    </form>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  	<style type="text/css">
    	.imt {
    		color: red;
    	}
    </style>
@endsection