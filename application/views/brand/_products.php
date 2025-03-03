<div class="card">
	<div class="card-header">
		<h6 class="card-text text-gray-600 f-w-600"><i class="fa fa-box-open">&nbsp;</i><?= $this->lang->line('product') ?></h6>
	</div>
	<div class="card-body">
		<div class="table-responsive bg-white pb-lg-0 pb-0">
			<table class="table table-striped mb-lg-0 mb-0">
				<thead>
				<tr>
					<th class="text-center no-sort" style="width: 5%">#</th>
					<th><?= $this->lang->line('name') ?></th>
				</tr>
				</thead>
				<tbody>
				<?php $counter = 0; foreach ($products as $product): ?>
					<tr>
						<td class="text-center"><?= $counter+1 ?></td>
						<td><?= $product->name ?></td>
					</tr>
				<?php $counter += 1; endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
