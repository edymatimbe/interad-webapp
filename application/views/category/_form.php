<form id="form-category" method="post" autocomplete="off" class="h-100">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title text-agata">
				<?php if (isset($category)) : ?>
					<input type="hidden" name="id" value="<?= $category->id ?>">
					<input type="hidden" id="action" name="action" value="update">
					<i class="feather icon-edit mr-2"></i><?= $this->lang->line('edit') . ' ' . $this->lang->line('category') ?>
				<?php else : ?>
					<input type="hidden" id="action" name="action" value="create">
					<i class="feather icon-plus mr-2"></i><?= $this->lang->line('add') . ' ' . $this->lang->line('category') ?>
				<?php endif; ?>
			</h5>
		</div>
		<div class="modal-body bg-gray-200">
			<div class="row">
				<div class="col-lg-8">
					<div class="card">
						<div class="card-header d-none">
							<h6 class="card-text"><i class="fa fa-tag">&nbsp;</i><?= $this->lang->line('category') . ' ' . $this->lang->line('of') . ' ' . $this->lang->line('product') ?>
							</h6>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="name"><?= $this->lang->line('name') ?></label>
								<input type="text" id="name" name="name" class="form-control" required value="<?= isset($category) ? $category->name : '' ?>">
							</div>

							<?php if (is_service() == 1) : ?>
								<fieldset class="alert alert-light border mt-4 mb-4 pt-1 d-flex justify-content-between">
									<legend class="f-s-13 mb-0">Monstrar a soma dos valores dos serviços na factura?</legend>
									<label class="custom-radio-input">
										<input type="radio" name="in_invoice" value="0" <?= isset($category) ? $category->in_invoice == 0 ? 'checked' : '' : 'checked' ?>>
										<span class="check-mark"></span>
										<span>Não</span>
									</label>
									<label class="custom-radio-input">
										<input type="radio" name="in_invoice" value="1" <?= isset($category) ? $category->in_invoice == 1 ? 'checked' : '' : '' ?>>
										<span class="check-mark"></span>
										<span>SIM</span>
									</label>
								</fieldset>
							<?php endif; ?>

							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="is-sub-category" <?= isset($category) ? ($category->parent_id ? 'checked' : '') : '' ?>>
								<label class="custom-control-label" for="is-sub-category">É Sub categoria</label>
							</div>
							<div class="form-group <?= isset($category) ? ($category->parent_id ? '' : 'd-none') : 'd-none' ?>" id="div-parent-category">
								<br>
								<label for="parent_id" class="text-capitalize"><?= $this->lang->line('category') ?></label>
								<select name="parent_id" class="form-control" id="parent_id" style="width: 100%">
									<option value=""><?= $this->lang->line('select') ?></option>
									<?php foreach ($this->core_model->get_all('category', ['is_service' => is_service()]) as $category) : ?>
										<option value="<?= $category->id ?>"><?= $category->name ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body py-4">
							<input type="hidden" id="image_data_category" name="image">
							<input type="file" id="file_image_category" class="d-none" accept="image/x-png,image/gif,image/jpeg">
							<div class="d-flex justify-content-center my-3">
								<?php if (isset($category)) : ?>
									<?php if ($category->image) : ?>
										<?php if (is_file(FCPATH . $category->image)) : ?>
											<img class="shadow-sm img-to-upload" width="110" src="<?= base_url($category->image) ?>" alt="image" id="image_category">
										<?php else : ?>
											<img class="shadow-sm img-to-upload" width="110" src="<?= base_url('public/img/camera.png') ?>" alt="image" id="image_category">
										<?php endif; ?>
									<?php else : ?>
										<img class="shadow-sm img-to-upload" width="110" src="<?= base_url('public/img/camera.png') ?>" alt="image" id="image_category">
									<?php endif; ?>
								<?php else : ?>
									<img class="shadow-sm img-to-upload" src="<?= base_url('public/img/camera.png') ?>" title="Click to change image" id="image_category" alt="image">
								<?php endif; ?>
							</div>
						</div>
					</div>
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