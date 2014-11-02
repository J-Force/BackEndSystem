@extends('layout.newDefault')
@section('content')
	@include('layout.newNav')
	<div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="location.href='{{ URL::route('home') }}'">&times;</button>

          <h4 class="modal-title" id="myModalLabel2">Sign Up</h4>

        </div>

        <form action="{{ URL::route('account-create-post') }}" , method="post" >
	        <div class="modal-body" id="signup_details">

	          <span class="imt">*</span><span > Email</span>
	          <input type="email" class="form-control" placeholder="example@example.com" name="email" {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }} autofocus/>
	          @if($errors->has('email'))
					<p class="imt">{{ $errors->first('email') }}</p>
			  @endif
	          </br>

	          <span class="imt">*</span><span > Password</span>
	          <input type="password" class="form-control" name="password">
	          @if($errors->has('password'))
					<p class="imt">{{ $errors->first('password') }}</p>
			  @endif
	          </br>

	          <span class="imt">*</span><span > Password Confirmation</span>
	          <input type="password" class="form-control" name="password_confirmation">
	          @if($errors->has('password_confirmation'))
					<p class="imt">{{ $errors->first('password_confirmation') }}</p>
			  @endif

			  </br>
			  <span class="imt">*</span><span > First Name</span>
	          <input type="text" class="form-control" name="first_name"/>
	          @if($errors->has('first_name'))
					<p class="imt">{{ $errors->first('first_name') }}</p>
			  @endif 
	          </br>

	          <span class="imt">*</span><span > Last Name</span>
	          <input type="text" class="form-control" name="last_name"/> 
	          @if($errors->has('last_name'))
					<p class="imt">{{ $errors->first('last_name') }}</p>
			  @endif
	          </br>

	          <span >Gender</span>
	          {{ Form::select('sex' , array('M' => 'Male' , 'F' => 'Female') , 'M' , array(
	                  'class' => 'btn btn-default dropdown-toggle'
	                   )) }}
	          </br></br>

	          <span class="imt">**</span><span> Identification Number </span> <input type="text" class="form-control" name="identified_number"/> 
	          @if($errors->has('identified_number'))
					<p class="imt">{{ $errors->first('identified_number') }}</p>
			  @endif
	          </br>

	          <span> Date of Birth </span>
	          {{ Form::selectRange( 'day' , 1 , 31 , 1 , array(
	                  'class' => 'btn btn-default dropdown-toggle'
	                   )) }}
	          {{ Form::selectMonth( 'month' , null , array(
	                  'class' => 'btn btn-default dropdown-toggle'
	                   )) }}
	          {{ Form::selectRange( 'year' , 2015 , 1950 , 2015 , array(
	                  'class' => 'btn btn-default dropdown-toggle'
	                   )) }}
	          </br></br>

	          <span class="imt">*</span><span > Address</span>
	          </br>
	          {{ Form::textarea('address' , null , array (
	          			'rows' => 4,
	          			'cols' => 55
	             )) }}

	          @if($errors->has('address'))
					<p class="imt">{{ $errors->first('address') }}</p>
			  @endif
	          </br>

	          <span class="imt">*</span><span> Phone Number </span> <input type="text" class="form-control" name="phone"/> 
	          @if($errors->has('phone'))
					<p class="imt">{{ $errors->first('phone') }}</p>
			  @endif

	          <span > Interest </span>
	          </br>
	          {{ Form::textarea('interest' , null , array (
	          			'rows' => 4,
	          			'cols' => 55
	             )) }}
	          </br></br>


	        </div>

	        <div class="modal-footer" >
	    		<input style="float: left" type="submit" class="btn btn-success"  value="Register" /> 
	         	<span>&nbsp;&nbsp;&nbsp; Already a member? </span>
	         	<span id="login-link" class="text-info" style="cursor:pointer;" onClick="location.href='{{ URL::route('account-sign-in') }}'">  Sign In  </span> 
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
