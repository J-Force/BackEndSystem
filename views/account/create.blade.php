@extends('layout.default')
@section('content')
	<div class="modal-dialog" style="margin-top: 100px;">

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="location.href='{{ URL::route('home') }}'">&times;</button>

          <h4 class="modal-title" id="myModalLabel2">Sign Up</h4>

        </div>

        <form action="{{ URL::route('account-create-post') }}" , method="post" >
	        <div class="modal-body" id="signup_details">

	          *<span > Email</span>
	          <input type="email" class="form-control" placeholder="example@example.com" name="email" {{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }} autofocus/>
	          @if($errors->has('email'))
					{{ $errors->first('email') }}
			  @endif
	          </br>

	          *<span > Password</span>
	          <input type="password" class="form-control" name="password">
	          @if($errors->has('password'))
					{{ $errors->first('password') }}
			  @endif
	          </br>

	          *<span > Password Confirmation</span>
	          <input type="password" class="form-control" name="password_confirmation">
	          @if($errors->has('password_confirmation'))
					{{ $errors->first('password_confirmation') }}
			  @endif

			  </br>
			  *<span > First Name</span>
	          <input type="text" class="form-control" name="first_name"/>
	          @if($errors->has('first_name'))
					{{ $errors->first('first_name') }}
			  @endif 
	          </br>

	          *<span > Last Name</span>
	          <input type="text" class="form-control" name="last_name"/> 
	          @if($errors->has('last_name'))
					{{ $errors->first('last_name') }}
			  @endif
	          </br>

	          *<span >Gender</span>
	          {{ Form::select('sex' , array('M' => 'Male' , 'F' => 'Female') , 'M' , array(
	                  'class' => 'btn btn-default dropdown-toggle'
	                   )) }}
	          </br></br>

	          **<span> Identification Number </span> <input type="text" name="identified_number"/> 
	          @if($errors->has('identified_number'))
					{{ $errors->first('identified_number') }}
			  @endif
	          </br></br>

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

	          *<span > Address</span>
	          </br>
	          {{ Form::textarea('address' , null , array (
	          			'rows' => 4,
	          			'cols' => 90
	             )) }}

	          @if($errors->has('address'))
					{{ $errors->first('address') }}
			  @endif
	          </br></br>

	          *<span> Phone Number </span> <input type="text" name="phone"/> 
	          @if($errors->has('phone'))
					{{ $errors->first('phone') }}
			  @endif
	          </br></br>

	          <span > Interest </span>
	          </br>
	          {{ Form::textarea('interest' , null , array (
	          			'rows' => 4,
	          			'cols' => 90
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
@endsection
