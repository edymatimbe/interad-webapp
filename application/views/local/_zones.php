<?php if (count($zones)): ?>
    <?php foreach ($zones as $key => $zone): ?>
        <tr class="text-nowrap">
            <td class="text-center"><?= $key + 1 ?></td>
            <td class="text-left"><?= $zone->name ?></td>
            <td class="text-center">
                   <a title="Show subsidy"
                   class="btn btn-sm btn-outline-secondary"
                   onclick="get_modal(<?= $zone->id ?>,'local','small','edit')">
                    <i class="fa fa-edit">&nbsp;</i><?= $this->lang->line('edit') ?>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else:; ?>
<tr>
    <td colspan="3" class="text-primary">Sem dados</td>
</tr>
<?php endif; ?>
