<?php $this->load->view('layout/auth_header') ?>
<div class="row h-100 align-items-center">
	<div class="col-md-6 col-xl-7 col-sm-1 banner banner-signOut"></div>
	<div class="col-md-6 col-xl-5 col-sm-11">
		<div class="h-100 d-flex flex-column justify-content-between px-lg-4 px-md-2">
			<div class="my-auto px-4">
				<p class="text-center mt-0">
					<img src="<?= base_url(); ?>public\41\logo-sm.png" class="w-50" alt="Logo">
				</p>
				<form action="<?= base_url('auth/save'); ?>" id="form-register" class="w-100">

					<div class="row">
						<div class="col-md-6">
							<div class="inputBox form-group">
								<i class="feather icon-edit"></i>
								<input name="company" id="company" type="text" value="" data-message="message name">
								<label for="company"><?= $this->lang->line('name_company') ?><span class="text-danger">&nbsp;*</span></label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="inputBox form-group">
								<i class="feather icon-edit-1"></i>
								<input name="nuit" id="nuit" type="number" value="" data-message="message name">
								<label for="nuit">Nuit<span class="text-danger">&nbsp;*</span></label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="inputBox form-group">
								<i class="feather icon-user"></i>
								<input name="first_name" id="first_name" type="text" value="" data-message="message name">
								<label for="first_name"><?= $this->lang->line('name') ?><span class="text-danger">&nbsp;*</span></label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="inputBox form-group">
								<i class="feather icon-user"></i>
								<input name="last_name" id="last_name" type="text" value="" data-message="message name">
								<label for="last_name"><?= $this->lang->line('surname') ?><span class="text-danger">&nbsp;*</span></label>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-6">
							<div class="inputBox form-group">
								<i class="feather icon-phone-call"></i>
								<input name="phone" id="phone" type="text" value="" data-message="message name">
								<label for="phone"><?= 'Contacto' ?><span class="text-danger">&nbsp;*</span></label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="inputBox form-group">
								<i class="feather icon-phone-call"></i>
								<input name="phone2" id="phone2" type="text" value="" data-message="message name">
								<label for="phone2"><?= 'Contacto alternativo' ?><span class="text-danger">&nbsp;*</span></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="inputBox form-group">
								<i class="feather icon-stop-circle"></i>
								<input name="address" id="address" type="text" value="" data-message="message name">
								<label for="address">Enderenço<span class="text-danger">&nbsp;*</span></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="inputBox form-group">
								<i class="feather icon-mail"></i>
								<input name="email" id="email" type="email" value="" data-message="message name">
								<label for="email">Email<span class="text-danger">&nbsp;*</span></label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="inputBox form-group">
								<i class="feather icon-user-check"></i>
								<input name="username" id="username" type="text" value="" data-message="message name">
								<label for="username">Username<span class="text-danger">&nbsp;*</span></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="inputBox form-group">
								<i class="feather icon-lock"></i>
								<input name="password" id="password" type="password" value="" data-message="message name">
								<label for="password">Senha<span class="text-danger">&nbsp;*</span></label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="inputBox form-group">
								<i class="feather icon-lock"></i>
								<input name="confirm_password" id="confirm_password" type="password" value="" data-message="message name">
								<label for="confirm_password">Confirmar senha<span class="text-danger">&nbsp;*</span></label>
							</div>
						</div>
					</div>


					<button type="submit" class="btn btn-block bg-bb-blue text-white">
						<i class="feather icon-save mr-2"></i> <?= $this->lang->line('register_self') ?></label>
					</button>
				</form>
				<div class="pt-3">
					<a href="<?= base_url('auth') ?>" class="btn btn-block btn-primary text-white"> <i class="feather icon-arrow-left mr-2"></i><?= 'Voltar' ?></a>
				</div>
			</div>

			<div class="pt-5 px-5">
				<br>
				<br>
				<p class="text-muted text-center f-s-12">
					© <?= date('Y') ?> <a href="<?= base_url() ?>">41 BUSINESS CENTER</a>. <?= $this->lang->line('All_rights_are_reserved') ?>.
				</p>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-email" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header ftco-degree-bg">
				<button type="button" class="close d-flex align-items-center justify-content-center" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="feather icon-x"></span>
				</button>
			</div>
			<div class="modal-body pt-md-0 pb-md-5 text-center">
				<h2>Recebeste Email</h2>
				<div class="icon d-flex align-items-center justify-content-center">
					<img src="<?= base_url('public/img/email.svg') ?>" alt="" class="img-fluid">
				</div>
				<h4 class="mb-2"> <?= $this->lang->line('send_confirmation_emails') ?>:</h4>
				<h3 class="f-w-500" id="modal-email-text"></h3>
			</div>
		</div>
	</div>
</div>
<script !src="">
	function setErrorValidation(data) {
		$('.text-error').remove();
		$.each(data.error, function(key, value) {
			const query = 'input[name=' + key + ']';
			const parent = $(query).parent();
			const input = $(query);
			parent.after('<small id="error-' + key + '" class="form-text text-danger text-error mb-0 mb-lg-0">' +
				value + '</small>')
			input.on('input', function() {
				$('#error-' + key).remove();
			})
		});
	}

	$(document).on('submit', '#form-register', function(e) {
		e.preventDefault();
		const data = new FormData(this)


		Swal.fire({
			title: "Tens certeza?",
			text: "Confirmas a submissão",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#1e9d26",
			cancelButtonColor: "#d5162a",
			confirmButtonText: "Salvar"
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '<?= base_url('auth/save') ?>',
					type: 'POST',
					dataType: "JSON",
					data: data,
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: function() {
						show_loader()
					},
					success: function(data) {
						close_loader()
						if (data.status.toString() === 'success') {
							Swal.fire({
								title: "Formulario salvo com sucesso",
								text: "Em em breve receberá um email de validação do formulario",
								icon: "success"
							}).then((result) => {
								window.location = '<?= base_url('auth') ?>'
							})

						}
						if (data.status.toString() === 'error') {
							Swal.fire({
								title: "Error!!",
								text: "Erro ao salvar o formulário",
								icon: "error"
							});

						}
						if (data.status.toString() === 'error_validation') {
							setErrorValidation(data)
						}
					},
					error: function(xhr, status, error) {
						show_toast_warning('error')
						console.log('error')
					}
				})

			}

		});

	});

	// $('body').removeClass('bg-gray-200').addClass('bg-white')
	$(document).ready(function() {

		// $('#modal-email').modal('show')
	})
</script>
<?php $this->load->view('layout/auth_footer') ?>