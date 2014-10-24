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
}