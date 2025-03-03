<?php $counter = 0;
foreach ($brands as $brand): ?>
	<?php
	$products = count($this->core_model->get_all('product', array('brand_id' => $brand->id)));
	?>
	<tr class="text-nowrap">
		<td class="text-center"><?= $counter + 1 ?></td>

		<td onclick="show_brand(<?= $brand->id ?>)" class="cursor-pointer f-w-700 text-agata">
			<?= $brand->name?>
		</td>
		<td class="text-center align-middle">
			<span class="badge badge-info w-75 py-2">
				<?= count($this->core_model->get_all('product',array('brand_id'=>$brand->id))) ?>
			</span>
		</td>

		<td class="text-center">
			<?php if ($brand->active == 1): ?>
				<input checked class="toggle-switch" type="checkbox" value="0" data-id="<?= $brand->id ?>"
					   data-table="brand">
			<?php else: ?>
				<input class="toggle-switch" value="1" type="checkbox" data-id="<?= $brand->id ?>" data-table="brand">
			<?php endif ?>
		</td>
		<td class="text-center px-2">
			<a title="<?= $this->lang->line('show').' '.$this->lang->line('brand') ?>"
			   class="btn btn-sm btn-outline-primary mr-2"
			   onclick="show_brand(<?= $brand->id ?>)">
				<i class="fa fa-eye">&nbsp;</i><?= $this->lang->line('show') ?>
			</a>

			<a title="<?= $this->lang->line('edit').' '.$this->lang->line('brand') ?>"
			   class="btn btn-sm btn-outline-secondary"
			   onclick="edit_brand(<?= $brand->id ?>)">
				<i class="fa fa-edit">&nbsp;</i><?= $this->lang->line('edit') ?>
			</a>
		</td>
	</tr>
	<?php $counter += 1; endforeach; ?>
