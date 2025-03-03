<p class="text-center w-100 my-0 mx-0">
    
    <button onclick="get_payment_receipt(<?= $payment->id ?>,'modal')" title="<?= $this->lang->line('receipt') ?>"
            class="btn btn-sm btn-outline-secondary">
        <i class="fa fa-file-pdf-o text-danger">&nbsp;</i><?= $this->lang->line('receipt') ?>
    </button>
</p>
