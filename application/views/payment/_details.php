<div class="modal-content">

    <div class="modal-header">
        <h5 class="modal-title">
            <i class="fa fa-list">&nbsp;</i>
            <label class="text-micro">
                <?= 'Detalhes de pagamento' ?>
            </label>
        </h5>
        <button class="btn btn-sm btn-secondary float-right" id="btn-print"
                onclick="get_payment_receipt('<?= $id ?>','print')">
            <i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') . ' ' . $this->lang->line('receipt') ?>
        </button>
    </div>
    <div class="modal-body bg-gray-200" id="">
        <h6 class="f-s-14 text-gray-600 f-w-600  bg-white rounded shadow-sm p-3">
            <i class="feather icon-user">&nbsp;</i> <label
                    class="text-capitalize mr-2"><?= $this->lang->line('customer') . ': ' ?></label><?= $customer ?>
        </h6>
        <hr>
        <?php $this->load->view('payment/_details_min')?>
    </div>
</div>
