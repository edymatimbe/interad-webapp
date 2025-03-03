<form id="form-group" method="post" autocomplete="off" class="h-100">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title text-agata">
				<i class="feather icon-plus">&nbsp;</i><?= $this->lang->line('add') . ' ' . $this->lang->line('group') ?>
			</h5>
		</div>
		<div class="modal-body bg-gray-200">
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<label for="name"><?= $this->lang->line('name') ?><span class="text-danger">&nbsp;*</span></label>
						<input type="text" id="name" name="name" class="form-control" required>
					</div>
					<input type="hidden" id="action" name="action" value="create">
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<div class="d-flex justify-content-between w-100">
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
					<?= $this->lang->line('cancel') ?>
				</button>
				<button type="submit" class="btn btn-sm btn-success">
					<i class="feather icon-save">&nbsp;</i><?= $this->lang->line('save') ?>
				</button>
			</div>
		</div>
	</div>
</form>
