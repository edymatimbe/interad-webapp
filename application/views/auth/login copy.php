<!DOCTYPE html>
<html lang="en">
<head>
<title><?= (isset($title) ? 'BIG SOFT | ' . $title : 'BIG SOFT') ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Sistema de POS, POS, Sistema de facturação">
	<meta name="author" content="Fader Macuvele, Florencio Cau, Gilberto Manhiça">
	<link rel="icon" href="<?= base_url(); ?>public/img/logo/logo-500x160.png">
	<link href="<?= base_url(); ?>public/css/style.css" rel="stylesheet">
	<link href="<?= base_url(); ?>public/assets/auth/auth.css" rel="stylesheet">
	<link href="<?= base_url(); ?>public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>public/vendor/fontawesome-free/css/v4-shims.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>public/vendor/feather-icon/feather.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>public/css/custom.css" rel="stylesheet">
</head>
<body class="position-relative bg-none bg-white">
<div class="preloader">
	<svg class="circular" viewBox="25 25 50 50">
		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
	</svg>
</div>

<div class="preloader-2" id="loader-two">
	<svg class="circular" viewBox="25 25 50 50">
		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
	</svg>
</div>
<div class="container-fluid h-100 px-0 overflow-hidden">
<div class="row h-100 align-items-center">
	<div class="col-md-8 col-xl-9 banner banner-signIn" ></div>
	<div class="col-md-4 col-xl-3">
		<div class="h-100 d-flex flex-column justify-content-between px-lg-4 px-md-2">
			<div class="my-auto px-4">
				<p class="text-center mt-5">
					<img src="<?= base_url(); ?>public/img/logo/invoice_logo.png" class="w-50"
						 alt="Logo">
				</p>
				<form id="form-login" method="post" autocomplete="off" class="w-100">
					<div class="alert alert-danger py-1 mb-4 d-none" id="alert">
						<span>
							<i class="fa fa-exclamation-triangle">&nbsp;</i>
							<span id="message" class="f-s-13"></span>
						</span>
						<button onclick="hideAlert()" type="button" class="close mt-1">
							<span class="feather icon-x text-dark"></span>
						</button>
					</div>
					<div class="inputBox form-group">
						<i class="feather icon-user"></i>
						<input class="input" name="log_email" id="log_email" type="text" required value="">
						<label for="log_email">Email</label>
					</div>
					<div class="inputBox form-group">
						<i class="feather icon-lock"></i>
						<input class="input" name="log_password" id="log_password" type="password" required value="">
						<label for="log_password"><?=  $this->lang->line('password') ?></label>
					</div>

					<div class="form-group">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="customControlInline">
							<label class="custom-control-label" for="customControlInline">Remember me</label>
						</div>
					</div>

					<div class="d-flex">
						<button type="submit" name="button" class="btn login_btn">
							<i class="fa fa-sign-in-alt mr-2"></i><?=  $this->lang->line('Sign_in') ?>
						</button>
					</div>
				</form>

				<div class="mt-5">
					<div class="d-flex justify-content-center links f-s-13 mb-2">
						<?=  $this->lang->line('does_not_have').' '.$this->lang->line('an').' '.$this->lang->line('account') ?> ?
					</div>
					<a href="<?= base_url('sign-up') ?>" class="btn btn-block bg-bb-blue text-white"><?=  $this->lang->line('Sign_up') ?></a>
					<div class="d-flex justify-content-center links f-s-13">
						<a href="#" class=" d-none"><?=  $this->lang->line('Forgot_password') ?></a>
					</div>
				</div>
			</div>

			<div class="pt-2">
				<p class="text-muted text-center f-s-12 pt-5">
					© <?=date('Y')?> <a href="<?=base_url()?>">Bigb Soft</a>. <?=  $this->lang->line('All_rights_are_reserved') ?>
				</p>
			</div>
		</div>
	</div>
</div>


</div>

<script src="<?= base_url(); ?>public/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script !src="">
    function hideAlert() {
        $('#alert').addClass('d-none')
    }

    $(document).on('input', '.input', function () {
        hideAlert()
    });

    $(document).ready(function () {
        $('#form-login').on('submit', function (e) {
            e.preventDefault();

            const log_email = $('#log_email').val();
            const log_password = $('#log_password').val();
            $.ajax({
                type: 'POST',
                url: '<?= base_url('auth/login') ?>',
                dataType: "JSON",
                data: {'log_email': log_email, 'log_password': log_password},
                beforeSend: function () {
                    $("#loader-two").fadeIn();
                },
                success: function (data) {
                    $("#loader-two").fadeOut();
                    if (data.ok) {
                        window.location = '<?=base_url('home-sales')?>'
                    } else {
                        $('#alert').removeClass('d-none');
                        $('#message').text(data.message);
                    }
                }
            });
        })
    });

    $(document).ready(function () {
        $(".preloader").fadeOut();
        $(".preloader-2").fadeOut();
    });
</script>
</body>
</html>
