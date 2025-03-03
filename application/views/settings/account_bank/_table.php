<?php $counter = 0;
foreach ($account_bank as $bank) : ?>
	<tr class="text-nowrap">
		<td class="text-center"><?= $counter + 1 ?></td>
		<td class="text-left"><?= $this->core_model->get_by_id('bank', ['id' => $bank->bank_id])->name ?></td>
		<td class="text-left"><?= $bank->owner ?></td>
		<td class="text-left"><?= $bank->number ?></td>
		<td class="text-left"><?= $bank->nib ?></td>
		<td class="text-center">
			<?php if ($bank->active == 1) : ?>
				<input checked class="toggle-switch" type="checkbox" value="0" data-id="<?= $bank->id ?>" data-table="bank_account">
			<?php else : ?>
				<input class="toggle-switch" value="1" type="checkbox" data-id="<?= $bank->id ?>" data-table="bank_account">
			<?php endif ?>
		</td>
		<td class="text-center">
			<a onclick="edit_bank(<?= $bank->id ?>)" title="Edit Product" class="btn btn-sm btn-outline-secondary px-2"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;<?= $this->lang->line('edit') ?>
			</a>
		</td>
	</tr>
<?php $counter += 1;
endforeach; ?>