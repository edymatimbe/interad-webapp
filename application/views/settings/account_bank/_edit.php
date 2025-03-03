<form id="form-bank_account" method="post" autocomplete="off" class="h-100">
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
									<label for="name"><?= $this->lang->line('bank') ?> <span class="text-danger">&nbsp;*</span></label>
									<select name="bank_id" id="bank" class="form-control">
										<?php foreach ($banks as $bank) :  ?>
											<option value="<?= $bank->id ?>" <?= $bank->id == $account->bank_id?'selected': ''  ?>><?= $bank->name ?></option>
										<?php endforeach;  ?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<label for="owner">titular <span class="text-danger">&nbsp;*</span></label>
									<input type="text" id="owner" value="<?=  $account->owner  ?>" name="owner" class="form-control" required>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<label for="number">Numero da conta <span class="text-danger">&nbsp;*</span></label>
									<input type="text" id="number"  value="<?=  $account->number  ?>" name="number" class="form-control" required>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<label for="nib">NIB <span class="text-danger">&nbsp;*</span></label>
									<input type="text" id="nib"  value="<?=  $account->nib  ?>" name="nib" class="form-control" required>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

			<input type="hidden" id="action" name="action" value="update">
			<input type="hidden" value="<?= $account->id ?>" name="id">
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
