<?php $counter = 0;
foreach ($currencies as $item): ?>
	<tr class="text-nowrap">
		<td class="text-center"><?= $counter + 1 ?></td>
		<td><?= $item->name ?></td>
		<td class="text-center">
			<?php if ($item->active == 1): ?>
				<input checked class="toggle-switch" type="checkbox" value="0" data-id="<?= $item->id ?>"
					   data-table="item">
			<?php else: ?>
				<input class="toggle-switch" value="1" type="checkbox" data-id="<?= $item->id ?>" data-table="item">
			<?php endif ?>
		</td>
		<td class="text-center">
			<a onclick="edit_item(<?= $item->id ?>)" title="Edit Product"
			   class="btn btn-sm btn-outline-secondary px-2"><i class="fa fa-edit"
																aria-hidden="true"></i>&nbsp;<?= $this->lang->line('edit') ?>
			</a>
		</td>
	</tr>
	<?php $counter += 1; endforeach; ?>
