<div class="header">
		<div class="navigation">
			<div class="navbar">
				<div class="navbar-logo">
					<a href="{{ URL::route('home'); }}">
						<img src="/jf-shop/images/logo1.png"/>
					</a>
				</div>

				<div class="navbar-catalog"><p>CATALOG</p></div>

				<input type="text" class="navbar-search"></input>

				<button class="navbar-button">Search</button>
				@if(Auth::check())
				<div class="navbar-form">
					<button class="navbar-button" onclick="window.location='{{ URL::route('profile-user'); }}'"> Profile </button>
					<button class="navbar-button" onclick="window.location='{{ URL::route('account-sign-out'); }}'"> Sign out</button>
				</div>
				@else
				<div class="navbar-form">
					<form action="{{ URL::route('account-sign-in-post') }}" , method="post">
						<input type="text" placeholder="Email" class="navbar-username" name="email"></input>
						<input type="password" placeholder="Password" class="navbar-password" name="password"></input>
						<button class="navbar-button" onclick="window.location='{{ URL::route('account-sign-in-post'); }}'">Sign in</button>
						{{ Form::token() }}
					</form>	
				</div>
				<div class="navbar-form">
					<button class="navbar-button" onclick="window.location='{{ URL::route('account-create'); }}'">Register</button>
				</div>
				@endif
				<div class="navbar-logo">
					<a href="#">
						<img src="/jf-shop/images/cart.png"/>
					</a>
				</div>
			</div>
		</div>
		<div class="navbar-border"></div>
</div>