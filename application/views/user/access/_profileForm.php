<form id="form-profile" autocomplete="off" class="h-100">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title text-micro">
				<?php if (isset($profile)): ?>
					<input type="hidden" name="action" value="update">
					<input type="hidden" name="id" value="<?= $profile->id ?>">
					<i class="feather icon-edit">&nbsp;</i><?=$this->lang->line('edit').' '.$this->lang->line('profile')?>
				<?php else: ?>
					<i class="feather icon-plus">&nbsp;</i><?=$this->lang->line('add').' '.$this->lang->line('profile')?>
					<input type="hidden" name="action" value="create">
				<?php endif; ?>
			</h5>
		</div>
		<div class="modal-body bg-gray-200">
			<div class="card mb-3">
				<div class="card-body pb-1">
					<div class="form-group">
						<label for="name"><?=$this->lang->line('name')?></label>
						<input type="text" class="form-control" id="name" name="name" value="<?=isset($profile)?$profile->name:''?>">
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<div class="d-flex justify-content-between w-100">
				<button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal">
					<i class="fa fa-arrow-left">&nbsp;</i><?= $this->lang->line('cancel') ?>
				</button>
				<button type="submit" class="btn btn-sm btn-success" id="btn-modal-submit">
					<i class="feather icon-save">&nbsp;</i><?= $this->lang->line('save') ?>
				</button>
			</div>
		</div>
	</div>
</form>
