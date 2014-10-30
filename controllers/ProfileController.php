<?php
class ProfileController extends BaseController {

	public function user() {

		$user = User::find(Auth::user()->id);

		if($user) {
			return View::make('profile.user')
					->with('user', $user );
		}

		return App::abort(404);
	}

	public function postUpdate() {

		$user = User::find(Auth::user()->id);

		$dob = new DateTime(Input::get('year'). '-' .Input::get('month') . '-' . Input::get('day'));

		$validator = Validator::make(Input::all(),
			array(
				'first_name'	=> 'required',
				'last_name'		=> 'required',
				'address'		=> 'required',
				'phone'			=> 'required|numeric'
			)
		);

		if($validator->fails()){
			return Redirect::route('profile-user')
				   ->withErrors($validator)
				   ->withInput();
		} else {

			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');
			$user->address  = Input::get('address');
			$user->phone  = Input::get('phone');
			$user->date_of_birth = $dob->format('Y-m-d');
			$user->sex = Input::get('sex');
			$user->interest = Input::get('interest');
			$user->save();

			return Redirect::intended('/')->with('success', 'Your profile is updated');

		}

	}
}