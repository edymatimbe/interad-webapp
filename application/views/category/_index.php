<div class="card shadow mb-4">
	<div class="card-body">
		<div class="row mb-lg-2 d-flex justify-content-between">
			<div class="col-md-4">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text bg-white border-right-0 rounded-left"><i class="fa fa-search"></i>
						</div>
					</div>
					<input type="text" class="form-control border-left-0" id="my-search" autocomplete="off"
						   placeholder="<?= $this->lang->line('search') ?>">
				</div>
			</div>
			<div class="col-md-3">
				<button class="btn btn-dark float-right br-2 text-nowrap"
						type="button" onclick="add_category()">
					<i class="feather icon-plus">&nbsp;</i><?= $this->lang->line('add') . ' ' . $this->lang->line('category') ?>
				</button>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered data-table" id="table-category">
				<thead>
				<tr>
					<th class="text-center no-sort" style="width: 5%">#</th>
					<th style="width: 25%"><?= $this->lang->line('name') ?></th>
					<th style="width: 25%"><?= $this->lang->line('parent_category') ?></th>
					<?php if ($is_service == 1): ?>
						<th style="width: 10%"><?= 'Monstrar na factura' ?></th>
					<?php endif; ?>
					<th style="width: 10%" class="text-center text-capitalize">
						<?php if ($is_service == 0): ?>
							<?= $this->lang->line('products') ?>
						<?php else: ?>
							<?= $this->lang->line('services') ?>
						<?php endif; ?>
					</th>
					<th style="width: 10%" class="text-center"><?= $this->lang->line('status') ?></th>
					<th style="width: 15%" class="text-center"><?= $this->lang->line('actions') ?></th>
				</tr>
				</thead>
				<tbody>
				<?php $this->load->view('category/_table') ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
