<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title text-agata">
			<?= $this->lang->line('show') . ' ' . $this->lang->line('brand') ?>
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
								<?= $brand->name ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-4">
								<h6 class="mb-0 f-w-600"><?= $this->lang->line('menu_product') ?></h6>
							</div>
							<div class="col-sm-8 text-secondary">
								<?= count($products) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 d-none">
				<div class="card">
					<div class="card-body py-4">
						<input type="hidden" id="image_data_store" name="image">
						<input type="file" id="file_image_store" class="d-none"
							   accept="image/x-png,image/gif,image/jpeg">
						<div class="d-flex justify-content-center mt-3">

						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-header">
				<h6 class="card-text text-capitalize">
					<i class="fa fa-tags">&nbsp;</i><?= $this->lang->line('products') ?>
				</h6>
			</div>
			<div class="card-body">
				<table class="table" id="table-brand-products">
					<thead>
					<tr>
						<th style="width: 5%">#</th>
						<th style="width: 85%"><?= $this->lang->line('description') ?></th>
					</tr>
					</thead>
					<tbody>
					<?php $counter = 0; ?>
					<?php foreach ($products as $product): ?>
						<tr>
							<td><?= $counter + 1 ?></td>
							<td><?= $product->name ?></td>
						</tr>
						<?php $counter += 1; ?>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php if ($this->ion_auth->in_group(array('admin', 'super admin'))): ?>
			<div class="card mt-3">
				<div class="card-header">
					<h6 class="card-text text-gray-600 f-w-600 text-capitalize">
						<i class="fa fa-info">&nbsp;</i>
						<?= $this->lang->line('details') ?>
					</h6>
				</div>
				<div class="card-body pt-0">
					<ul class="list-group list-group-flush">
						<li class="list-group-item px-lg-0">
							<span class="f-w-600 field"><?= $this->lang->line('created_at') ?>:</span>
							<span class="value float-right"><?= date_format(date_create($brand->created_at), 'd-m-Y H:i') ?></span>
						</li>
						<li class="list-group-item px-lg-0">
							<span class="f-w-600 field"><?= $this->lang->line('updated_at') ?>:</span>
							<span class="value float-right"><?= date_format(date_create($brand->updated_at), 'd-m-Y H:i') ?></span>
						</li>
						<li class="list-group-item px-lg-0">
							<span class="f-w-600 field"><?= $this->lang->line('created_by') ?>:</span>
							<span class="value float-right"><?= $this->core_model->get_by_id('users', array('id' => $brand->created_by))->first_name ?></span>
						</li>
						<li class="list-group-item px-lg-0">
							<span class="f-w-600 field"><?= $this->lang->line('updated_by') ?>:</span>
							<span class="value float-right"><?= $this->core_model->get_by_id('users', array('id' => $brand->created_by))->first_name ?></span>
						</li>
					</ul>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="modal-footer">
		<div class="d-flex justify-content-between w-100">
			<button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal">
				<i class="fa fa-arrow-left">&nbsp;</i><?= $this->lang->line('cancel') ?>
			</button>

			<button type="button" onclick="edit_brand(<?=$brand->id?>)" class="btn btn-sm btn-outline-secondary">
				<i class="fa fa-edit">&nbsp;</i><?= $this->lang->line('edit') ?>
			</button>
		</div>
	</div>
</div>
