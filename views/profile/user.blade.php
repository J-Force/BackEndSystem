@extends('layout.newDefault')

@section('content')
	@include('layout.newNav')
	<div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="location.href='{{ URL::route('home') }}'">&times;</button>

          <h4 class="modal-title" id="myModalLabel2">Profile</h4>

        </div>

        <form action="{{ URL::route('profile-user-update') }}" , method="post">
	        <div class="modal-body" id="login_details">

	        	  <?php
	        	  	$user = Auth::user();
		          	$result = explode('-' , $user->date_of_birth);
		          ?>

	        	  <span > Email</span>
		          <input type="email" class="form-control" placeholder="example@example.com" name="email" value="{{ $user->email }}" disabled/>
				  </br>

				  <span class="fp-link"> <a href="{{ URL::route('account-change-password') }}">Change Password</a></span></br>
		          </br>

				  <span > First Name</span>
		          <input type="text" class="form-control" name="first_name" value="{{ $user->first_name}}"/>
		          @if($errors->has('first_name'))
						{{ $errors->first('first_name') }}
				  @endif 
		          </br>

		          <span > Last Name</span>
		          <input type="text" class="form-control" name="last_name" value="{{ $user->last_name}}"/> 
		          @if($errors->has('last_name'))
						{{ $errors->first('last_name') }}
				  @endif
		          </br>

		          <span >Gender</span>
		          {{ Form::select('sex' , array('M' => 'Male' , 'F' => 'Female') , Auth::user()->sex , array(
		                  'class' => 'btn btn-default dropdown-toggle'
		                   )) }}
		          </br></br>

		          <span> Identification Number </span> <input type="text" class="form-control" name="identified_number" value="{{ $user->identified_number }}" disabled/> 
		          @if($errors->has('identified_number'))
						{{ $errors->first('identified_number') }}
				  @endif
		          </br></br>

		         

		          <span> Date of Birth </span>
		          {{ Form::selectRange( 'day' , 1 , 31 , $result[2] , array(
		                  'class' => 'btn btn-default dropdown-toggle'
		                   )) }}
		          {{ Form::selectMonth( 'month' , $result[1] , array(
		                  'class' => 'btn btn-default dropdown-toggle'
		                   )) }}
		          {{ Form::selectRange( 'year' , 2015 , 1950 , $result[0] , array(
		                  'class' => 'btn btn-default dropdown-toggle'
		                   )) }}
		          </br></br>

		          <span > Address</span>
		          </br>
		          {{ Form::textarea('address' , $user->address , array (
		          			'rows' => 4,
		          			'cols' => 55
		             )) }}

		          @if($errors->has('address'))
						{{ $errors->first('address') }}
				  @endif
		          </br></br>

		          <span> Phone Number </span> <input type="text" class="form-control" name="phone" value="{{ $user->phone }}"/> 
		          @if($errors->has('phone'))
						{{ $errors->first('phone') }}
				  @endif
		          </br></br>

		          <span > Interest </span>
		          </br>
		          {{ Form::textarea('interest' , $user->interest , array (
		          			'rows' => 4,
		          			'cols' => 55
		             )) }}
		          </br></br>
		          
				  <input type="submit" class="btn btn-success" value="Update Profile">

	        </div>
	        {{ Form::token() }}
	     </form>

      </div>
    </div>
@endsection