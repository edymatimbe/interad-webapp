<style>
    #header {
        height: 120px;
    }

    .div {
        width: 100%;
        height: 20px;
    }
    .border{
        border: none !important;
    }

    .border-dashed {
        border-bottom: #e3e6f0 1px solid;
    }

    .border-dashed-all {
        border: #b9bcc6 1px solid;
    }
</style>
<?php $setting = $this->core_model->get_by_id('setting',array('id'=>1))?>
<div class="modal-content">
    <div class="modal-header bg-gray-200">
        <h5 class="modal-title" id="modal-sale-title">
            <i class="fa fa-file-pdf text-danger">&nbsp;</i>
            <span class="text-capitalize text-micro">
                Recibo
			</span>
        </h5>
        <button class="btn btn-sm btn-secondary float-right" onclick="get_payment_receipt(<?= $id ?>,'print')">
            <i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
        </button>
    </div>
    <div class="modal-body px-5 pb-5" id="">
        <div id="header" style="margin-bottom: 100px">
            <div style="width: 67%;" class="d-flex">
                <div style="width: 140px">
                    <img width="100%" class="" src="<?= base_url('public/img/logo/logo.png') ?>"
                         alt="image">
                </div>
                <div class="pl-4">
                    <br>
                    <?php if ($setting->nuit): ?>
                        <p class="my-1">Nuit: <?= $setting->nuit ?></p>
                    <?php endif; ?>
                    <p class="my-1"><?= $setting->address . ', ' . $setting->city ?></p>
                    <p class="my-1">
                        Cell: <?= $setting->phone ?> <?= ($setting->phone2) ? ' / ' . $setting->phone2 : '' ?> </p>
                    <?php if ($setting->email): ?>
                        <p class="my-1">Email: <?= $setting->email ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="float-right pt-3 position-relative" style="width: 30%;height: 60px;">
                <div class="position-absolute border-dashed-all"
                     style="width: 100%; height: 60px; right: 1px; top: 0">
                    <p class="my-0 text-right f-s-13 p-2 text-uppercase" style="color: #1e4280">RECIBO
                        Nº: <?= $receipt ?></p>
                    <p class="my-0 text-right px-2">Data de emissão: <?= date_format(date_create($created_at),'d-m-Y'); ?></p>
                </div>
            </div>
        </div>

        <?php $customer = $this->core_model->get_by_id('customer', array('id' => $customer_id)) ?>

        <table class="table border-dashed-all">
            <tbody>
            <tr>
                <td class="border-dashed text-right bg-gray-200" style="width: 15%">Nome do cliente:</td>
                <td class="border-dashed" style="width: 30%;"><?= $customer->name ?></td>
                <td class="border-dashed text-right bg-gray-200" style="width: 15%">Código do cliente:</td>
                <td class="border-dashed text-right" style="width: 15%"><?= $customer->code ?></td>
            </tr>
            <tr>
                <td class="border-dashed text-right bg-gray-200 py-2" style="width: 15%">NUIT:</td>
                <td class="border-dashed" style="width: 30%"><?= $customer->nuit ?></td>
                <td class="border-dashed text-right bg-gray-200" style="width: 15%">Telefone:</td>
                <td class="border-dashed text-right"
                    style="width: 15%"><?= ($customer) ? $customer->phone.' '.($customer->phone2? ' / ' . $customer->phone2 : '') : ''  ?></td>
            </tr>
            <tr>
                <td class="border-dashed text-right bg-gray-200" style="width: 15%">Endereço:</td>
                <td class="border-dashed" style="width: 30%;"><?= $customer->address ?></td>
                <td class="border-dashed text-right bg-gray-200" style="width: 15%">Email:</td>
                <td class="border-dashed text-right" style="width: 30%"><?= $customer->email ?></td>
            </tr>
            </tbody>
        </table>
        <?php $extenso = $this->core_model->por_extenso(number_format($amount, 2, ',', '')) ?>
        <br>
        <br>
        <div class="row justify-content-end">
            <div class="col-8">
                <table class="table border-dashed-all">
                    <tbody>
                    <tr>
                        <td class="border-dashed text-right bg-gray-200" style="width: 50%">Forma de pagamento
                        </td>
                        <td class="border-dashed text-right" style="width: 50%;">
                            <?= $pay_method_name ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-dashed text-right bg-gray-200" style="width: 50%">Valor pago</td>
                        <td class="border-dashed text-right" style="width: 50%;">
                            <?= number_format($amount, 2) ?> MT
                        </td>
                    </tr>
                    <?php if ($pay_method == 1): ?>
                        <tr>
                            <td class="border-dashed text-right bg-gray-200" style="width: 50%">Valor recebido
                            </td>
                            <td class="border-dashed text-right" style="width: 50%;">
                                <?= number_format($total_paid, 2) ?> MT
                            </td>
                        </tr>
                        <tr>
                            <td class="border-dashed text-right bg-gray-200"
                                style="width: 50%"><?= $this->lang->line('change') ?></td>
                            <td class="border-dashed text-right" style="width: 50%;">
                                <?= number_format($change, 2) ?> MT
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($this->core_model->get_by_id('payment_method', array('id' => $pay_method))->parent_id == 4): ?>
                        <tr>
                            <td class="border-dashed text-right bg-gray-200"
                                style="width: 50%"><?= 'Referência' ?></td>
                            <td class="border-dashed text-right" style="width: 50%;">
                                <?= $reference ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-dashed text-right bg-gray-200"
                                style="width: 50%"><?= 'Titular' ?></td>
                            <td class="border-dashed text-right" style="width: 50%;">
                                <?= $holder ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-dashed text-right bg-gray-200"
                                style="width: 50%"><?= 'Número de telefone' ?></td>
                            <td class="border-dashed text-right" style="width: 50%;">
                                <?= $mobile_number ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <!--					bank service check-->
                    <?php if ($pay_method == 3): ?>
                        <tr>
                            <td class="border-dashed text-right bg-gray-200"
                                style="width: 50%"><?= 'Nome do banco' ?></td>
                            <td class="border-dashed text-right" style="width: 50%;">
                                <?= $check_bank ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-dashed text-right bg-gray-200"
                                style="width: 50%"><?= 'Número do cheque' ?></td>
                            <td class="border-dashed text-right" style="width: 50%;">
                                <?= $check_number ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-dashed text-right bg-gray-200"
                                style="width: 50%"><?= 'Número da conta' ?></td>
                            <td class="border-dashed text-right" style="width: 50%;">
                                <?= $account ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-dashed text-right bg-gray-200"
                                style="width: 50%"><?= 'Titular' ?></td>
                            <td class="border-dashed text-right" style="width: 50%;">
                                <?= $holder ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <!--					bank service-->
                    <?php if ($pay_method == 12): ?>
                        <tr>
                            <td class="border-dashed text-right bg-gray-200"
                                style="width: 50%"><?= 'Nome do banco' ?></td>
                            <td class="border-dashed text-right" style="width: 50%;">
                                <?= $check_bank ?>
                            </td>
                        </tr>
                        <?php if ($account): ?>
                            <tr>
                                <td class="border-dashed text-right bg-gray-200"
                                    style="width: 50%"><?= 'Número da conta' ?></td>
                                <td class="border-dashed text-right" style="width: 50%;">
                                    <?= $account ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($nib): ?>
                            <tr>
                                <td class="border-dashed text-right bg-gray-200"
                                    style="width: 50%"><?= 'NIB' ?></td>
                                <td class="border-dashed text-right" style="width: 50%;">
                                    <?= $nib ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td class="border-dashed text-right bg-gray-200"
                                style="width: 50%"><?= 'Titular' ?></td>
                            <td class="border-dashed text-right" style="width: 50%;">
                                <?= $holder ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <br>
        <br>
        <div id="footer">
            <p class="my-0 f-s-10">
                Documento processado por computador
            </p>
        </div>
    </div>

    <div class="modal-footer bg-gray-200">
        <div class="d-flex justify-content-between w-100">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                <?= $this->lang->line('cancel') ?>
            </button>
        </div>
    </div>
</div>
