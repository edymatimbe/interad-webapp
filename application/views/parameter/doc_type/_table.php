<?php foreach ($doc_types as $counter => $doc_type): ?>
    <tr class="text-nowrap">
        <td style="width: 5%" class="text-center"><?= $counter + 1 ?></td>
        <td style="width: 65%" class="text-left"><?= $doc_type->name ?></td>
        <td style="width: 15%" class="text-center">
            <?php if ($doc_type->active == 1): ?>
                <button class="btn btn-sm btn-outline-success text-center w-50 disabled" disabled>
                    Activo
                </button>
            <?php else: ?>
                <button class="btn btn-sm btn-outline-danger text-center w-50 disabled" disabled>
                    Inactivo
                </button>
            <?php endif ?>
        </td>
        <td style="width: 15%" class="text-center">
            <a title="Show service"
               class="btn btn-sm btn-outline-secondary"
               onclick="set_doc_type(<?= $doc_type->id ?>)">
                <i class="fa fa-edit">&nbsp;</i><?= $this->lang->line('edit') ?>
            </a>
        </td>
    </tr>
<?php endforeach; ?>