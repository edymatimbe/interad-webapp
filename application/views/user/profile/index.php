<?php $this->load->view('layout/header') ?>


<?php //$this->load->view('layout/navbar') ?>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb bg-white shadow">
		<li class="breadcrumb-item">
			<a class="text-capitalize" href="<?= base_url('profile') ?>">
				<i class="fa fa-address-card">&nbsp;</i><span><?=$this->lang->line('my')?></span>
				<span class="text-lowercase"><?= $title ?></span>
			</a>
		</li>
	</ol>
</nav>

<div class="row" id="div-profile-content">
	<?php $this->load->view('user/profile/_profile')?>
</div>


<div id="modal-user" class="modal fixed-left fade" tabindex="-1" role="dialog" data-backdrop="static">
	<button id="btn-close-modal" class="btn btn-lg bg-white position-absolute" data-dismiss="modal">
		<i class="fa fa-close"></i>
	</button>
	<div class="modal-dialog modal-dialog-aside" role="document" id="modal-user-content">
	</div>
</div>

<?php $this->load->view('layout/footer') ?>
