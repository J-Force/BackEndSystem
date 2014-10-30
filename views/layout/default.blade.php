<!DOCTYPE HTML>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>JForce Shop</title>

    <!-- Bootstrap core CSS -->
     <link href="/jf-shop/css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/jf-shop/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  <!-- Custom styles for this template -->
  <link href="/jf-shop/css/carousel.css" rel="stylesheet">
  <link href="/jf-shop/css/captionHoverEffect.css" rel="stylesheet">
  <link href="/jf-shop/css/dropzone.css" rel="stylesheet">
  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="/jf-shop/js/jquery.js"></script>
  <script src="/jf-shop/js/bootstrap.js"></script>
  <script src="/jf-shop/js/docs.js"></script>
  <script src="/jf-shop/js/toucheffects.js"></script>
  <script src="/jf-shop/js/modernizr.custom.js"></script>
  <script src="/jf-shop/js/dropzone-amd-module.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="/jf-shop/js/ie10-viewport-bug-workaround.js"></script>
  <script type="text/javascript"> $('.dropdown-toggle').dropdown(); </script>
  <!--<style type="text/css" id="holderjs-style"></style>-->
  <style type="text/css">
  .dropdown-menu {
    min-width: 200px;
  }
  .dropdown-menu.columns-2 {
    min-width: 400px;
  }
  .dropdown-menu.columns-3 {
    min-width: 600px;
  }
  .dropdown-menu li a {
    padding: 5px 15px;
    font-weight: 300;
  }
  .multi-column-dropdown {
    list-style: none;
  }
  .multi-column-dropdown li a {
    display: block;
    clear: both;
    line-height: 1.428571429;
    color: #333;
    white-space: normal;
  }
  .multi-column-dropdown li a:hover {
    text-decoration: none;
    color: #262626;
    background-color: #f5f5f5;
  }
  
  @media (max-width: 767px) {
    .dropdown-menu.multi-column {
      min-width: 240px !important;
      overflow-x: hidden;
    }
  }
  
  @media (max-width: 480px) {
    .content {
      width: 90%;
      margin: 50px auto;
      padding: 10px;
    }
  }
</style>
</head>
<body style="padding-left : 5em;padding-right : 5em">
	@if(Session::has('success'))
		<div class="alert alert-success">
        <h2>{{ Session::get('success') }}</h2>
    </div>
  @elseif(Session::has('fail'))
    <div class="alert alert-danger">
        <h2>{{ Session::get('fail') }}</h2>
    </div>
	@endif
	@include('layout.navigation')
	@yield('content')
  

</body>
</html>
<script>

$(document).ready(function(){
  $('.alert').fadeOut( 3000 );
});
  

</script>