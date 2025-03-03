<div class="card-header">
	<h6 class="">
		<i class="feather icon-filter">&nbsp;</i>
		<?= $this->lang->line('unit_measurement') ?>
	</h6>
</div>
<div class="card-body pb-0">
	<div class="row">
		<div class="col-md-6">
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
					<tr>
						<th style="width: 10%"><?= $this->lang->line('unit') ?></th>
						<th style="width: 70%"><?= $this->lang->line('description') ?></th>

						<th style="width: 20%"></th>
					</tr>
					</thead>
					<tbody>
					<?php $counter = 1 ?>
					<?php foreach ($this->core_model->get_all('unit_measurement') as $item): ?>
						<tr>
							<td><?= $item->unit ?></td>
							<td><?= $item->description ?></td>
							<td class="text-center">
								<a href="#!"><i
											class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a>
								<a href="#!"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
							</td>
						</tr>
						<?php $counter += 1 ?>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card shadow-none border">
				<div class="card-header">
					<h6 class="card-title mb-0">
						<i class="feather icon-plus">&nbsp;</i>
						<?= $this->lang->line('new2') . ' '.$this->lang->line('unit_measurement') ?>
					</h6>
				</div>
				<div class="card-body pb-0">
					<div class="row">
						<div class="col-md-12 form-group">
							<label for="unit"><?= $this->lang->line('unit') ?> <span
										class="text-danger">&nbsp;*</span></label>
							<input type="text" id="unit" name="unit" class="form-control f-s-13" required>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 form-group">
							<label for="description"><?= $this->lang->line('description') ?><span
										class="text-danger">&nbsp;*</span></label>
							<input type="text" id="description" name="description"
								   class="form-control f-s-13">
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-sm btn-outline-success float-right">
						<i class="feather icon-save mr-2"></i>
						<?= $this->lang->line('save') ?>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
