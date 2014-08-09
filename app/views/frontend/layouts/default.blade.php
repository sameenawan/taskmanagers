<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<head>
	@include('frontend.layouts.parts.head')
</head>

<body>
	@include('frontend.layouts.parts.header')
	
	<div>
		<div>
			{{ Menu::handler('main')->render() }}			
		</div>
				
			<div>
				@include('frontend.notifications')
				@section('content')
				@show
			</div>		
	</div>
	
	<div class="footer">
		<div>
			2014 &copy; Sameen Awan Harvard University Incorporated
		</div>
			</div>
	

	@include('frontend.layouts.parts.footer')
</body>


</html>