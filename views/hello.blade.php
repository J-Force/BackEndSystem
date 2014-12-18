@extends('layout.newDefault')

@section('content')

<?php
	$products = DB::table('hot_product')->take(8)->get();
	foreach($products as $product) {
		$pro = DB::table('product_images')->where('product_id', '=', $product->product_id)->first();
		$link = DB::table('images')->where('id', '=', $pro->image_id)->first();
		$product->link = $link->link;
	}

	$promotions = DB::table('promotions')->take(3)->get();

	// foreach($promotions as $p) {
	// 	$ids = DB::table('promotion_image')->where('promotion_id', '=' ,$p->id )->lists('image_id');
	// 	if(count($ids) == 0){
	// 		$ids = array(0);
	// 	}
	// 	$image = Images::whereIn('id',$ids)->take(1)->get();
	// 	$p->link = $image->link;
	// }
?>
<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
	<section class="hero" id="intro">
		<div class="container">
			<img src="/jf-shop/images/women.jpg" class="imgLeft"></img>
			<img src="/jf-shop/images/man.jpg" class="imgRight"></img>
			<div class="row">
				<div class="col-md-12 text-right navicon">
					<a id="nav-toggle" class="nav_slide_button" href="#"><span></span></a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center inner">
					<div class="animatedParent">
						<h1 class="animated fadeInDown">J Force</h1>
						<p class="animated fadeInUp">E-commerce Fashion Clothing Shopping</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<a href="{{ URL::route('catalog-women') }}" class="women-btn slideleft btn-scroll">WOMEN</a>
					<a href="#promotion" class="home-btn slidedown btn-scroll">HOME</a>
					<a href="{{ URL::route('catalog-man') }}" class="man-btn slideright btn-scroll">MEN</a>
				</div>
			</div>
		</div>
	</section>
	@include('layout.newNav')
	<section id="promotion" class="home-section color-dark bg-white">
			<div class="container marginbot-50">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="animatedParent">
							<div class="section-heading text-center animated bounceInDown">
								<h2 class="h-bold">PROMOTION</h2>
								<div class="divider-header"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="animatedParent">
						<div class="row text-center">
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
							<a href={{URL::route('promotions')}} class="btn btn-skin btn-scroll margintop-20">More</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /Section: promotion -->
		<!-- Section: hot items -->
		<section id="hotitems" class="home-section color-dark text-center bg-white">
			<div class="container marginbot-50">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div>
							<div class="animatedParent">
								<div class="section-heading text-center">
									<h2 class="h-bold animated bounceInDown">HOT ITEMS</h2>
									<div class="divider-header"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row animatedParent">
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<div class="col-sm-12 col-md-12 col-lg-12" >
							<ol class="carousel-indicators">
									<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
									<li data-target="#carousel-example-generic" data-slide-to="1"></li>
							</ol>
							<div class="carousel-inner">
								<div class="item active">
									<div class="row gallery-item">
									
										<div class="col-md-3 animated fadeInUp">
											<a href={{"/jf-shop/products/show/".$products[0]->product_id}} title="DOUBLE BREASTED COAT / CHECKED SHIRT/ FLARED MINI DRESS WITH POCKETS" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src={{'/jf-shop'.$products[0]->link}} class="img-responsive" />
											</a>
										</div>
										<div class="col-md-3 animated fadeInUp slow">
											<a href={{"/jf-shop/products/show/".$products[1]->product_id}} title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src={{'/jf-shop'.$products[1]->link}} class="img-responsive" />
											</a>
										</div>
										<div class="col-md-3 animated fadeInUp slower">
											<a href={{"/jf-shop/products/show/".$products[2]->product_id}} title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src={{'/jf-shop'.$products[2]->link}} class="img-responsive" />
											</a>
										</div>
										<div class="col-md-3 animated fadeInUp">
											<a href={{"/jf-shop/products/show/".$products[3]->product_id}} title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src={{'/jf-shop'.$products[3]->link}} class="img-responsive" />
											</a>
										</div>
									</div>
									<!--/row-->
								</div>
								<!--/item-->
								<div class="item">
			                        <div class="row gallery-item">
			                        	<div class="col-md-3 animated fadeInUp">
											<a href={{"/jf-shop/products/show/".$products[4]->product_id}} title="TEMPLATE" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src={{'/jf-shop'.$products[4]->link}} alt="Image" class="img-responsive">
											</a>
										</div>
										<div class="col-md-3 animated fadeInUp slow">
											<a href={{"/jf-shop/products/show/".$products[5]->product_id}} title="TEMPLATE" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src={{'/jf-shop'.$products[5]->link}} alt="Image" class="img-responsive">
											</a>
										</div>
										<div class="col-md-3 animated fadeInUp slower">
											<a href={{"/jf-shop/products/show/".$products[6]->product_id}} title="TEMPLATE" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src={{'/jf-shop'.$products[6]->link}} alt="Image" class="img-responsive">
											</a>
										</div>
										<div class="col-md-3 animated fadeInUp">
											<a href={{"/jf-shop/products/show/".$products[7]->product_id}} title="TEMPLATE" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src={{'/jf-shop'.$products[7]->link}} alt="Image" class="img-responsive">
											</a>
										</div>
			                        </div>
			                        <!--/row-->
			                    </div>
			                    <!--/item-->
							</div>
						</div>
						<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" style="color:#3DC9B3;margin-top:150px;"></span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" style="color:#3DC9B3;margin-top:150px;"></span>
						</a>
					</div>
				</div>
			</div>
		</section>
		<!-- /Section: hot items -->
		<!-- Section: services -->
		<!-- <section id="service" class="home-section color-dark bg-gray">
			<div class="container marginbot-50">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div>
							<div class="section-heading text-center">
								<h2 class="h-bold">What we can do for you</h2>
								<div class="divider-header"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center">
				<div class="container">
					<div class="row animatedParent">
						<div class="col-xs-6 col-sm-4 col-md-4">
							<div class="animated rotateInDownLeft">
								<div class="service-box">
									<div class="service-icon">
										<img class="img-circle" src="/jf-shop/images/works/news1.jpg" style="width: 200px; height: 200px;">
									</div>
									<div class="service-desc">
										<h5>JOIN THE CLUB</h5>
										<div class="divider-header"></div>
										<p>
											Simply tell us where you'd like the clothes delivered then sit back and relax.
										</p>
										<a href="#" class="btn btn-skin">Learn more</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-4">
							<div class="animated rotateInDownLeft slow">
								<div class="service-box">
									<div class="service-icon">
										<img class="img-circle" src="/jf-shop/images/works/news2.jpg" alt="Generic placeholder image" style="width: 200px; height: 200px;">
									</div>
									<div class="service-desc">
										<h5>DESIGN</h5>
										<div class="divider-header"></div>
										<p>
											We design the best wearing clothes using the highest quality fabrics.
										</p>
										<a href="#" class="btn btn-skin">Learn more</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-4">
							<div class="animated rotateInDownLeft slower">
								<div class="service-box">
									<div class="service-icon">
										<img class="img-circle" src="/jf-shop/images/works/news3.jpg" alt="Generic placeholder image" style="width: 200px; height: 200px;">
									</div>
									<div class="service-desc">
										<h5>RECEIVE PRODUCTS</h5>
										<div class="divider-header"></div>
										<p>
											You get a fresh products delivered to your door. Hit the town cowboy.
										</p>
										<a href="#" class="btn btn-skin">Learn more</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section> -->
		<!-- /Section: News -->
		
		<!-- /Section: services -->
		<!-- Section: contact
		<section id="contact" class="home-section nopadd-bot color-dark bg-gray text-center">
			<div class="container marginbot-50">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="animatedParent">
							<div class="section-heading text-center">
								<h2 class="h-bold animated bounceInDown">Get in touch with us</h2>
								<div class="divider-header"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row marginbot-80">
					<div class="col-md-8 col-md-offset-2">
						<form id="contact-form">
							<div class="row marginbot-20">
								<div class="col-md-6 xs-marginbot-20">
									<input type="text" class="form-control input-lg" id="name" placeholder="Enter name" required="required" />
								</div>
								<div class="col-md-6">
									<input type="email" class="form-control input-lg" id="email" placeholder="Enter email" required="required" />
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" class="form-control input-lg" id="subject" placeholder="Subject" required="required" />
									</div>
									<div class="form-group">
										<textarea name="message" id="message" class="form-control" rows="4" cols="25" required="required"
											placeholder="Message"></textarea>
									</div>
									<button type="submit" class="btn btn-skin btn-lg btn-block" id="btnContactUs">
									Send Message</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		/Section: contact -->
@endsection