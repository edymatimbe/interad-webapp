<form id="form-bank" method="post" autocomplete="off" class="h-100">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title text-agata">
				<i class="feather icon-plus">&nbsp;</i><?= $this->lang->line('edit') . ' ' . $this->lang->line('bank_account') ?>
			</h5>
		</div>
		<div class="modal-body bg-gray-200">
			<div class="row">
				<div class="col-lg-12 mb-3">
					<div class="card mb-4">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 form-group">
									<label for="name"><?= $this->lang->line('name') ?> <span
												class="text-danger">&nbsp;*</span></label>
									<input type="text" id="name" name="name" class="form-control" required value="<?=$bank->name?>">
								</div>
							</div>

							<div class="row">
								<div class="col-md-12 form-group">
									<label for="number"><?= $this->lang->line('number') ?><span
												class="text-danger">&nbsp;*</span></label>
									<input type="text" id="number" name="number" class="form-control" value="<?=$bank->number?>" required>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" id="action" name="action" value="update">
			<input type="hidden" id="action" name="id" value="<?=$bank->id?>">
		</div>
		<div class="modal-footer">
			<div class="d-flex justify-content-between w-100">
				<button type="button" class="btn btn-sm btn-secondary">
					<?= $this->lang->line('cancel') ?>
				</button>
				<button type="submit" class="btn btn-sm btn-success">
					<i class="feather icon-save">&nbsp;</i><?= $this->lang->line('update') ?>
				</button>
			</div>
		</div>
	</div>
</form>
