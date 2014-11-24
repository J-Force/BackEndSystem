<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>JForce Shop</title>
		<!-- css -->
		<link href="/jf-shop/css/bootstrap.min.css" rel="stylesheet">
		<link href="/jf-shop/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="/jf-shop/css/nivo-lightbox.css" rel="stylesheet" />
		<link href="/jf-shop/css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
		<link href="/jf-shop/css/animations.css" rel="stylesheet" />
		<link href="/jf-shop/css/style.css" rel="stylesheet">
		<link href="/jf-shop/color/default.css" rel="stylesheet">
		<link href="/jf-shop/css/dropzone.css" rel="stylesheet">
		<link href="/jf-shop/css/captionHoverEffect.css" rel="stylesheet">
		<link href="/jf-shop/css/menu.css" rel="stylesheet" >
		<link href="/jf-shop/css/category.css" rel="stylesheet">
		

	</head>
	<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
		<style type="text/css">
			.notice{
				position: fixed;
				top: 10%;
				left: 30%;
				width: 40%;
				line-height: 40px;
				text-align: center;
				overflow: auto;
				z-index: 4000;
				color:#fff;
				font-family: MyriadPro,Geneva,Arial,sans-serif;
				font-size:30px;
				padding:10px 10px 10px 10px;
				border-radius: 5px;
			}
			.notice-success{
				background-color: rgba(62,201,179,0.7);
			}
			.notice-fail{
				background-color: rgba(246,81,136,0.7);
			}
		</style>
		@if(Session::has('success'))
		<div id="notice" class="notice notice-success">
	        {{ Session::get('success') }}
	    </div>
	  	@elseif(Session::has('fail'))
	    <div id="notice" class="notice notice-fail">
	        {{ Session::get('fail') }}
	    </div>
		@endif
		<script src="/jf-shop/js/jquery.js"></script>	 
		<script src="/jf-shop/js/bootstrap.min.js"></script>
		<script src="/jf-shop/js/jquery.sticky.js"></script>
		<script src="/jf-shop/js/jquery.easing.min.js"></script>	
		<script src="/jf-shop/js/jquery.scrollTo.js"></script>
		<script src="/jf-shop/js/jquery.appear.js"></script>
		<script src="/jf-shop/js/stellar.js"></script>
		<script src="/jf-shop/js/nivo-lightbox.min.js"></script>
		<script src="/jf-shop/js/custom.js"></script>
		<script src="/jf-shop/js/css3-animate-it.js"></script>
		<script src="/jf-shop/js/dropzone-amd-module.min.js"></script>
		<script src="/jf-shop/js/toucheffects.js"></script>
		<script src="/jf-shop/js/modernizr.custom.js"></script>
		
		<!--<script src="/jf-shop/js/menu.js"></script>-->
		<div style="min-height: 100%">
			@yield('content')
		</div>
		@include('layout.footer')
		
	</body>
</html>
<script type="text/javascript">

	// $(window).bind("beforeunload" , function(e) {
	// 	e.preventDefault();

	// 	$.post("/jf-shop/user/orders/clear_when_sign_out",{},
	// 	  	function(res,status){

	// 	  	} 
	// 	);
		
	//   	return 'If you leave , your order will be clear';
	// });


	if(document.getElementById("notice")!== null)
        $('#notice').delay(3000).fadeOut(1000);

    $(document).ready(function(){
	  $('.alert').fadeOut( 3000 );
	});

</script>