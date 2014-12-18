<?php

class ReportController extends BaseController {

	public function showReport(){
		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$done = DB::table('done_orders')
					->select(DB::raw('category.name, SUM(done_orders.total_price) as total'))
					->join('orders', 'done_orders.order_id', '=', 'orders.id')
				    ->join('products', 'orders.product_id', '=', 'products.id')
				    ->join('category', 'products.category_id', '=', 'category.id')
					->groupBy('category.id')
					->get();
				$result = DB::table('done_orders')
						->select(DB::raw('HOUR(created_at) as time,SUM(done_orders.total_price) as total'))
						->where(DB::raw('DAY(created_at)'),'=',date('j'))
						->where(DB::raw('MONTH(created_at)'),'=',date('n'))
						->where(DB::raw('YEAR(created_at)'),'=',date('Y'))
						->groupBy(DB::raw('HOUR(created_at)'))
						->get();
				$result1 = DB::table('done_orders')
						->select(DB::raw('DAY(created_at) as time,SUM(done_orders.total_price) as total'))
						->where(DB::raw('MONTH(created_at)'),'=',date('n'))
						->where(DB::raw('YEAR(created_at)'),'=',date('Y'))
						->groupBy(DB::raw('DAY(created_at)'))
						->get();
				$result2 = DB::table('done_orders')
						->select(DB::raw('MONTH(created_at) as time,SUM(done_orders.total_price) as total'))
						->where(DB::raw('YEAR(created_at)'),'=',date('Y'))
						->groupBy(DB::raw('MONTH(created_at)'))
						->get();
				return View::make('report.report')
						->with('day',date('j'))
						->with('month',date('n'))
						->with('year',date('Y'))
						->with('result',$result)
						->with('result1',$result1)
						->with('result2',$result2)
						->with('done',$done);
				}
		}

		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

	public function updateReport(){
		if(Auth::check()) {
			if( Entrust::hasRole('Admin') ) {
				$done = DB::table('done_orders')
					->select(DB::raw('category.name, SUM(done_orders.total_price) as total'))
					->join('orders', 'done_orders.order_id', '=', 'orders.id')
				    ->join('products', 'orders.product_id', '=', 'products.id')
				    ->join('category', 'products.category_id', '=', 'category.id')
					->groupBy('category.id')
					->get();
				$dob = new DateTime(Input::get('year'). '-' .Input::get('month') . '-' . Input::get('day'));
				$result = DB::table('done_orders')
						->select(DB::raw('HOUR(created_at) as time,SUM(done_orders.total_price) as total'))
						->where(DB::raw('DAY(created_at)'),'=',Input::get('day'))
						->where(DB::raw('MONTH(created_at)'),'=',Input::get('month'))
						->where(DB::raw('YEAR(created_at)'),'=',Input::get('year'))
						->groupBy(DB::raw('HOUR(created_at)'))
						->get();
				$result1 = DB::table('done_orders')
						->select(DB::raw('DAY(created_at) as time,SUM(done_orders.total_price) as total'))
						->where(DB::raw('MONTH(created_at)'),'=',Input::get('month'))
						->where(DB::raw('YEAR(created_at)'),'=',Input::get('year'))
						->groupBy(DB::raw('DAY(created_at)'))
						->get();
				$result2 = DB::table('done_orders')
						->select(DB::raw('MONTH(created_at) as time,SUM(done_orders.total_price) as total'))
						->where(DB::raw('YEAR(created_at)'),'=',Input::get('year'))
						->groupBy(DB::raw('MONTH(created_at)'))
						->get();
				return View::make('report.report')
						->with('day',Input::get('day'))
						->with('month',Input::get('month'))
						->with('year',Input::get('year'))
						->with('result',$result)
						->with('result1',$result1)
						->with('result2',$result2)
						->with('done',$done);
				}
		}
		return Redirect::route('home')->with('fail' , 'Permission Denied');
	}

}