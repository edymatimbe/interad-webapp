<?php if (count($districts)): ?>
    <?php foreach ($districts as $key => $district): ?>
        <tr class="text-nowrap">
            <td class="text-center"><?= $key + 1 ?></td>
            <td class="text-left"><?= $district->name ?></td>
            <td class="text-center">
                <a title="Show subsidy"
                   class="btn btn-sm btn-outline-secondary"
                   onclick="get_zones(<?= $district->id ?>,'<?= $district->name ?>')">
                    <i class="feather icon-eye">&nbsp;</i><?= "Bairros" ?>
                </a>
                <a title="Adicionar zona/bairro"
                   class="btn btn-sm btn-outline-primary"
                   onclick="get_modal('','local','small','form_zone','',<?= $district->id ?>)">
                    <i class="feather icon-plus">&nbsp;</i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else:; ?>
    <tr>
        <td colspan="3" class="text-primary">Sem dados</td>
    </tr>
<?php endif; ?>
