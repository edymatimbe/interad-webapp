<?php if ($image): ?>
    <?php if (is_file(FCPATH . $image)): ?>
        <img class="<?=$class?>"
             src="<?= base_url($image) ?>"
             alt="image"
             id="<?=$id?>">
    <?php else: ?>
        <img class="<?=$class?>"
             src="<?= base_url(); ?>public/img/avatar/avatar.svg"
             alt="image" id="<?=$id?>">
    <?php endif; ?>
<?php else: ?>
    <img class="<?=$class?>"
         src="<?= base_url(); ?>public/img/avatar/avatar.svg"
         alt="image"
         id="<?=$id?>">
<?php endif; ?>