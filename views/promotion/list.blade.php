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
					<div class="row animatedParent" style="margin-bottom: 30px">
						<div class="row animatedParent" style="margin-bottom: 30px">
						<?php $i = 0 ?>
						@foreach($promotions as $promotion)
						@if($i%3==0)
						</div>
						<div class="row animatedParent" style="margin-bottom: 30px">
						@endif
							<div class="col-xs-6 col-sm-4 col-md-4">
								<div class="animated ">
									<div class="service-box">
										<div class="service-icon">
											<?php
									            $ids = DB::table('promotion_image')->where('promotion_id', '=' ,$promotion->id )->lists('image_id');
									            if(count($ids) == 0){
									              $ids = array(0);
									            }
									            $images = Images::whereIn('id',$ids)->take(1)->get();
									         ?>
									        @foreach ($images as $image) 
												<img class="img-circle" src="/jf-shop/{{$image->link}}" style="width: 200px; height: 200px;">
											@endforeach
										</div>
										<div class="service-desc">
											<h5>{{$promotion->title}}</h5>
											<div class="divider-header"></div>
											<p>
												{{substr($promotion->description,0,strlen($promotion->description)/2).'...'}}
											</p>
											<a href="{{URL::route('promotion-detail',$promotion->id)}}" class="btn btn-skin">Read more</a>
										</div>
									</div>
								</div>
							</div>
							<?php $i++ ?>
						@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>

@endsection