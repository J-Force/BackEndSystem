<?php
class AccountController extends BaseController {

	public function index() {
		$users = User::all();
		return View::make('account.index')->with('users', $users );
	}

	public function getSignOut() {
		Auth::logout();
		return Redirect::route('home')->with('success','Sign out');
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

				return Redirect::intended('/')->with('success' , 'Sign in successfully');
			} else {
				return Redirect::route('account-sign-in')
			   					->with('fail' , 'There was a problem signing you in. Wrong password or email ?');
			}
		}
	}

	public function getCreate() { 
		return View::make('account.create');
	} 

	public function postCreate() {
		$validator = Validator::make(Input::all(),
			array(
				'email' 				=> 'required|max:50|email|unique:users,email',
				'password'  			=> 'required|min:8',
				'password_confirmation' => 'required|same:password',
				'first_name'			=> 'required',
				'last_name'				=> 'required',
				'sex'					=> 'required',
				'identified_number'		=> 'required|numeric|unique:users',
				'address'				=> 'required',
				'phone'					=> 'required'
			)
		);

		if($validator->fails()){
			return Redirect::route('account-create')
				   ->withErrors($validator)
				   ->withInput();
		} else {

			$dob = new DateTime(Input::get('year'). '-' .Input::get('month') . '-' . Input::get('day'));

			$user = User::create(array(
				'email' 	=> Input::get('email'),
				'password'	=> Hash::make(Input::get('password')),
				'first_name'=> Input::get('first_name'),
				'last_name'	=> Input::get('last_name'),
				'sex'		=> Input::get('sex'),
				'identified_number' => Input::get('identified_number'),
				'address'	=> Input::get('address'),
				'phone'		=> Input::get('phone'),
				'date_of_birth' => $dob->format('Y-m-d'),
				'active' => 0
			));

			if($user) {


				Auth::login($user);
				$user->active = 1;
				$user->save();
				return Redirect::route('home')
					   ->with('success', 'Your account has been created!');
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
					       ->with('success' , 'Your password has been changed');
				}
			} else {

				return Redirect::route('account-change-password')
						->with('fail' , ' Your current password is incorrect');

			}
			
		}

		return Redirect::route('account-change-password')
				->with('fail','Your password could not be changed');
	}

	public function getForgotPassword() {
		return View::make('account.forgot');
	}

	public function postForgotPassword() {
		$validator = Validator::make(Input::all(),
			array(
				'email' => 'required|email|max:50',
				'identified_number' => 'required|min:13|max:13'
			)
		);

		if($validator->fails()){
			return Redirect::route('account-forgot-password')
					->withErrors($validator)
					->withInput();
		} else {

			$user = User::where('email' , '=' , Input::get('email'))->first();

			if($user->identified_number == Input::get('identified_number') ) {

				//Generate password
				$password 			 = str_random(8);
				$user->password_temp = Hash::make($password);

				if( $user->save() ) {

					$data = array(
						'url' 		=> URL::route('account-sign-in'),
						'email' 	=> $user->email,
						'password' 	=> $password 
					);

					Mail::send( 'emails.auth.forgot' , $data ,function($message) use ($user) {
							$message->to(Input::get('email'))->subject('Your new password');
						}
					);

					$user->password = $user->password_temp;
					$user->password_temp = '';
					$user->save();


					return Redirect::route('home')
							->with('fail' , 'The system send mail to your email about new password');
				}

			}


		}

		return Redirect::route('account-forgot-password')
				->with('success' , 'Could not request new password');
	}

}