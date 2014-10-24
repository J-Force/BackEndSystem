<!DOCTYPE html>
<html>
<head>
	<title>J F - S h o p</title>
	{{ HTML::style('css/container.css') }}
</head>
<body>
	@if(Session::has('global'))
		<p>{{ Session::get('global') }}</p>
	@endif

	@include('layout.navigation')
	@yield('content')
</body>
</html>