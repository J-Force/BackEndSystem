<?php

class NewsController extends BaseController {
	public $restful = true;

	public function showNews(){
		//TODO make DB news
		return View::make('news.news');
	}
}