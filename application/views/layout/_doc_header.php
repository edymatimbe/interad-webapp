<?php $setting = $this->core_model->get_by_id('company', array('id' => $this->session->userdata('company_id')));  ?>
    <p class="my-0"><strong><?= $setting->name ?></strong></p>
<?php if ($setting->address) : ?>
    <p class="my-0"><?= $setting->address ?></p>
<?php endif; ?>
<?php if ($setting->phone) : ?>
    <p class="my-0"><strong>Tel:&nbsp;</strong>
        <?= $setting->phone ?>
        <?= ($setting->phone2) ? ' / ' . $setting->phone2 : '' ?>
    </p>
<?php endif; ?>

<?php if ($setting->email) : ?>
    <p class="my-0"><strong>Email:&nbsp;</strong><?= $setting->email ?></p>
<?php endif; ?>
<?php if ($setting->nuit) : ?>
    <p class="my-0"><strong>Nuit:&nbsp;</strong><?= $setting->nuit ?></p>
<?php endif; ?>