<?php foreach ($newspapers as $counter => $newspaper) : ?>
    <tr class="text-nowrap">
        <td class="text-left"><?= $counter+1 ?></td>
        <td class="text-left"><?= $newspaper->name ?></td>
        <td class="text-center"><?= $newspaper->publish_date ?></td>
        <td class="text-center">
			<?php if ($newspaper->active == 1): ?>
				<input checked class="toggle-switch" type="checkbox" value="0" data-id="<?= $newspaper->id ?>"
					   data-table="newspapers">
			<?php else: ?>
				<input class="toggle-switch" value="1" type="checkbox" data-id="<?= $newspaper->id ?>" data-table="newspapers">
			<?php endif ?>
		</td>
        <td class="text-center">
            <a title="Show department" class="btn btn-sm btn-outline-primary mr-2" onclick="get_modal(<?= $newspaper->id ?>,'newspaper','small','show')">
                <i class="fa fa-eye">&nbsp;</i><?= $this->lang->line('show') ?>
            </a>
            <a title="Show department" class="btn btn-sm btn-outline-secondary" onclick="get_modal(<?= $newspaper->id ?>,'newspaper','small','form')">
                <i class="fa fa-edit">&nbsp;</i><?= $this->lang->line('edit') ?>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
