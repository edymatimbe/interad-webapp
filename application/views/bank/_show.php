<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title text-agata"><?= $this->lang->line('show') . ' ' . $this->lang->line('bank_account') ?>
		</h5>
	</div>
	<div class="modal-body bg-gray-200">

		<div class="card  border-0 shadow-sm">
			<div class="card-body border-0">
				<div class="row">
					<div class="col-sm-4">
						<h6 class="mb-0 f-w-600"><?= $this->lang->line('name') ?></h6>
					</div>
					<div class="col-sm-8 text-secondary">
						<?= $bank->name ?>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-sm-4">
						<h6 class="mb-0 f-w-600"><?= $this->lang->line('phone') ?></h6>
					</div>
					<div class="col-sm-8 text-secondary">
						<?= $bank->number ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<div class="d-flex justify-content-between w-100">
			<button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal">
				<i class="fa fa-arrow-left">&nbsp;</i><?= $this->lang->line('cancel') ?>
			</button>
		</div>
	</div>
</div>
