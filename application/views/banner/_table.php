<?php foreach ($banner as $key => $item) : ?>
    <?php $tax = get_by_id('tax', ['id' => $item->tax_id]) ?>
    <?php $category = get_by_id('category', ['id' => $tax->category_id]) ?>
    <?php $brand = get_by_id('brand', ['id' => $tax->brand_id]) ?>
    
    <tr>
        <td  class="text-center"><?= $key + 1 ?></td>
        <td  class="text-left"><?= $tax->name ?></td>
        <td  class="text-left"><?= $category->name.' '.$brand->name ?></td>
        <td  class="text-center"><?= $tax->registration ?></td>
       
        <td><?= $item->title ?></td>
        <td class="text-center">
            <?php if ($item->active == 1) : ?>
                <input checked class="toggle-switch" type="checkbox" value="0" data-id="<?= $item->id ?>" data-table="banner">
            <?php else : ?>
                <input class="toggle-switch" value="1" type="checkbox" data-id="<?= $item->id ?>" data-table="banner">
            <?php endif ?>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick=" get_form(<?= $item->id ?>) ">
                <i class="feather icon-edit">&nbsp;</i><?= $this->lang->line('edit') ?>
            </button>
        </td>
    </tr>
<?php endforeach; ?>