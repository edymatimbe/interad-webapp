<div class="modal-content">
	<div class="modal-header position-relative">
		<h5 class="modal-title text-info">
			<?= $this->lang->line('show') . ' ' . $this->lang->line('service') ?>
		</h5>
	</div>
	<div class="modal-body bg-gray-200">
		<div class="row mb-3">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-4">
								<h6 class="mb-0 f-w-600"><?= $this->lang->line('name') ?></h6>
							</div>
							<div class="col-sm-8 text-secondary">
								<?= $service->name ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<div class="d-flex justify-content-between w-100">
			<button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal">
				<?= $this->lang->line('cancel') ?>
			</button>
			<button type="button" class="btn btn-sm btn-outline-secondary"
					onclick="get_modal(<?= $service->id ?>,'service','small','edit')">
				<i class="fa fa-edit">&nbsp;</i><?= $this->lang->line('edit') ?>
			</button>
		</div>
	</div>
</div>
