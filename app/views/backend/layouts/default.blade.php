<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>
			@section('title')
			Administration
			@show
		</title>
		
				<style>
		@section('styles')
		body {
			padding: 60px 0;
		}
		@show
		</style>

				<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
					</head>

	<body>
		<!-- Container -->
		<div class="container">
			
			<div >
				<div>
					<div class="container">
					
						<div>
							<ul class="nav">
								<li{{ (Request::is('admin') ? ' class="active"' : '') }}><a href="{{ URL::to('admin') }}"> Home</a></li>
							
									<a class="dropdown-toggle" data-toggle="dropdown" href="{{ URL::to('admin/users') }}">
										<i class="icon-user icon-white"></i> Users <span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li{{ (Request::is('admin/users*') ? ' class="active"' : '') }}><a href="{{ URL::to('admin/users') }}"><i class="icon-user"></i> Users</a></li>
										</ul>
								</li>
							</ul>
							<ul class="nav pull-right">
								<li><a href="{{ route('logout') }}">Logout</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<!-- Notifications -->
			@include('frontend/notifications')

			<!-- Content -->
			@yield('content')
		</div>

		<script language="javascript" src="{{ asset('plugins/jquery-1.10.1.min.js') }}"></script>
		<script language="javascript" src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	</body>
</html>
