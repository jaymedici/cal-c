<!DOCTYPE html>
<html lang="en">
<head>
	<title>CalC Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap-login/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2-login/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css-login/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css-login/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="col-md-12 mb-2">
					<span class="login100-form-title">CalC - A Visit Calculating & Scheduling System</span>
				</div>
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('images/img-2.png')}}" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="{{ route('login.post') }}" method="post">
					@csrf
					<h5 class="mb-2 text-center">
						Please login
					</h5>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: lucy@example.com">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>

						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					@if(Session::has('error_message'))
					<span style="color:red;">
						<strong>{!! session('error_message') !!}</strong>
					</span>
					@endif
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="{{ url('password/reset') }}">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="{{asset('vendor/jquery-login/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/bootstrap-login/js/popper.js')}}"></script>
	<script src="{{asset('vendor/bootstrap-login/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/select2-login/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/tilt/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('js-login/main.js')}}"></script>

</body>
</html>