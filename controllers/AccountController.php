<?php
class AccountController extends BaseController {


	public function getSignIn() {
		return View::make('account.signin');
	}

	public function postSignIn() {
		$validator = Validator::make(Input::all(),
			array(
				'email' 	=> 'required|email',
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
				'password'	=> Input::get('password'),
				'active'	=> 1
			);

			dd(Auth::attempt($credentials));

			// $auth = Auth:

			// if($auth) {
			// 	//Redirect to the intended page
			// 	return Redirect::intended('/');
			// } else {
			// 	return Redirect::route('account-sign-in')
			//    					->with('global' , 'There was a problem signing you in. Wrong password or email ?');
			// }
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
}