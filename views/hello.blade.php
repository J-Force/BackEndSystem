@extends('layout.newDefault')

@section('content')

@if(Auth::check())
	
@endif

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
					<p class="animated fadeInUp">Description</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<a href="women-catalog.html" class="women-btn slideleft btn-scroll">WOMEN</a>
				<a href="#promotion" class="home-btn slidedown btn-scroll">HOME</a>
				<a href="men-catalog.html" class="man-btn slideright btn-scroll">MAN</a>
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
							<a href="#service" class="btn btn-skin btn-scroll">What we do</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /Section: promotion -->
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
										<span class="fa fa-laptop fa-2x"></span> 
									</div>
									<div class="service-desc">
										<h5>Web Design</h5>
										<div class="divider-header"></div>
										<p>
											Ad denique euripidis signiferumque vim, iusto admodum quo cu. No tritani neglegentur mediocritatem duo.
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
										<span class="fa fa-camera fa-2x"></span> 
									</div>
									<div class="service-desc">
										<h5>Photography</h5>
										<div class="divider-header"></div>
										<p>
											Ad denique euripidis signiferumque vim, iusto admodum quo cu. No tritani neglegentur mediocritatem duo.
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
										<span class="fa fa-code fa-2x"></span> 
									</div>
									<div class="service-desc">
										<h5>Graphic design</h5>
										<div class="divider-header"></div>
										<p>
											Ad denique euripidis signiferumque vim, iusto admodum quo cu. No tritani neglegentur mediocritatem duo.
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
		<!-- /Section: services -->
		<!-- Section: works -->
		<section id="works" class="home-section color-dark text-center bg-white">
			<div class="container marginbot-50">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div>
							<div class="animatedParent">
								<div class="section-heading text-center">
									<h2 class="h-bold animated bounceInDown">What we have done</h2>
									<div class="divider-header"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row animatedParent">
					<div class="col-sm-12 col-md-12 col-lg-12" >
						<div class="row gallery-item">
							<div class="col-md-3 animated fadeInUp">
								<a href="img/works/1.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/1@2x.jpg">
								<img src="/jf-shop/images/works/1.jpg" class="img-responsive" alt="img">
								</a>
							</div>
							<div class="col-md-3 animated fadeInUp slow">
								<a href="img/works/2.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/1@2x.jpg">
								<img src="/jf-shop/images/works/2.jpg" class="img-responsive" alt="img">
								</a>
							</div>
							<div class="col-md-3 animated fadeInUp slower">
								<a href="img/works/3.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/1@2x.jpg">
								<img src="/jf-shop/images/works/3.jpg" class="img-responsive" alt="img">
								</a>
							</div>
							<div class="col-md-3 animated fadeInUp">
								<a href="img/works/4.jpg" title="This is an image title" data-lightbox-gallery="gallery1" data-lightbox-hidpi="img/works/1@2x.jpg">
								<img src="/jf-shop/images/works/4.jpg" class="img-responsive" alt="img">
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /Section: works -->
		<!-- Section: contact -->
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
		<!-- /Section: contact -->
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<ul class="footer-menu">
							<li><a href="#">Home</a></li>
							<li><a href="#">Press release</a></li>
						</ul>
					</div>
					<div class="col-md-6 text-right">
						<p>&copy;Copyright 2014 - Bocor. Designed by <a href="http://bootstraptaste.com">Bootstraptaste</a></p>
					</div>
				</div>
			</div>
		</footer>
<!-- <div class="btn-group btn-group-justified">
	<div class="btn-group btn-group-justified">
	  <div class="btn-group">
	  	<a href="{{ URL::route('catalog-man') }}">
	    	<button type="button" class="btn btn-default btn-success">Men</button>
	    </a>
	  </div>
	  <div class="btn-group btn-danger">
	  	<a href="{{ URL::route('catalog-women') }}">
	    	<button type="button" class="btn btn-default btn-primary">Women</button>
	    </a>
	  </div>
	</div>
</div> -->
@endsection