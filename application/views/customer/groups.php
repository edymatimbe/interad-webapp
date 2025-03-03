<?php $this->load->view('layout/header') ?>


<div class="col-12 mb-3">
	<div class="row justify-content-between bg-white py-2 rounded">
		<div class="col-6 mb-lg-0 pt-2">
			<i class="feather icon-users text-agata border-right pr-2"></i>
			<label for=""><?= $this->lang->line('menu_customer') ?></label>
		</div>
		<div class="col-6">
		</div>
	</div>
</div>

<div class="mb-4">
	<ul class="nav nav-pills shadow rounded" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a id="link-history-category" class="nav-link py-3 link-history" href="<?=base_url('customers')?>">
				<i class="feather icon-users mr-2"></i><?=$this->lang->line('menu_customer')?>
			</a>
		</li>
		<li class="nav-item">
			<a id="link-history-category" class="nav-link active py-3 link-history" href="<?=base_url('customers-groups')?>">
				<i class="feather icon-layers mr-2"></i><?=$this->lang->line('menu_customer_group')?>
			</a>
		</li>
	</ul>
</div>

<div class="card shadow mb-4">
	<div class="card-body">
		<div class="row mb-lg-2 d-flex justify-content-between">
			<div class="col-md-4">
				<div class="input-group mb-2">
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text bg-white border-right-0"><i class="fa fa-search"></i></div>
						</div>
						<input type="text" class="form-control border-left-0" id="my-search" autocomplete="off" placeholder="<?=$this->lang->line('search')?>">
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<button class="btn btn-dark float-right br-2"
						type="button" onclick="add_group('customer')">
					<i class="feather icon-plus">&nbsp;</i><?=$this->lang->line('add').' '.$this->lang->line('group')?>
				</button>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table data-table" id="table-group">
				<thead>
				<tr>
					<th class="text-center no-sort" style="width: 5%">#</th>
					<th style="width: 65%"><?=$this->lang->line('name')?></th>
					<th style="width: 10%" class="text-center text-capitalize"><?=$this->lang->line('customers')?></th>
					<th style="width: 10%" class="text-center"><?=$this->lang->line('status')?></th>
					<th style="width: 10%" class="text-center"><?=$this->lang->line('actions')?></th>
				</tr>
				</thead>
				<tbody>
				<?php $this->load->view('group/_table') ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<input type="hidden" id="table" value="<?=$table?>">

<script !src="">
	$('#menu-management').addClass('active pcoded-trigger');
	$('#menu-management .customers').addClass('active');
	$('#menu-management .pcoded-submenu').css('display', 'block');
</script>


<?php $this->load->view('layout/footer') ?>
