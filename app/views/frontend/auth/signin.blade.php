@extends('frontend/layouts/login')

@section('content')

	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		<form class="form-vertical login-form" action="{{ route('signin') }}" method="POST">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />

			<h3 class="form-title">Login to your account</h3>
			<div class="alert alert-error hide">
				<button class="close" data-dismiss="alert"></button>
				<span>Enter E-mail address and password.</span>
			</div>
			<div class="control-group {{ $errors->first('email', ' error') }}">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">E-mail address</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-user"></i>
						<input class="m-wrap placeholder-no-fix" type="text" placeholder="E-mail address" name="email" value="{{ Input::old('email') }}" />				
					</div>
				</div>
				<label for="email" class="help-inline help-small no-left-padding">{{ $errors->first('email', ':message') }}</label>
			</div>
			<div class="control-group {{ $errors->first('password', ' error') }}">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-lock"></i>
						<input class="m-wrap placeholder-no-fix" type="password" placeholder="Password" name="password"/>
					</div>
				</div>
				<label for="password" class="help-inline help-small no-left-padding">{{ $errors->first('password', ':message') }}</label>
			</div>
			<div class="form-actions">
				<label class="checkbox">
				<input type="checkbox" name="remember-me" value="1"/> Remember me
				</label>
				<button type="submit" class="btn green pull-right">
				Login <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>
<?php /*	<div class="forget-password">
				<h4>Forgot your password ?</h4>
				<p>
					no worries, click <a href="{{ route('forgot-password') }}" class="btn btn-link">here</a>
					to reset your password.
				</p>
			</div>
	*/ ?>
		</form>
		<!-- END LOGIN FORM -->        
		<!-- BEGIN FORGOT PASSWORD FORM -->
		<form class="form-vertical forget-form" action="index.html">
			<h3 class="">Forget Password ?</h3>
			<p>Enter your e-mail address address below to reset your password.</p>
			<div class="control-group">
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-envelope"></i>
						<input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="email" />
					</div>
				</div>
			</div>
			<div class="form-actions">
				<button type="button" id="back-btn" class="btn">
				<i class="m-icon-swapleft"></i> Back
				</button>
				<button type="submit" class="btn green pull-right">
				Submit <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>
		</form>
		<!-- END FORGOT PASSWORD FORM -->
	</div>
	<!-- END LOGIN -->
@stop