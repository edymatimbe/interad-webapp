<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title text-agata"><i class="fa fa-tag">&nbsp;</i> <?= $group->name ?></h5>
	</div>
	<div class="modal-body bg-gray-200">
		<?php if ($table == 'customer'): ?>
				<div class="card">
					<div class="card-header">
						<h6 class="card-text text-capitalize">
							<i class="fa fa-users">&nbsp;</i><?= $this->lang->line('customers') ?>
						</h6>
					</div>
					<div class="card-body">
						<table class="table" id="table-sm">
							<thead>
							<tr>
								<th style="width: 5%">#</th>
								<th style="width: 85%"><?= $this->lang->line('name') ?></th>
							</tr>
							</thead>
							<tbody>
							<?php $counter = 0; ?>
							<?php foreach ($customers as $customer): ?>
								<tr>
									<td><?= $counter + 1 ?></td>
									<td class="pl-2"><?= $customer->name ?></td>
								</tr>
								<?php $counter += 1; ?>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
		<?php endif; ?>
		<?php if ($table == 'supplier'): ?>
			<div class="card">
				<div class="card-header">
					<h6 class="card-text text-capitalize">
						<i class="fa fa-users">&nbsp;</i><?= $this->lang->line('suppliers') ?>
					</h6>
				</div>
				<div class="card-body">
					<table class="table" id="table-sm">
						<thead>
						<tr>
							<th style="width: 5%">#</th>
							<th style="width: 85%"><?= $this->lang->line('name') ?></th>
						</tr>
						</thead>
						<tbody>
						<?php $counter = 0; ?>
						<?php foreach ($suppliers as $supplier): ?>
							<tr>
								<td><?= $counter + 1 ?></td>
								<td class="pl-2"><?= $supplier->name ?></td>
							</tr>
							<?php $counter += 1; ?>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
