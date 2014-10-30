<?php

class ImageController extends BaseController {

	public function index()
	{
		$images = Images::paginate(12);
        if (Request::ajax()) {
            return Response::json(View::make('images.list-images', array('images' => $images))->render());
        }
		return View::make('images.images')->with('images',$images);
	}

	public function indexUpload()
	{
		return View::make('images.upload');
	}

	public function uploadImage(){
		$file = Input::file('file');
		// $filename = str_random(12);
		//$filename = $file->getClientOriginalName();
		$path = public_path().'/images/upload/';
		$extension =$file->getClientOriginalExtension();
		$filename = str_random(12).'.'.$extension;
		$upload_success = $file->move($path,$filename);
		// $path = $file->getRealPath();
		$path = '/images/upload/'.$filename;
		if( $upload_success ) {
			Images::create(array(
				'link'=>$path
			));
		   return Response::json('success', 200);
		} else {
		   return Response::json('error', 400);
		}
	}
}