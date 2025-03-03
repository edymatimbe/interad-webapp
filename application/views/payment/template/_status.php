<label class="text-center w-100">
    <?php if ($loan->status == 'aberto'): ?>
        <span class="text-info text-capitalize"><?= $loan->status ?></span>
    <?php elseif ($loan->status == 'vencido'): ?>
        <span class="text-warning text-capitalize"><?= $loan->status ?></span>
    <?php elseif ($loan->status == 'fechado'): ?>
        <span class="text-success text-capitalize"><?= $loan->status ?></span>
    <?php endif; ?>
</label>