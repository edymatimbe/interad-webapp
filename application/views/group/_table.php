<?php $counter = 0; ?>
<?php if ($table == 'customer'): ?>
	<?php foreach ($groups as $group): ?>
		<?php $customers = count($this->core_model->get_all('customer', array('group_id' => $group->id))) ?>
		<tr class="text-nowrap">
			<td class="text-center"><?= $counter + 1 ?></td>
			<td class="f-w-700 text-agata">
				<span><?= $group->name ?></span>
			</td>
			<td class="text-center align-middle">
				<button class="btn btn-sm btn-primary text-center w-35">
					<span class="badge badge-counter  w-100"><?= $customers ?></span>
				</button>
			</td>

			<td class="text-center">
				<?php if ($group->active == 1): ?>
					<input checked class="toggle-switch" type="checkbox" value="0" data-id="<?= $group->id ?>"
						   data-table="customer_group">
				<?php else: ?>
					<input class="toggle-switch" value="1" type="checkbox" data-id="<?= $group->id ?>"
						   data-table="customer_group">
				<?php endif ?>
			</td>
			<td class="text-center px-2">
				<a title="<?= $this->lang->line('show') . ' ' . $this->lang->line('group') ?>"
				   class="btn btn-sm btn-outline-primary mr-2"
				   onclick="show_group(<?= $group->id ?>,'customer')">
					<i class="fa fa-eye">&nbsp;</i><?= $this->lang->line('show') ?>
				</a>

				<a title="<?= $this->lang->line('edit') . ' ' . $this->lang->line('group') ?>"
				   class="btn btn-sm btn-outline-secondary"
				   onclick="edit_group(<?= $group->id ?>,'customer')">
					<i class="fa fa-edit">&nbsp;</i><?= $this->lang->line('edit') ?>
				</a>
			</td>
		</tr>
		<?php $counter += 1; ?>
	<?php endforeach; ?>
<?php else: ?>
	<?php foreach ($groups as $group): ?>
		<?php $supplier = count($this->core_model->get_all('supplier', array('group_id' => $group->id))) ?>
		<tr class="text-nowrap">
			<td class="text-center"><?= $counter + 1 ?></td>
			<td class="f-w-700 text-agata">
				<span><?= $group->name ?></span>
			</td>
			<td class="text-center align-middle">
				<button class="btn btn-sm btn-primary text-center w-35">
					<span class="badge badge-counter  w-100"><?= $supplier ?></span>
				</button>
			</td>

			<td class="text-center">
				<?php if ($group->active == 1): ?>
					<input checked class="toggle-switch" type="checkbox" value="0" data-id="<?= $group->id ?>"
						   data-table="supplier_group">
				<?php else: ?>
					<input class="toggle-switch" value="1" type="checkbox" data-id="<?= $group->id ?>"
						   data-table="supplier_group">
				<?php endif ?>
			</td>
			<td class="text-center px-2">
				<a title="<?= $this->lang->line('show') . ' ' . $this->lang->line('group') ?>"
				   class="btn btn-sm btn-outline-primary mr-2"
				   onclick="show_group(<?= $group->id ?>,'supplier')">
					<i class="fa fa-eye">&nbsp;</i><?= $this->lang->line('show') ?>
				</a>

				<a title="<?= $this->lang->line('edit') . ' ' . $this->lang->line('group') ?>"
				   class="btn btn-sm btn-outline-secondary"
				   onclick="edit_group(<?= $group->id ?>,'supplier')">
					<i class="fa fa-edit">&nbsp;</i><?= $this->lang->line('edit') ?>
				</a>
			</td>
		</tr>
		<?php $counter += 1; ?>
	<?php endforeach; ?>
<?php endif; ?>

