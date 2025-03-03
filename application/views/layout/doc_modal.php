<style>
    #header {
        height: 180px;
    }

    .div {
        width: 100%;
        height: 20px;
    }

    #footer {
        width: 100%;
        position: ;
        left: 0;
        bottom: 0;
        right: 0;
        height: 60px;
    }
</style>
<div class="modal-content text-dark">
    <div class="modal-header bg-gray-200">
        <h5 class="modal-title" id="modal-sale-title">
            <i class="fa fa-file-pdf text-danger">&nbsp;</i>
            <span class="text-agata">
                <?php if ($table === 'invoice') : ?>
                    <?php if (isset($type_2)) : ?>
                        <?= 'Guia de remessa ' . $delivery_id ?>
                    <?php else : ?>
                        <?= $this->lang->line('invoice') . ' ' . $code ?>
                    <?php endif; ?>
                <?php elseif ($table == 'sale') : ?>
                    <?php if ($select_doc == 1) {
                        echo 'Guia de venda ' . $code;
                    } else {
                        echo 'VD ' . $code;
                    } ?>

                <?php elseif ($table == 'quotation') : ?>
                    <?= $this->lang->line('quotation') . ' ' . $code ?>
                <?php elseif ($table == 'payment') : ?>
                    <?= $this->lang->line('receipt') . ' ' . $code ?>
                <?php elseif ($table == 'purchase') : ?>
                    <?php $number = $code ?>

                    <?= $this->lang->line('invoice') . ' ' . $this->lang->line('of1') . ' ' . $this->lang->line('purchase') ?>
                <?php endif; ?>
            </span>
        </h5>
        <?php if ($table === 'invoice') : ?>
            <?php if (isset($type_2)) : ?>
                <button class="btn btn-sm btn-secondary float-right" id="btn-print" onclick="pdf_invoice_delivery(<?= $id ?>, 2)">
                    <i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
                </button>
            <?php else : ?>
                <button class="btn btn-sm btn-secondary float-right" onclick="getInvoice(<?= $id ?>,'print')">
                    <i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
                </button>
            <?php endif; ?>
        <?php elseif ($table === 'sale') : ?>
            <?php if (isset($type_2)) : ?>
                <button class="btn btn-sm btn-secondary float-right" id="btn-print" onclick="pdf_sale_delivery(<?= $id ?>)">
                    <i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
                </button>
            <?php else : ?>
                <button class="btn btn-sm btn-secondary float-right" onclick="get_sale(<?= $id ?>,'print')">
                    <i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
                </button>
            <?php endif; ?>
        <?php elseif ($table == 'quotation') : ?>
            <div>
                <?php if ($this->core_model->get_by_id('quotation', array('id' => $id))->was_sold) : ?>
                    <button class="btn btn-sm btn-primary mr-4" id="btn-print-quotation-VD">
                        <i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') . ' VD' ?>
                    </button>
                <?php endif ?>
                <button class="btn btn-sm btn-secondary float-right" onclick="printQuotation(<?= $id ?>)">
                    <i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
                </button>
            </div>

        <?php elseif ($table == 'payment') : ?>
            <button class="btn btn-sm btn-secondary float-right" onclick="get_payment_receipt(<?= $id ?>,'print')">
                <i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
            </button>
        <?php elseif ($table == 'purchase') : ?>
            <?php if (isset($pre_sale)) : ?>
                <button class="btn btn-sm btn-secondary float-right" onclick="for_sale(<?= $id ?>,'print')">
                    <i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
                </button>
            <?php else : ?>
                <button class="btn btn-sm btn-secondary float-right" onclick="get_purchase(<?= $id ?>,'print')">
                    <i class="feather icon-printer">&nbsp;</i> <?= $this->lang->line('print') ?>
                </button>
            <?php endif; ?>

        <?php endif; ?>

    </div>
    <div class="modal-body px-5 pb-5" id="">
        <div id="header" class="border-bottom">
            <div class="float-left position-relative w-45">
                <p class="position-relative top-0">
                    <?php if ($company->image) : ?>
                        <?php if (is_file(FCPATH . $company->image)) : ?>
                            <img width="175" src="<?= base_url($company->image) ?>" alt="image">
                        <?php else : ?>
                            <img width="175" src="<?= base_url('public/img/logo/invoice_logo.png') ?>" alt="image">
                        <?php endif; ?>
                    <?php else : ?>
                        <img width="175" src="<?= base_url('public/img/logo/invoice_logo.png') ?>" alt="image">
                    <?php endif; ?>
                </p>
                <div class="position-absolute" style="top: 60px">
                    <p class="my-0"><strong><?= $company->name ?></strong></p>
                    <?php if ($company->address) : ?>
                        <p class="my-0"><?= $company->address ?></p>
                    <?php endif; ?>
                    <p class="my-0"><?= $company->city ?></p>
                    <p class="my-0"><strong>Tel:</strong>
                        <?= $company->phone ? ' ' . $company->phone : '' ?>
                        <?= ($company->phone2) ? ' / ' . $company->phone2 : '' ?> </p>
                    <?php if ($company->email) : ?>
                        <p class="my-0"><strong>Email:</strong><?= $company->email ?></p>
                    <?php endif; ?>
                    <?php if ($company->nuit) : ?>
                        <p class="my-0"><strong>Nuit:</strong><?= $company->nuit ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php $t_name = 'cliente' ?>
            <?php if ($table == 'purchase') : ?>
                <?php $t_name = 'fornecedor' ?>
                <?php $customer = empty($supplier_id) ? false : $this->core_model->get_by_id('supplier', array('id' => $supplier_id)) ?>
            <?php else : ?>
                <?php $customer = empty($customer_id) ? false : $this->core_model->get_by_id('customer', array('id' => $customer_id)) ?>
            <?php endif; ?>

            <div class="float-left pt-3" style="width: 22%;">
            </div>
            <div class="float-right pt-3 position-relative" style="width: 33%;height: 80px;">
                <div class="position-absolute" style="width: 100%; height: 80px; right: 0; top: 60px">
                    
                        <p class="my-0 text-left"><?= 'Exmo.(s) Sr.(s)' ?></p>
                        <p class="my-0 text-left">
                            <Strong><?= isset($customer) && !empty($customer) ? $customer->first_name.' '.$customer->last_name : 'Nome do cliente' ?></Strong>
                        </p>
                        <p class="my-0 text-left"><?= isset($customer)   && !empty($customer) ? $customer->address : '### ## ### ####' ?></p>
                        <p class="my-0 text-left">Tell: <?= isset($customer)   && !empty($customer) ? $customer->phone : '### ## ### ####' ?></p>
                        <p class="my-0 text-left">Nuit: <?= isset($customer)   && !empty($customer) ? $customer->nuit : '#########' ?></p>

                </div>
            </div>
        </div>
        <br>

        <br>
        <?php if (!isset($is_receipt)) : ?>
            <div class="" style="height: 75px">
                <div class="float-left" style="width: 50%">
                    <?php if ($table === 'invoice' || $table == 'quotation') : ?>
                        <p class="my-0 text-left"><strong>Data
                                Emissão: </strong><?= simple_date($issued_at) ?></p>
                        <p class="my-0 text-left"><strong>Data de
                                Vencimento: </strong><?= simple_date($expiry_date) ?></p>
                        <p class="my-0 text-left"><strong>Prazo de
                                Pagamento: </strong><?= ' Pronto pagamento' ?>
                            <span class="float-right"></span>
                        </p>
                    <?php else : ?>
                        <p class="my-0 text-left"><strong>Data
                                Emissão: </strong><?= simple_date($date) ?></p>
                    <?php endif; ?>
                </div>
                <div class="float-left" style="width: 50%">
                    <p>&nbsp;</p>
                    <p class="text-right my-0"><strong>
                            <?php if ($table === 'invoice') : ?>
                                Factura
                            <?php elseif ($table === 'sale') : ?>
                                <?php if ($select_doc == 1) : ?>
                                    Guia de venda
                                <?php else : ?>
                                    VD
                                <?php endif; ?>
                                <?php $number = $code ?>
                            <?php elseif ($table == 'quotation') : ?>
                                Cotação
                            <?php elseif ($table == 'purchase') : ?>
                                <?php if (isset($pre_sale)) : ?>
                                    Previsão de venda
                                <?php else : ?>
                                    <?= $this->lang->line('invoice') . ' ' . $this->lang->line('of1') . ' ' . $this->lang->line('purchase') ?>
                                <?php endif; ?>
                                <?php $number = $code ?>

                            <?php endif; ?>
                            Nº <?= $number . ' / ' . date('Y') ?> </strong></p>
                    <p class="text-right my-0"><strong>Original</strong></p>
                </div>
            </div>
        <?php else : ?>
            <div class="" style="height: 170px;">
                <div class="float-left pr-3" style="width: 40%">
                    <p class="my-1 text-left"><strong>Data: </strong><?= simple_date($issued_at) ?></p>
                    <p class="my-2 text-left"><strong>Tipo de pagamento: </strong>
                        <label class="float-right">
                            <?= $payment_method_name ?>
                        </label>
                    </p>
                    <p class="my-2 text-left">
                        <strong><?= $this->lang->line('Amount_paid') ?></strong>
                        <label class="float-right">
                            <?= number_format($payment->amount, 2) ?>
                        </label>
                    </p>

                    <?php if ($payment->method_id == 1) : ?>
                        <p class="my-1 text-left">
                            <strong><?= $this->lang->line('amount_received') ?></strong>
                            <label class="float-right">
                                <?= number_format($payment->total_paid, 2) ?>
                            </label>
                        </p>
                        <p class="my-2 text-left">
                            <strong><?= $this->lang->line('change') ?></strong>
                            <label class="float-right">
                                <?= number_format($payment->change, 2) ?>
                            </label>
                        </p>
                    <?php endif; ?>


                    <?php if ($this->core_model->get_by_id('payment_method', array('id' => $payment->method_id))->parent_id == 4) : ?>
                        <p class="my-1 text-left">
                            <strong><?= 'Referência' ?></strong>
                            <label class="float-right">
                                <?= $payment->reference ?>
                            </label>
                        </p>
                        <p class="my-2 text-left">
                            <strong><?= 'Número de telefone' ?></strong>
                            <label class="float-right">
                                <?= $payment->mobile_number ?>
                            </label>
                        </p>
                    <?php endif; ?>

                    <?php if ($payment->method_id == 3) : ?>
                        <p class="my-1 text-left">
                            <strong><?= 'Banco' ?></strong>
                            <label class="float-right">
                                <?= $payment->check_bank ?>
                            </label>
                        </p>
                        <p class="my-2 text-left">
                            <strong><?= 'Número do cheque' ?></strong>
                            <label class="float-right">
                                <?= $payment->check_number ?>
                            </label>
                        </p>
                        <p class="my-1 text-left">
                            <strong><?= 'Número da conta' ?></strong>
                            <label class="float-right">
                                <?= $payment->account ?>
                            </label>
                        </p>
                        <p class="my-1 text-left">
                            <strong><?= 'Titular' ?></strong>
                            <label class="float-right">
                                <?= $payment->holder ?>
                            </label>
                        </p>
                    <?php endif; ?>


                    <?php if ($payment->method_id == 12) : ?>
                        <p class="my-1 text-left">
                            <strong><?= 'Banco' ?></strong>
                            <label class="float-right">
                                <?= $payment->check_bank ?>
                            </label>
                        </p>
                        <?php if ($payment->account) : ?>
                            <p class="my-2 text-left">
                                <strong><?= 'Número da conta' ?></strong>
                                <label class="float-right">
                                    <?= $payment->account ?>
                                </label>
                            </p>
                        <?php endif; ?>
                        <?php if ($payment->nib) : ?>
                            <p class="my-1 text-left">
                                <strong><?= 'NIB' ?></strong>
                                <label class="float-right">
                                    <?= $payment->nib ?>
                                </label>
                            </p>
                        <?php endif; ?>
                        <p class="my-1 text-left">
                            <strong><?= 'Titular' ?></strong>
                            <label class="float-right">
                                <?= $payment->holder ?>
                            </label>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="float-left pl-3" style="width: 60%">
                    <p class="my-1">&nbsp;</p>
                    <p class="my-1">&nbsp;</p>
                    <p class="my-1">&nbsp;</p>
                    <p class="my-1">&nbsp;</p>
                    <p class="text-right my-0"><strong><?= 'Recibo' ?> Nº AL
                            / <?= $number . ' / ' . date('Y') ?> </strong></p>
                    <p class="text-right my-0"><strong>Original</strong></p>
                </div>
            </div>
        <?php endif; ?>

        <br>



        <?php if (!isset($is_receipt)) : ?>
            <table id="table" class="table table-small">
                <thead>
                    <tr class="bg-light">
                        <th class="border-top border-left text-center bg-white" style="width: 10%"><?= $this->lang->line('quantity') ?></th>
                        <th class="border-top bg-white" style="width: 7.5%"> <?= 'Unidades' ?></th>
                        <th class="border-top  bg-white" style="width: 30%"><?= $this->lang->line('description') ?></th>
                        <th class="border-top text-right bg-white" style="width: 15%"><?= 'Pr. Unit' ?></th>
                        <th class="border-top text-right bg-white" style="width: 15%"><?= 'Iva %' ?></th>
                        <th class="border-top text-right bg-white border-right" style="width: 15%"><?= 'Total (MT)' ?></th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="border-bottom-0">
                        <td class=" border-top text-center border">10 </td>
                        <td class=" border-top text-center border">dias</td>
                        <td class="border-top border"> Duração da campanha</td>
                        <td class=" border-top text-right border" rowspan="3"> <?= number_format($video_amount, 2) . ' MT' ?></td>
                        <td class=" border-top text-right border" rowspan="3"> <?= number_format($video_amount * 0.16, 2) . ' MT' ?></td>
                        <td class=" border-top text-right border" rowspan="3"><?= number_format($video_amount + $video_amount * 0.16, 2) . ' MT' ?></td>
                    </tr>
                    <tr class="border-bottom-0">
                        <td class=" border-top border text-center">2 </td>
                        <td class=" border-top border text-center">qty</td>
                        <td class="border-top border"> Número de veículos </td>
                    </tr>
                    <tr class="border-bottom-0">
                        <td class=" border-top border text-center">2 </td>
                        <td class=" border-top border text-center">minutos</td>
                        <td class="border-top border"> Duração do spot </td>
                    </tr>
                </tbody>
            </table>

            <?php


            $total = $video_amount + $video_amount * 0.16;
            $subtotal = $video_amount;
            $tax =  $video_amount * 0.16;
            $discount = 0;
            ?>


            <?php $in_full = $this->core_model->por_extenso(number_format($total, 2, ',', '')) ?>
            <?php $in_full = str_replace(',', ' e ', str_replace('um mil', 'Mil', $in_full)) ?>


            <div class="border-top mt-2" style="height: 240px">
                <div class="float-left" style="width: 55%">
                    <p class="text-center mb-0"><strong>Resumo do IVA</strong></p>
                    <table class="table table-small">
                        <thead>
                            <tr class="bg-light">
                                <th class="border-top border-left bg-white" style="width: 15%"><?= 'Taxa' ?></th>
                                <th class="border-top bg-white text-right" style="width: 35%"> <?= 'Base de Incidência' ?></th>
                                <th class="border-top text-right bg-white" style="width: 25%"><?= 'IVA' ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-top-0">16.00%</td>
                                <td class="border-top-0 text-right"><?= $tax == 0 ? number_format(0, 2) : number_format($subtotal - $discount, 2) ?></td>
                                <td class="border-top-0 text-right"><?= number_format($tax, 2) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="float-left pl-5" style="width: 45%">
                    <p class="mb-0">&nbsp;</p>
                </div>
                <div class="float-left" style="width: 55%">
                    <div class="border p-2" style="height: 135px">
                        <div class="float-left" style="width: 100%">
                            <p>
                                <strong>Por extenso</strong>
                            </p>
                        </div>

                        <div class="float-left" style="width: 100%;">
                            <p class="text-capitalize"><?= $in_full ?></p>
                        </div>
                    </div>
                </div>
                <div class="float-left pl-5" style="width: 45%">
                    <div class="border">
                        <table class="table table-small pb-0 mb-0">
                            <tbody>
                                <tr>
                                    <td class="border-top-0">Total antes de descontos</td>
                                    <td class="border-top-0 text-right"><?= number_format($subtotal, 2) ?></td>
                                </tr>
                                <tr>
                                    <td>Desconto Comercial</td>
                                    <td class="text-right"><?= number_format($discount, 2) ?></td>
                                </tr>
                                <tr>
                                    <td>Desconto Financeiro</td>
                                    <td class="text-right"><?= number_format(0, 2) ?></td>
                                </tr>
                                <tr>
                                    <td>Base de Incidência de I.V.A</td>
                                    <td class="text-right"><?= $tax == 0 ? number_format(0, 2) : number_format($subtotal - $discount, 2) ?></td>
                                </tr>
                                <tr>
                                    <td>Total de I.V.A</td>
                                    <td class="text-right"><?= number_format($tax, 2) ?></td>
                                </tr>
                                <tr>
                                    <td>Total do documento</td>
                                    <td class="text-right"><?= number_format($total, 2) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <p>
                O pagamento pode ser feito por cheques, Depositos ou Transferência Bancária
            </p>
            <table class="table table-small">
                <thead>
                    <tr class="bg-light">
                        <th class="border-top border-left bg-white" style="width: 30%"><?= 'Banco' ?></th>
                        <th class="border-top bg-white" style="width: 30%"> <?= 'Conta' ?></th>
                        <th class="border-top text-left bg-white" style="width: 30%"><?= 'NIB' ?></th>
                        <th class="border-top text-center bg-white border-right" style="width: 10%"><?= 'Moeda' ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (get_all('bank_account') as $bank_account) : ?>
                        <?php $bank = $this->core_model->get_by_id('bank', ['id' => $bank_account->bank_id]) ?>
                        <tr>
                            <td class="border-top-0"><?= $bank->name ?></td>
                            <td class="border-top-0"><?= $bank_account->number ?></td>
                            <td class="border-top-0"><?= $bank_account->nib ?></td>
                            <td class="border-top-0 text-center"><strong><?= 'MT' ?></strong></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <p>Processado por computador / Software licenciado</p>
        <?php else :; ?>
            <?php $in_full = $this->core_model->por_extenso(number_format($total, 2, ',', '')) ?>
            <?php $in_full = str_replace(',', ' e ', str_replace('um mil', 'Mil', $in_full)) ?>
            <table id="table" class="table table-small">
				<thead>
					<tr class="bg-light">
						<th class="border-top border-left bg-white" style="width: 15%"><?= "Tipo de documento" ?>
						</th>
						<th class="border-top bg-white" style="width: 5%"> <?= 'Número' ?></th>
						<th class="border-top text-right bg-white" style="width: 20%"><?= 'Total' ?></th>
						<th class="border-top text-right bg-white" style="width: 20%"><?= 'Pendente' ?></th>
						<th class="border-top text-right bg-white" style="width: 20%"><?= 'Valor pago' ?></th>
						<th class="border-top text-right bg-white" style="width: 20%"><?= 'Remanescente' ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($invoices as $invoice) : ?>
						<tr>
							<td class="border-bottom border-right border-left text-center"><?= 'FACTURA' ?></td>
							<td class="border-bottom"><?= 'FT-' . $invoice->invoice_number ?></td>
							<td class="border-bottom text-right border-left border-right"><?= number_format($total, 2) ?></td>
							<td class="border-bottom text-right border-left border-right"><?= number_format(0, 2) ?></td>
							<td class="border-bottom text-right border-left border-right"><?= number_format($total, 2) ?></td>
							<td class="border-bottom text-right border-left border-right"><?= number_format(0, 2) ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<br>
            <p class="mb-2 border-top-separator">
                <strong>Total:</strong>
                <span class="float-right"><strong><?= number_format($total, 2) ?></strong></span>
            </p>
            <p class="my-0"><strong>Extenso:</strong></p>
            <p class="text-uppercase"><?= $in_full ?></p>
            <br>
            <br>
            <p class="text-center"><strong>_______________________________________________</strong></p>
            <p class="text-center"><strong>( Assinatura e carimbo )</strong></p>
        <?php endif; ?>
    </div>

    <div class="modal-footer bg-gray-200">
        <div class="d-flex justify-content-between w-100">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                <?= $this->lang->line('cancel') ?>
            </button>
        </div>
    </div>
</div>