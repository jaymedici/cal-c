<!DOCTYPE html>
<html lang="en">
<head>
	<title>CalC Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/icons/favicon.ico')); ?>"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/bootstrap-login/css/bootstrap.min.css')); ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')); ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/animate/animate.css')); ?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/css-hamburgers/hamburgers.min.css')); ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/select2-login/select2.min.css')); ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css-login/util.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css-login/main.css')); ?>">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo e(asset('images/img-2.png')); ?>" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="<?php echo e(route('login.post')); ?>" method="post">
					<?php echo csrf_field(); ?>
					<span class="login100-form-title">
						CalC Login
					</span>

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

						<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
							<span class="invalid-feedback" role="alert">
								<strong><?php echo e($message); ?></strong>
							</span>
						<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
					</div>

					<?php if(Session::has('error_message')): ?>
					<span style="color:red;">
						<strong><?php echo session('error_message'); ?></strong>
					</span>
					<?php endif; ?>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="<?php echo e(url('password/reset')); ?>">
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
	<script src="<?php echo e(asset('vendor/jquery-login/jquery-3.2.1.min.js')); ?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo e(asset('vendor/bootstrap-login/js/popper.js')); ?>"></script>
	<script src="<?php echo e(asset('vendor/bootstrap-login/js/bootstrap.min.js')); ?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo e(asset('vendor/select2-login/select2.min.js')); ?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo e(asset('vendor/tilt/tilt.jquery.min.js')); ?>"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="<?php echo e(asset('js-login/main.js')); ?>"></script>

</body>
</html><?php /**PATH C:\xampp\htdocs\Visitcallender\resources\views/auth/login.blade.php ENDPATH**/ ?>