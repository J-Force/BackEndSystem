@extends('layout.newDefault')
@section('content')

	@include('layout.newNav')

	<section id="promotion" class="color-dark bg-gray">
			<div class="container margintop-50 marginbot-50">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="animatedParent">
							<div class="section-heading text-center animated bounceInDown">
								<h2 class="h-bold">Promotion</h2>
								<div class="divider-header"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center">
				<div class="container">
					<div class="row" style="margin-bottom: 30px">
						<?php
							$id = DB::table('promotion_image')->where('promotion_id', '=' ,$promotion->id )->lists('image_id');
							$image = Images::whereIn('id',$id)->first();
						?>
						<div class="col-xs-12 col-sm-5 col-md-5">
							<img src="/jf-shop/{{$image->link}}" style="width: 100%">
						</div>
						<div class="col-xs-12 col-sm-7 col-md-7 bg-white" style="padding-top: 20px">
							<h1>{{$promotion->title}}</h1>
							<p>{{$promotion->description}}</p>
							<h3>สินค้าที่ร่วมรายการ</h3>
							@foreach($products as $product ) 
								<div class="row" style="padding-bottom: 10px">
									<div class="col-xs-6 col-sm-6 col-md-6">
										<h6><a href="{{URL::route('product-id',$product->product_id)}}">{{$product->name}}</a></h6>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
									@if($product->type == 1)
										<h6>ลด {{$product->value}} บาท</h6>
									@else
										<h6>ลด {{$product->value}} %</h6>
									@endif
									</div>
								</div>
							@endforeach
							<h3>ระยะเวลา</h3>
							<?php
								$start_date = strtotime($promotion->start_date);
								$expire_date = strtotime($promotion->expire_date);
								$start = date('d/m/Y',$start_date);
								$expire = date('d/m/Y',$expire_date);
							?>
							<p>วันที่ {{$start}}  ถึง วันที่ {{$expire}}</p>
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection