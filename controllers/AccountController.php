<?php
class AccountController extends BaseController {

	public function getSignOut() {
		Auth::logout();
		return Redirect::route('home');
	}

	public function getSignIn() {
		return View::make('account.signin');
	}

	public function postSignIn() {
		$validator = Validator::make(Input::all(),
			array(
				'email' 	=> 'required|email|exists:users,email',
				'password'  => 'required|min:8'
			)
		);

		if($validator->fails()){
			return Redirect::route('account-sign-in')
				   ->withErrors($validator)
				   ->withInput(Input::except('password'));
		} else {

			$credentials = array(
				'email'		=> Input::get('email'),
				'password'	=> Input::get('password')
			);

			$remember = (Input::has('remember')) ? true : false;

			$auth = Auth::attempt($credentials , $remember);

			if($auth) {
				//Redirect to the intended page

				$user = User::where('email' , '=' , Input::get('email'))->first();
				$user->active = 1;
				$user->save();

				Session::put('user' , Auth::user() );

				return Redirect::intended('/');
			} else {
				return Redirect::route('account-sign-in')
			   					->with('global' , 'There was a problem signing you in. Wrong password or email ?');
			}
		}
	}

	public function getCreate() { 
		return View::make('account.create');
	} 

	public function postCreate() {
		$validator = Validator::make(Input::all(),
			array(
				'email' 				=> 'required|max:50|email|unique:users',
				'password'  			=> 'required|min:8',
				'password_confirmation' => 'required|same:password'
			)
		);

		if($validator->fails()){
			return Redirect::route('account-create')
				   ->withErrors($validator)
				   ->withInput();
		} else {

			$user = User::create(array(
				'email' 	=> Input::get('email'),
				'password'	=> Hash::make(Input::get('password')),
				'active' => 0
			));

			if($user) {
				return Redirect::route('home')
					   ->with('global', 'Your account has been created!');
			}
		}
	}

	public function getProfile(){
		return View::make('account.profile');
	}

	public function getChangePassword() {
		return View::make('account.changepassword');
	}

	public function postChangePassword() {
		$validator = Validator::make(Input::all(),
			array(
				'current_password'		=> 'required|min:8',
				'password'  			=> 'required|min:8',
				'password_confirmation' => 'required|same:password'
			)
		);

		if($validator->fails()){
			return Redirect::route('account-change-password')
				   ->withErrors($validator);
		} else {

			$user = User::find(Auth::user()->id);

			$current_password = Input::get('current_password');
			$password = Input::get('password');

			if(Hash::check( $current_password , $user->getAuthPassword() )) {
				$user->password = Hash::make($password);

				if($user->save()) {
					return Redirect::route('home')
					       ->with('global' , 'Your password has been changed');
				}
			} else {

				return Redirect::route('account-change-password')
						->with('global' , ' Your current password is incorrect');

			}
			
		}

		return Redirect::route('account-change-password')
				->with('global','Your password could not be changed');
	}

	public function getForgotPassword() {
		return View::make('account.forgot');
	}

	public function postForgotPassword() {
		$validator = Validator::make(Input::all(),
			array(
				'email' => 'required|email|max:50'
			)
		);

		if($validator->fails()){
			return Redirect::route('account-forgot-password')
					->withErrors($validator)
					->withInput();
		} else {

			$user = User::where('email' , '=' , Input::get('email'));

			if($user->count()) {
				$user = $user->first();

				//Generate password
				$password 			 = str_random(8);
				$user->password_temp = Hash::make($password);

				if( $user->save() ) {

					$data = array(
						'url' 		=> URL::route('home'),
						'email' 	=> $user->email,
						'password' 	=> $password 
					);

					Mail::send( 'emails.auth.forgot' , $data ,function($message) use ($user) {
							$message->to($user->email)->subject('Your new password');
						}
					);

					$user->password = $user->password_temp;
					$user->password_temp = '';
					$user->save();


					return Redirect::route('home')
							->with('global' , 'The system send mail to your email about new password');
				}

			}


		}

		return Redirect::route('account-forgot-password')
				->with('global' , 'Could not request new password');
	}

}