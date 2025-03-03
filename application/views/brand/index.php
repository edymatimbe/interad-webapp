<?php $this->load->view('layout/header') ?>


<div class="col-12 mb-3">
	<div class="row justify-content-between bg-white py-2 rounded">
		<div class="col-6 mb-lg-0 pt-2">
			<i class="feather icon-tag text-agata border-right pr-2 mr-2"></i>
			<label for="" class="text-capitalize"><?= $this->lang->line('brands') ?></label>
		</div>
	</div>
</div>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb bg-white shadow d-none">
		<li class="breadcrumb-item text-capitalize">
			<a href="<?= base_url('products') ?>">
				<i class="feather icon-tag border-right mr-1 pr-2"></i>
				<?=$this->lang->line('products')?>
			</a>
		</li>
		<li class="breadcrumb-item"><span><?= $title ?></span></li>
	</ol>
</nav>
<div class="card shadow mb-4">
	<div class="card-body">
		<div class="row mb-lg-2 d-flex justify-content-between">
			<div class="col-md-4">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text bg-white border-right-0 rounded-left"><i class="fa fa-search"></i></div>
					</div>
					<input type="text" class="form-control border-left-0" id="my-search" autocomplete="off" placeholder="<?=$this->lang->line('search')?>">
				</div>
			</div>
			<div class="col-md-3">
				<button class="btn btn-dark float-right br-2 text-nowrap"
						type="button" onclick="add_brand()">
					<i class="feather icon-plus">&nbsp;</i><?=$this->lang->line('add').' '.$this->lang->line('brand')?>
				</button>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table data-table" id="table-brand">
				<thead>
				<tr>
					<th class="text-center no-sort" style="width: 5%">#</th>
					<th style="width: 65%"><?=$this->lang->line('name')?></th>
					<th style="width: 10%" class="text-center text-capitalize"><?=$this->lang->line('products')?></th>
					<th style="width: 10%" class="text-center"><?=$this->lang->line('status')?></th>
					<th style="width: 10%" class="text-center"><?=$this->lang->line('actions')?></th>
				</tr>
				</thead>
				<tbody>
				<?php $this->load->view('brand/_table')?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="modal fade" id="modal-image-brand">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body bg-light p-lg-0">
				<div class="container-fluid" style="height: 490px">
					<h6 class="text-white text-center w-100 bg-dark-transparent-5 pt-sm-2 pb-sm-2 pr-sm-2"><i
								class="fa fa-photo"></i>&nbsp;<?= $this->lang->line('image') ?>
						<label class="close text-danger" data-dismiss="modal">&times;</label>
					</h6>

					<div id="div-cropper-brand" class="m-0"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script !src="">

	$('#menu-management').addClass('active pcoded-trigger');
	$('#menu-management .products').addClass('active');
	$('#menu-management .pcoded-submenu').css('display', 'block');
</script>
<?php $this->load->view('layout/footer') ?>
