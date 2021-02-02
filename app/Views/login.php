<!DOCTYPE html>
<html lang="en">
<head>
<title>Lowy Front End Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->
    <?php echo link_tag('assets/css/bootstrap.min.css');?>
<!--===============================================================================================-->
	<?php echo link_tag('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');   ?>
<!--===============================================================================================-->
	<?php echo link_tag('assets/css/animate.min.css');  ?>
<!--===============================================================================================-->	
    <?php echo link_tag('assets/css/hamburgers.min.css');  ?>
<!--===============================================================================================-->
    <?php echo link_tag('assets/css/select2.min.css');  ?>
<!--===============================================================================================-->
    <?php echo link_tag('assets/css/util.css');  ?>
    <?php echo link_tag('assets/css/main.css');  ?>
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src=<?php echo base_url('assets/img/LOWY-horizontal-digital-2019-v2.png');?> alt="IMG">
				</div>

				<form class="login100-form validate-form" action="<?php echo base_url('Users');?>" method="post">
					<span class="login100-form-title">
						Member Login
					</span>
					<?php if (!empty(session('error'))): ?>
					<div class="col-12" style="padding-right:0px;padding-left:0px">
					<div class="alert alert-danger" role="alert">
					<?= session('error'); ?>
					</div>
                    </div>
						<?php endif; ?>
                    <?php if (isset($validation)): ?>
                        <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                        </div>
                     <?php endif; ?>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" id="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" id="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<!-- <a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a> -->
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
<?php echo script_tag("assets/js/jquery-3.5.1.js"); ?>
<!--===============================================================================================-->
   <?php echo script_tag("assets/js/popper.min.js"); ?>
   <?php echo script_tag("assets/js/bootstrap.min.js"); ?>
<!--===============================================================================================-->
<?php echo script_tag("assets/js/select2.min.js"); ?>
<!--===============================================================================================-->
<?php echo script_tag("assets/js/tilt.jquery.min.js"); ?>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
<?php echo script_tag("assets/js/main.js"); ?>

</body>
</html>