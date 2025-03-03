<form id="form-brand" method="post" autocomplete="off" class="h-100">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title text-agata">
				<i class="feather icon-plus">&nbsp;</i><?= $this->lang->line('add') . ' ' . $this->lang->line('brand') ?>
			</h5>
		</div>
		<div class="modal-body bg-gray-200">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label for="name"><?=$this->lang->line('name')?></label>
								<input type="text" id="name" name="name" class="form-control" required>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 d-none">
					<div class="card">
						<div class="card-body py-4">
							<input type="hidden" id="image_data_brand" name="image">
							<input type="file" id="file_image_brand" class="d-none" accept="image/x-png,image/gif,image/jpeg" >
							<div class="d-flex justify-content-center my-3">
								<img class="shadow-sm img-to-upload"
									 src="<?= base_url('public/img/camera.png') ?>"
									 title="Click to change image" id="image_brand" alt="image" >
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" id="action" name="action" value="create">
		</div>
		<div class="modal-footer">
			<div class="d-flex justify-content-between w-100">
				<button type="button" class="btn btn-sm btn-secondary">
					<?= $this->lang->line('cancel') ?>
				</button>
				<button type="submit" class="btn btn-sm btn-success">
					<i class="feather icon-save">&nbsp;</i><?= $this->lang->line('save') ?>
				</button>
			</div>
		</div>
	</div>
</form>
