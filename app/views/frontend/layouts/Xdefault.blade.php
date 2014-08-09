<!DOCTYPE html>
<html lang="en">
	<head>
		
		<meta charset="utf-8" />
		<title>
			@section('title')
			 Welcome
			@show
		</title>
			
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

		<style>
		@section('styles')
		body {
			padding: 10px 0;
		}
		@show
		</style>

				<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			</head>

	<body>
		<!-- Container -->
		<div class="container">
					<div class="container">
						<a data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>

						<div class="nav-collapse collapse">
						

							<ul class="nav pull-right">
								@if (Sentry::check())

								<li class="dropdown{{ (Request::is('account*') ? ' active' : '') }}">
									<a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="{{ route('account') }}">
										Welcome, {{ Sentry::getUser()->first_name }}
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
										<li><a href="{{ route('logout') }}"><i class="icon-off"></i> Logout</a></li>
									</ul>
								</li>
								@else
								<li {{ (Request::is('auth/signin') ? 'class="active"' : '') }}><a href="{{ route('signin') }}">Sign in</a></li>
								<li {{ (Request::is('auth/signup') ? 'class="active"' : '') }}><a href="{{ route('signup') }}">Sign up</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>

			<!-- Notifications -->
			@include('frontend/notifications')

			<!-- Content -->
			@yield('content')

			<hr />

			<!-- Footer -->
			<footer>
				<p>&copy; Company {{ date('Y') }}</p>
			</footer>
		</div>

				<script src="{{ asset('assets/js/jquery.1.10.2.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
	</body>
</html>
