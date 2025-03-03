<?php $counter = 0; ?>
<?php foreach ($customers as $customer): ?>
	<tr>
		<td class="text-center"><?= $counter + 1 ?></td>
		<td>
			<?php if ($customer->image): ?>
				<?php if (is_file(FCPATH . $customer->image)): ?>
					<img class="my-border-radius shadow-sm" width="40" src="<?= base_url($customer->image) ?>"
						 alt="image" id="image_table_<?= $customer->image ?>">
				<?php else: ?>
					<img class="my-border-radius shadow-sm" width="40"
						 src="<?= base_url('public/img/camera.png') ?>" alt="image"
						 id="image_table_<?= $customer->image ?>">
				<?php endif; ?>
			<?php else: ?>
				<img class="my-border-radius shadow-sm" width="40"
					 src="<?= base_url('public/img/camera.png') ?>" alt="image" id="image_table_<?= $customer->image ?>">
			<?php endif; ?>

			<span class="text-agata f-w-700 cursor-pointer pl-3 text-nowrap"
				  onclick="show_customer(<?= $customer->id ?>)">
				<?= $customer->name ?>
			</span>
		</td>
		<td class="text-capitalize">
			<?= $customer->type ?>
		</td>
		<td class="text-capitalize">
			<?= $customer->group_id?$this->core_model->get_by_id('customer',array('id'=>$customer->group_id))->name:'' ?>
		</td>
		<td><?= $customer->phone ?></td>
		<td><?= $customer->email ?></td>
		<td class="text-center">
			<span class="badge badge-info w-75 py-2">
				<?= count($this->core_model->get_all('sale', array('customer_id' => $customer->id))) ?>
			</span>
		</td>
		<td class="text-center">
			<?php if ($customer->active == 1): ?>
				<input checked class="toggle-switch" type="checkbox" value="0" data-id="<?= $customer->id ?>"
					   data-table="customer">
			<?php else: ?>
				<input class="toggle-switch" value="1" type="checkbox" data-id="<?= $customer->id ?>"
					   data-table="customer">
			<?php endif ?>
		</td>
		<td>
			<p class="text-center m-0 p-0 px-2 text-nowrap">
				<button onclick="show_customer(<?= $customer->id ?>)"
						title="<?= $this->lang->line('show') ?> <?= $this->lang->line('customer') ?>"
						class="btn btn-sm btn-outline-primary mr-2">
					<i class="fa fa-eye">&nbsp;</i><?= $this->lang->line('show') ?>
				</button>
				<a onclick="edit_customer(<?= $customer->id ?>)"
				   title="<?= $this->lang->line('edit') ?> <?= $this->lang->line('customer') ?>"
				   class="btn btn-sm btn-outline-secondary px-2"><i class="fa fa-edit"
																	aria-hidden="true"></i>&nbsp;<?= $this->lang->line('edit') ?>
				</a>
			</p>
		</td>
	</tr>
	<?php $counter += 1; endforeach; ?>
