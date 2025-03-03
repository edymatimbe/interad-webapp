<?php $this->load->view('layout/header') ?>


<nav aria-label="breadcrumb">
	<ol class="breadcrumb bg-white shadow">
		<li class="breadcrumb-item"><a href="<?= base_url('home') ?>"><i class="fa fa-home">&nbsp;</i>Home</a></li>
		<li class="breadcrumb-item"><span>Sistema</span></li>
	</ol>
</nav>


<?php if ($message = $this->session->flashdata('error')): ?>

	<div class="row d-none">
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

<div class="row">
	<div class="col-md-3">
		<!--		<div class="card">-->
		<div class="stickyside" id="topMenu">
			<div class="list-group">
				<a href="#account" class="list-group-item list-group-item-action active py-3">
					<i class="feather icon-settings">&nbsp;</i><?= $this->lang->line('account') ?>
				</a>
				<a href="#notification" class="list-group-item list-group-item-action">
					<i class="feather icon-bell">&nbsp;</i><?= $this->lang->line('notifications') ?>
				</a>
				<a href="#message" class="list-group-item list-group-item-action">
					<i class="feather icon-message-circle">&nbsp;</i><?= $this->lang->line('sys_message') ?>
				</a>
				<a href="#theme" class="list-group-item list-group-item-action d-none">
					<i class="feather icon-image">&nbsp;</i><?= $this->lang->line('theme') ?>
				</a>
				<a href="#bank-account" class="list-group-item list-group-item-action d-none">
					<i class="feather icon-image">&nbsp;</i><?= $this->lang->line('bank_accounts') ?>
				</a>
				<a href="#language" class="list-group-item list-group-item-action d-none">
					<i class="feather icon-flag">&nbsp;</i><?= $this->lang->line('language').' '.$this->lang->line('and').' '.$this->lang->line('currency') ?>
				</a>
				<a href="#sale" class="list-group-item list-group-item-action d-none">
					<i class="feather icon-shopping-cart">&nbsp;</i><?= $this->lang->line('sale_cart') ?>
				</a>
				<a href="#unit_measurement" class="list-group-item list-group-item-action d-none">
					<i class="feather icon-filter">&nbsp;</i><?= $this->lang->line('unit_measurement') ?>
				</a>
			</div>
		</div>
		<!--		</div>-->
	</div>

	<div class="col-md-9">
		<div id="account" class="card shadow mb-4">
			<?php $this->load->view('settings/_account') ?>
		</div>
		<div id="notification" class="card shadow mb-4">
			<?php $this->load->view('settings/_notification') ?>
		</div>
		<div id="message" class="card shadow mb-4">
			<?php $this->load->view('settings/_message') ?>
		</div>
		<div id="theme" class="card shadow mb-4">
<!--			--><?php //$this->load->view('settings/_theme') ?>
		</div>
		<div id="bank-account" class="card shadow mb-4 d-none">
			<?php $this->load->view('settings/_bank') ?>
		</div>
		<div id="language" class="card shadow mb-4 d-none">
			<?php $this->load->view('settings/_language') ?>
		</div>
		<div id="sale" class="card shadow mb-4 d-none">
			<?php $this->load->view('settings/_sale') ?>
		</div>
		<div id="unit_measurement" class="card shadow mb-4 d-none">
			<?php $this->load->view('settings/_unit_measurement') ?>
		</div>
		<div class="h" style="height: 950px;"></div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#topMenu .list-group-item').addClass('py-3')
	})
</script>


<div class="modal fade" id="modal-image-company">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body bg-light p-lg-0">
				<div class="container-fluid" style="height: 490px">
					<h6 class="text-white text-center w-100 bg-dark-transparent-5 pt-sm-2 pb-sm-2 pr-sm-2"><i
							class="fa fa-photo"></i>&nbsp;Image
								class="fa fa-photo"></i>&nbsp;<?= $this->lang->line('image') ?>
						<label class="close text-danger" data-dismiss="modal">&times;</label>
					</h6>

					<div id="div-cropper-company" class="m-0"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('layout/footer') ?>
