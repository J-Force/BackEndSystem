<?php
class ReviewController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth');
	}

	public function commitComment() {
		$user = Auth::user();
		

		$comment_id = DB::table('comment')->insertGetId(array(
							'text' => Input::get('comment')
					  ));

		$date = new DateTime();
		
		$review_id = DB::table('review')->insertGetId(array(
							'user_id' => $user->id,
							'product_id' => Input::get('product_id'),
							'comment_id' => $comment_id,
							'created_at' => $date,
							'updated_at' => $date
					));

		$out = [];
		array_push($out,$comment_id,$review_id);
		return $out;
	}

	public function deleteComment() {

		$review = Review::find(Input::get('review_id'));

		$comment = Comment::find($review->comment_id);

		$review->delete();
		$comment->delete();
		
	}

	public function editComment() {

		$review = Review::find(Input::get('review_id'));
		$text = Input::get('text');	

		DB::table('comment')->where('id', $review->comment_id)
		    			    ->update(array('text' => $text));
	}
	
}