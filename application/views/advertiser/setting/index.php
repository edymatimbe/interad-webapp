<?php $this->load->view('layout/public/header'); ?>

<!-- Page body -->
<form  id="form-perfil" class="w-100">
    <input type="hidden" name="id" value="<?= $user->id ?>">
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="row g-0">
                <div class="col d-flex flex-column">
                    <div class="card-body">
                        <h3 class="card-title">Perfil do cliente</h3>
                        <div class="col-md-12 col-xl-12 border-bottom">
                            <a class="card card-link" href="#">
                                <div class="card-cover card-cover-blurred text-center" style="background-image: url(<?= base_url('public/assets/web/static/photos/tropical-palm-leaves-floral-pattern-background.jpg') ?>)">
                                    <span class="avatar avatar-xl avatar-thumb rounded" style="background-image: url(<?= $user->image == null ? base_url('public/img/avatar/avatar.svg') : base_url($user->image); ?>)"></span>
                                </div>
                                <div class="row align-items-center text-center">

                                    <div class="col-auto"><a href="#" class="btn btn-primary btn-square w-100">
                                            <i class="feather icon-image mr-2"></i> &nbsp;&nbsp; Adicionar foto de perfil
                                        </a></div>

                                </div>
                                <div class="card-body text-center">
                                    <div class="card-title mb-1"><?= $user->first_name . ' ' . $user->last_name ?></div>
                                    <div class="text-muted"><i class="feather icon-home mr-2"></i> <?= $user->company ?></div>
                                </div>
                            </a>
                        </div>

                        <div class="row g-3 mb-2">
                            <div class="col-md">
                                <div class="form-label"> Empresa</div>
                                <input type="text" class="form-control" value="<?= $user->company ?>" name="company" readonly>
                            </div>
                            <div class="col-md">
                                <div class="form-label">Nome</div>
                                <input type="text" class="form-control" value="<?= $user->first_name ?>" name="first_name">
                            </div>
                            <div class="col-md">
                                <div class="form-label">Apelido</div>
                                <input type="text" class="form-control" value="<?= $user->last_name ?>" name="last_name">
                            </div>
                        </div>
                        <div class="row g-3 mb-2">
                            <div class="col-md-4">
                                <div class="form-label"> Nuit</div>
                                <input type="number" class="form-control" value="<?= $user->nuit ?>" name="nuit" >
                            </div>
                            <div class="col-md-8">
                                <div class="form-label">Enderneço</div>
                                <input type="text" class="form-control" value="<?= $user->address ?>" name="address">
                            </div>
                        </div>
                        <div class="row g-3 mb-2">
                            <div class="col-md">
                                <div class="form-label"> Email</div>
                                <input type="email" class="form-control" value="<?= $user->email ?>" name="email" >
                            </div>
                            <div class="col-md">
                                <div class="form-label">Contacto</div>
                                <input type="number" class="form-control" value="<?= $user->phone ?>" name="phone">
                            </div>
                            <div class="col-md">
                                <div class="form-label">Contacto alternativo</div>
                                <input type="number" class="form-control" name="phone2" value="<?= $user->phone2 ?>">
                            </div>
                        </div>

                        
                        <div class="row g-3">
                            <div class="col-md">
                                <div class="form-label"> Username</div>
                                <input type="text" class="form-control" value="<?= $user->username ?>" name="username">
                            </div>
                            <div class="col-md">
                                <div class="form-label">Password</div>
                                <input type="password" class="form-control" value="" name="password">
                            </div>
                            <div class="col-md">
                                <div class="form-label">Confirmar password</div>
                                <input type="password" class="form-control" name="confirm_password" >
                            </div>
                        </div>

                    </div>
                    <div class="card-footer bg-transparent mt-auto">
                        <div class="btn-list justify-content-end">
                           
                            <button type="submit" class="btn btn-success btn-square w-25">
                                salvar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<?php $this->load->view('layout/public/footer'); ?>
<script !src="">
	$(document).on('submit', '#form-perfil', function(e) {
		e.preventDefault();
		const data = new FormData(this)


		Swal.fire({
			title: "Tens certeza?",
			text: "Actualizar os dados do perfil",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#1e9d26",
			cancelButtonColor: "#d5162a",
			confirmButtonText: "Salvar"
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '<?= base_url('public/advertiser/save_profile') ?>',
					type: 'POST',
					dataType: "JSON",
					data: data,
					cache: false,
					contentType: false,
					processData: false,
					success: function(data) {
						if (data.status.toString() === 'success') {
							// setTimeout(function() {
								Swal.fire({
									title: "sucesso",
									text: data.message,
									icon: "success"
								}).then((result) => {
                                    window.location = '<?= base_url('profile-ads') ?>'
                                });
							// }, 2000)

							

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