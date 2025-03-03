<?php $this->load->view('layout/header') ?>

<?php //$this->load->view('layout/navbar') 
?>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb bg-white shadow">
		<li class="breadcrumb-item"><a href="<?= base_url('bank-accounts') ?>"><i class="fa fa-credit-card-alt">&nbsp;</i><?= $title ?></a></li>
	</ol>
</nav>

<div class="card shadow mb-4">
	<div class="card-body">
		<div class="row mb-lg-2 d-flex justify-content-between">
			<div class="col-md-4">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fa fa-search"></i></div>
					</div>
					<input type="text" class="form-control" id="my-search" autocomplete="off" placeholder="<?= $this->lang->line('search') ?>">
				</div>
			</div>
			<div class="col-md-3">
				<button class="btn btn-dark float-right br-2" type="button" onclick="add_bank()">
					<i class="feather icon-plus">&nbsp;</i><?= $this->lang->line('add') . ' ' . $this->lang->line('bank_account') ?>
				</button>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table data-table" id="table-bank_account">
				<thead>
					<tr>
						<th class="text-center no-sort" style="width: 5%">#</th>
						<th style="width: 15%">Banco</th>
						<th style="width: 25%">Titular da conta</th>
						<th style="width: 10%" class="text-center">Numero da conta</th>
						<th style="width: 15" class="text-center">NIB</th>
						<th style="width: 10%" class="text-center"><?= $this->lang->line('status') ?></th>
						<th style="width: 10%" class="text-center"><?= $this->lang->line('actions') ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $this->load->view('settings/account_bank/_table') ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>

</script>
<?php $this->load->view('layout/footer') ?>
