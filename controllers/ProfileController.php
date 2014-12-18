<?php
class ProfileController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth');
	}

	public function historyBill(){
		$order = DB::table('order_history')
		->where('user_id',Auth::user()->id)->get();

		$arr = [];
		foreach($order as $o) {
			$ch = curl_init(($o->payment_url_callback).'/status');                                                                      
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                                                                             
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
			$result = json_decode(html_entity_decode(curl_exec($ch)),true);
			$o->status = $result['status'];

		}

		return View::make('profile.history')
				->with('orders',$order);
	}
	
	public function user() {

		$user = User::find(Auth::user()->id);

		if($user) {
			return View::make('profile.user')
					->with('user', $user );
		}

		return App::abort(404);
	}

	public function getUserAjax() {
		return User::find(Auth::user()->id);
	}

	public function postUpdate() {

		$user = User::find(Auth::user()->id);

		$dob = new DateTime(Input::get('year'). '-' .Input::get('month') . '-' . Input::get('day'));

		$validator = Validator::make(Input::all(),
			array(
				'first_name'	=> 'required',
				'last_name'		=> 'required',
				'address'		=> 'required',
				'phone'			=> 'required'
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