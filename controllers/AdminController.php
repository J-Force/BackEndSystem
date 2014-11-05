<?php

class AdminController extends BaseController {

	public function index(){

		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				return View::make('admin.index');
				}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

}