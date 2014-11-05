@extends('layout.newDefault')

@section('content')

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
							<div class="row promotion-row">
								 <div class="col-md-8"><img src="/jf-shop/images/promotion1.jpg"/></div>
								 <div class="col-md-4"><img src="/jf-shop/images/promotion2.jpg"/></div>
							</div>
							<div class="row promotion-row">
							  <div class="col-xs-6 col-sm-4 col-md-4"><img src="/jf-shop/images/promotion3.jpg"/></div>
							  <div class="col-xs-6 col-sm-4 col-md-4"><img src="/jf-shop/images/promotion4.jpg"/></div>
							  <div class="col-xs-6 col-sm-4 col-md-4"><img src="/jf-shop/images/promotion5.jpg"/></div>
							</div>
							<div class="row promotion-row">
							  <div class="col-md-6"><img src="/jf-shop/images/promotion6.jpg"/></div>
							  <div class="col-md-6"><img src="/jf-shop/images/promotion7.jpg"/></div>
							</div>
							<a href="#hotitems" class="btn btn-skin btn-scroll margintop-20">HOT ITEMS</a>
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
											<a href="/jf-shop/images/works/1.jpg" title="DOUBLE BREASTED COAT / CHECKED SHIRT/ FLARED MINI DRESS WITH POCKETS" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src="/jf-shop/images/works/1.jpg" class="img-responsive" onmouseover="this.src='/jf-shop/images/works/1.1.jpg'"onmouseout="this.src='/jf-shop/images/works/1.jpg'" />
											</a>
										</div>
										<div class="col-md-3 animated fadeInUp slow">
											<a href="/jf-shop/images/works/2.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src="/jf-shop/images/works/2.jpg" class="img-responsive" onmouseover="this.src='/jf-shop/images/works/2.1.jpg'"onmouseout="this.src='/jf-shop/images/works/2.jpg'" />
											</a>
										</div>
										<div class="col-md-3 animated fadeInUp slower">
											<a href="/jf-shop/images/works/3.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src="/jf-shop/images/works/3.jpg" class="img-responsive" onmouseover="this.src='/jf-shop/images/works/3.1.jpg'"onmouseout="this.src='/jf-shop/images/works/3.jpg'" />
											</a>
										</div>
										<div class="col-md-3 animated fadeInUp">
											<a href="/jf-shop/images/works/4.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src="/jf-shop/images/works/4.jpg" class="img-responsive" onmouseover="this.src='/jf-shop/images/works/4.1.jpg'"onmouseout="this.src='/jf-shop/images/works/4.jpg'" />
											</a>
										</div>
									</div>
									<!--/row-->
								</div>
								<!--/item-->
								<div class="item">
			                        <div class="row gallery-item">
			                        	<div class="col-md-3 animated fadeInUp">
											<a href="/jf-shop/images/works/tmp.jpg" title="TEMPLATE" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src="/jf-shop/images/works/tmp.jpg" alt="Image" class="img-responsive">
											</a>
										</div>
										<div class="col-md-3 animated fadeInUp slow">
											<a href="/jf-shop/images/works/tmp.jpg" title="TEMPLATE" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src="/jf-shop/images/works/tmp.jpg" alt="Image" class="img-responsive">
											</a>
										</div>
										<div class="col-md-3 animated fadeInUp slower">
											<a href="/jf-shop/images/works/tmp.jpg" title="TEMPLATE" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src="/jf-shop/images/works/tmp.jpg" alt="Image" class="img-responsive">
											</a>
										</div>
										<div class="col-md-3 animated fadeInUp">
											<a href="/jf-shop/images/works/tmp.jpg" title="TEMPLATE" data-lightbox-gallery="gallery1" data-lightbox-hidpi="/jf-shop/images/works/1@2x.jpg">
											<img src="/jf-shop/images/works/tmp.jpg" alt="Image" class="img-responsive">
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
		<section id="service" class="home-section color-dark bg-gray">
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
		</section>
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