<?php

class NewsController extends BaseController {
	public $restful = true;

	public function getAll(){
		$news = News::all();
		return View::make('news.news')->with('news', $news);
	}

	public function get($start, $limit) {
		$news = News::where('id', '>=', $start)->take($limit)->get();
		return View::make('news.news')->with('news', $news);
	}

	public function add() {
		$validator = Validator::make(Input::all(),
			array(
				'title' 				=> 'required',
				'description'  			=> 'required',
			)
		);
		if($validator->fails()) {
			return Redirect::route('news')
				   ->withErrors($validator)
				   ->withInput();
		}
		$news = News::create(array(
			'title' 	=> Input::get('title'),
			'description'	=> Input::get('description'),
		));
		if($news) {
			$news->save();
			return Redirect::route('news')
					->with('success', 'News has been added!');
		}
	}

	public function delete($id) {
		if(News::find($id)) {
			News::destroy($id);
			return View::make('news.news')->with('success', 'Deleted news id:'+$id+'.');
		}
		View::make('news.news')->with('fail', 'Can not find news id:'+$id+'.');
	}
}