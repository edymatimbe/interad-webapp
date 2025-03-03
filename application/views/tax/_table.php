<?php foreach ($taxes as $counter => $tax) : ?>
    <tr class="text-nowrap">
        <td class="text-left"><?= $counter+1 ?></td>
        <td class="text-left"><?= $tax->name ?></td>
        <td class="text-left"><?= get_by_id('brand', ['id' => $tax->brand_id])->name ?></td>
        <td class="text-left"><?= get_by_id('category', ['id' => $tax->category_id])->name ?></td>
        <td class="text-center"><?= $tax->registration ?></td>
        <td class="text-center">
			<?php if ($tax->active == 1): ?>
				<input checked class="toggle-switch" type="checkbox" value="0" data-id="<?= $tax->id ?>"
					   data-table="tax">
			<?php else: ?>
				<input class="toggle-switch" value="1" type="checkbox" data-id="<?= $tax->id ?>" data-table="tax">
			<?php endif ?>
		</td>
        <td class="text-center">
            <a title="Show department" class="btn btn-sm btn-outline-primary mr-2" onclick="get_modal(<?= $tax->id ?>,'tax','small','show')">
                <i class="fa fa-eye">&nbsp;</i><?= $this->lang->line('show') ?>
            </a>
            <a title="Show department" class="btn btn-sm btn-outline-secondary" onclick="get_modal(<?= $tax->id ?>,'tax','small','form')">
                <i class="fa fa-edit">&nbsp;</i><?= $this->lang->line('edit') ?>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
