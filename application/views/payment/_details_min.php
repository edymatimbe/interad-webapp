<ul class="list-group">
    <li class="list-group-item ">
        <label class="f-w-600"><?= 'Forma de pagamento' ?></label><label
                class="float-right cart-total"><?= $pay_method_name ?> </label>
    </li>
    <li class="list-group-item">
        <label class="f-w-600"><?= 'Data' ?></label>
        <label class="float-right cart-total">
            <?= date_format(date_create($created_at), 'd-m-Y H:i') ?>
        </label>
    </li>
    <li class="list-group-item">
        <label class="f-w-600"><?= $this->lang->line('amount') ?> </label>
        <label class="float-right">
            <?= number_format($amount, 2) ?> MT
        </label>
    </li>
    <?php if ($pay_method == 1): ?>
        <li class="list-group-item">
            <label class="f-w-600"><?= $this->lang->line('amount_paid') ?> </label>
            <label class="float-right">
                <?= number_format($total_paid, 2) ?> MT
            </label>
        </li>
        <li class="list-group-item">
            <label class="f-w-600"><?= $this->lang->line('change') ?> </label>
            <label class="float-right">
                <?= number_format($change, 2) ?> MT
            </label>
        </li>
    <?php endif; ?>

    <!--						mobile service-->
    <?php if ($parent_id == 4): ?>
        <li class="list-group-item">
            <label class="f-w-600"><?= $this->lang->line('reference') ?> </label>
            <label class="float-right">
                <?= $reference ?>
            </label>
        </li>
        <li class="list-group-item">
            <label class="f-w-600"><?= $this->lang->line('owner') ?> </label>
            <label class="float-right">
                <?= $holder ?>
            </label>
        </li>
        <li class="list-group-item">
            <label class="f-w-600"><?= $this->lang->line('phone') ?> </label>
            <label class="float-right">
                <?= $mobile_number ?>
            </label>
        </li>
    <?php endif; ?>
    <!--					bank service-->
    <?php if ($pay_method == 3): ?>
        <li class="list-group-item">
            <label class="f-w-600"> <?= $this->lang->line('bank_name') ?> </label>
            <label class="float-right">
                <?= $check_bank ?>
            </label>
        </li>
        <li class="list-group-item">
            <label class="f-w-600"> <?= $this->lang->line('check_number') ?> </label>
            <label class="float-right">
                <?= $check_number ?>
            </label>
        </li>
        <li class="list-group-item">
            <label class="f-w-600"> <?= $this->lang->line('Account_number') ?> </label>
            <label class="float-right">
                <?= $account ?>
            </label>
        </li>
        <li class="list-group-item">
            <label class="f-w-600"><?= $this->lang->line('owner') ?> </label>
            <label class="float-right">
                <?= $holder ?>
            </label>
        </li>
    <?php endif; ?>
    <!--					bank service-->
    <?php if ($pay_method == 12): ?>
        <li class="list-group-item">
            <label class="f-w-600"><?= $this->lang->line('bank_name') ?></label>
            <label class="float-right">
                <?= $check_bank ?>
            </label>
        </li>
        <?php if ($account): ?>
            <li class="list-group-item">
                <label class="f-w-600"><?= $this->lang->line('Account_number') ?> </label>
                <label class="float-right">
                    <?= $account ?>
                </label>
            </li>
        <?php endif; ?>
        <?php if ($nib): ?>
            <li class="list-group-item">
                <label class="f-w-600">NIB </label>
                <label class="float-right">
                    <?= $nib ?>
                </label>
            </li>
        <?php endif; ?>

        <li class="list-group-item">
            <label class="f-w-600"><?= $this->lang->line('owner') ?>  </label>
            <label class="float-right">
                <?= $holder ?>
            </label>
        </li>
    <?php endif; ?>
</ul>