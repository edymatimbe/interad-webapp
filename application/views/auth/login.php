<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= (isset($title) ? '41 BUSNESS CENTER | ' . $title : '41 BUSNESS CENTER') ?></title>
	<link rel="icon" href="<?= base_url(); ?>public\41\src.png">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>public/assets/auth/auth.css" rel="stylesheet">
	<link rel="manifest" href="<?= base_url(); ?>public/manifest.json" />

	<style>
		* {
			margin: 0px;
			padding: 0px;
		}

		.login {
			/* background: linear-gradient(to bottom, #0099ff 0%, #fff 100%); */
			height: 100vh;
			width: 100%;
			justify-content: center;
			align-items: center;
			display: flex;
		}

		.account-login {
			width: 500px;
		}

		.form-control:focus {
			box-shadow: none;
		}

		.login-form input {
			width: 100%;
			position: relative;
			border-bottom: 1px solid #a39e9e;
			padding: 0;
			border-top: 0px;
			border-left: 0px;
			border-right: 0px;
			box-shadow: none;
			height: 63px;
			border-radius: 0px;
		}

		.login-form {
			background: #fff;
			float: left;
			width: 100%;
			padding: 40px;
			border-radius: 5px;
		}

		button.btn {
			width: 100%;
			background: #009cff;
			font-size: 20px;
			padding: 11px;
			color: #fff;
			border: 0px;
			margin: 10px 0px 20px;
		}

		.btn:hover {
			color: #fff;
			opacity: 0.8;
		}


		@media (max-width: 767px) {
			.account-login {
				width: 90%;
			}
		}
	</style>
</head>

<body>
	<div class="sidebar-login">
		<div class="toggle"></div>
		<form id="form-login">

			<img src="<?= base_url() ?>public\41\logo-sm.png" alt="">
			<br>
			<br>
			<h2>Admin Login</h2>
			<div class="" id="alert">

			</div>
			<div class="input-box">
				<i class="fa fa-user"></i>
				<input type="text" name="log_email" placeholder="Email ou username" id="log_email" required="">
			</div>
			<div class="input-box">
				<i class="fa fa-lock"></i>
				<input type="password" name="log_password" placeholder="Password" id="log_password" required="">
			</div>
			<div class="input-box">
				<input type="submit" name="" value="Login">
			</div>
			<a href="#" class="a">Recuperar a password</a>
			<br>
			<a class="a" href="<?= base_url('auth/signup') ?>"> Cadastrar-se</a>

		</form>
	</div>
	<div class="banner">
		<div class="login">
			<div class="account-login">
				<form id="form-driver" class="login-form" autocomplete="off">
					<div class="input-box">
						<i class="fa-solid fa-user-tie"></i>
						<input type="password" name="password" placeholder="Password do motorista" id="password" required="">
					</div>
					<button class="btn">Login</button>
				</form>
			</div>
		</div>
	</div>
	<script src="<?= base_url(); ?>public/assets/auth/auth.js"></script>
	<script>
		if ('serviceWorker' in navigator) {
			window.addEventListener('load', function() {
				navigator.serviceWorker.register('<?= base_url('public/sw.js') ?>').then(function(registration) {
					console.log('ServiceWorker registration successful with scope: ', registration.scope);
				}, function(err) {
					console.log('ServiceWorker registration failed: ', err);
				});
			});
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.toggle').click(function() {
				$('.sidebar-login').toggleClass('active')
				$('.toggle').toggleClass('active')
			})
		})
	</script>
	<script !src="">
		function hideAlert() {
			$('#alert').addClass('d-none')
		}

		$(document).on('input', '.input', function() {
			hideAlert()
		});


		$(document).ready(function() {
			$('#form-driver').on('submit', function(e) {
				e.preventDefault();
				const password = $('#password').val();
				$.ajax({
					type: 'POST',
					url: '<?= base_url('auth/login_driver') ?>',
					dataType: "JSON",
					data: {
						password
					},
					beforeSend: function() {
						$("#loader-two").fadeIn();
					},
					success: function(data) {
						$("#loader-two").fadeOut();
						console.log(data)
						if (data.ok) {
							window.location = '<?= base_url('homepage') ?>'
						} else {
							$('#alert').addClass('alert danger');
							$('#alert').text(data.message);
						}
					}
				});
			})
			$('#form-login').on('submit', function(e) {
				e.preventDefault();
				// console.log('sssssss')

				const log_email = $('#log_email').val();
				const log_password = $('#log_password').val();
				$.ajax({
					type: 'POST',
					url: '<?= base_url('auth/login') ?>',
					dataType: "JSON",
					data: {
						'log_email': log_email,
						'log_password': log_password
					},
					beforeSend: function() {
						$("#loader-two").fadeIn();
					},
					success: function(data) {
						$("#loader-two").fadeOut();
						if (data.ok) {

							if (data.type_user == 3) {
								window.location = '<?= base_url('advertiser') ?>'
							} else {
								window.location = '<?= base_url('home') ?>'
							}

						} else {
							$('#alert').addClass('alert danger');
							$('#alert').text(data.message);
						}
						// if (data.ok) {
						// 	window.location = '<?= base_url('home') ?>'
						// } else {
						// 	$('#alert').addClass('alert danger');
						// 	$('#alert').text(data.message);
						// }
					}
				});
			})
		});

		$(document).ready(function() {
			$(".preloader").fadeOut();
			$(".preloader-2").fadeOut();
		});
		$(".close").click(function() {
			$(this)
				.parent(".alert")
				.fadeOut(); //jquery method
		});
	</script>
</body>

</html>