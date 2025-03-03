<?php $this->load->view('layout/header') ?>

<?php //$this->load->view('layout/navbar') ?>

<?php if ($message = $this->session->flashdata('error')): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong><i class="fa fa-exclamation-triangle">&nbsp;</i><?= $message ?></strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
	</div>
<?php endif; ?>

<div id="company-content">
	<?php $this->load->view('company/_profile') ?>
</div>



<div class="modal fade" id="modal-image-company">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body bg-light p-lg-0">
				<div class="container-fluid" style="height: 490px">
					<h6 class="text-white text-center w-100 bg-dark-transparent-5 pt-sm-2 pb-sm-2 pr-sm-2"><i
							class="fa fa-photo"></i>&nbsp;Image
						<label class="close text-danger" data-dismiss="modal">&times;</label>
					</h6>

					<div id="div-cropper-company" class="m-0"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('layout/footer') ?>
