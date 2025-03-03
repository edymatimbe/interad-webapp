<!DOCTYPE html>
<html>
<?php $company = get_by_id('company', ['id' => 1]) ?>

<head>
    <title>Invoice</title>
    <link href="<?= base_url(); ?>public/css/document.css" rel="stylesheet">
    <style>
        <?php if (isset($is_receipt)) : ?>header {
            position: fixed;
            top: -340px;
            left: 0;
            right: 0;
            height: 335px;
        }

        footer {
            position: fixed;
            bottom: -310px;
            left: 0;
            right: 0;
            height: 110px;
        }

        <?php else : ?>header {
            position: fixed;
            top: -340px;
            left: 0;
            right: 0;
            height: 260px;
        }

        footer {
            position: fixed;
            bottom: -450px;
            left: 0;
            right: 0;
            height: 420px;
            /* border: 1px solid black; */
        }

        /* main {
			bottom: -810px;
			left: 0;
			right: 0;
			height: 800px;
			border: 1px solid red;
		} */

        <?php endif; ?>@page {
            margin: 365px 40px 430px 40px;
        }

        #page .page:after {
            content: counter(page, decimal);
        }
    </style>
</head>

<body>


    <header class="">
        <section class="border-bottom-separator mb-2 " style="height: 180px;">
            <div class="float-left position-relative w-45 ">
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
                <div class="position-absolute pt-4" style="top: 60px">
                    <p class="my-0"><strong><?= $company->name ?></strong></p>
                    <?php if ($company->address) : ?>
                        <p class="my-0"><?= $company->address ?></p>
                    <?php endif; ?>
                    <p class="my-0"><?= $company->city ?></p>
                    <p class="my-0"><strong>Tel: </strong>
                        <?= $company->phone ? ' ' . $company->phone : '' ?>
                        <?= ($company->phone2) ? ' / ' . $company->phone2 : '' ?> </p>
                    <?php if ($company->email) : ?>
                        <p class="my-0"><strong>Email: </strong><?= $company->email ?></p>
                    <?php endif; ?>
                    <?php if ($company->nuit) : ?>
                        <p class="my-0"><strong>Nuit: </strong><?= $company->nuit ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="float-left pt-4 mt-5 ml-5 pl-5 " style="width: 30%; height: 80px; ">
                <div class="position-absolute ml-5 pl-5" style="width: 100%; height: 80px; ">

                </div>
            </div>
            <?php $t_name = 'cliente' ?>


            <div class="float-right pt-0 position-relative" style="width: 25%;height: 150px;">
                <div class="position-absolute" style="width: 100%; height: 70px; right: 0; top: 25px">
                 
                    <p class="my-0 text-left mt-5"><?= 'Exmo.(s) Sr.(s)' ?></p>
                    <p class="my-0 text-left">
                        <Strong><?= isset($customer) && !empty($customer) ? $customer->first_name . ' ' . $customer->last_name : 'Nome do cliente' ?></Strong>
                    </p>
                    <p class="my-0 text-left"><?= isset($customer) && !empty($customer) ? $customer->address : '### ## ### ####' ?></p>
                    <p class="my-0 text-left">Tell: <?= isset($customer) && !empty($customer) ? $customer->phone : '### ## ### ####' ?></p>
                    <p class="my-0 text-left">Nuit: <?= isset($customer) && !empty($customer) ? $customer->nuit : '#########' ?></p>
                    <p class="my-0 text-left">Enderenço: <?= isset($customer) && !empty($customer) ? $customer->address : '#########' ?></p>

                </div>
            </div>
        </section>


        <?php if (!isset($is_receipt)) : ?>
            <div class="position-relative " style="height: 50px;">
                <div class="position-absolute top-0 left-0" style="width: 50%">
                    <p class="my-0 text-left"><strong>Data
                            Emissão: </strong><?= simple_date($date) ?></p>
                    <p class="my-0 text-left"><strong>Data de
                            Vencimento: </strong><?= simple_date($expired_date) ?></p>
                    <p class="my-0 text-left"><strong>Prazo de
                            Pagamento: </strong><?= ' Pronto pagamento' ?>
                        <span class="float-right"></span>
                    </p>

                </div>
                <div class="position-absolute top-0 right-0" style="width: 60%">
                    <p class="my-1">&nbsp;</p>
                    <p class="my-1">&nbsp;</p>
                    <p class="my-1">&nbsp;</p>
                    <p class="my-1">&nbsp;</p>
                    <p class="my-1">&nbsp;</p>
                    <p class="text-right my-0"><strong><?= 'Recibo' ?> Nº <?= $number . ' / ' . date('Y') ?> </strong></p>
                    <p class="text-right my-0"><strong>Factura</strong></p>
                </div>

            </div>
        <?php else : ?>
            <div class="position-relative" style="height: 130px;">
                <div class="position-absolute top-0 left-0" style="width: 40%">
                    <p class="my-1 text-left"><strong>Data: </strong><?= simple_date($issued_at) ?></p>
                    <p class="my-1 text-left"><strong>Tipo de pagamento: </strong>
                        <span class="float-right">

                            <?= $payment_method_name ?>
                        </span>
                    </p>
                    <p class="my-1 text-left">
                        <strong><?= $this->lang->line('Amount_paid') ?></strong>
                        <span class="float-right">
                            <?= number_format($payment->amount, 2) ?>
                        </span>
                    </p>
                    <?php if ($payment->method_id == 1) : ?>
                        <p class="my-1 text-left">
                            <strong><?= $this->lang->line('amount_received') ?></strong>
                            <label class="float-right">
                                <?= number_format($payment->total_paid, 2) ?>
                            </label>
                        </p>
                        <p class="my-1 text-left">
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
                        <p class="my-1 text-left">
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
                        <p class="my-1 text-left">
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
                            <p class="my-1 text-left">
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
                <div class="position-absolute top-0 right-0" style="width: 60%">
                    <p class="my-1">&nbsp;</p>
                    <p class="my-1">&nbsp;</p>
                    <p class="my-1">&nbsp;</p>
                    <p class="my-1">&nbsp;</p>
                    <p class="my-1">&nbsp;</p>
                    <p class="text-right my-0"><strong><?= 'Recibo' ?> Nº <?= $number . ' / ' . date('Y') ?> </strong></p>
                    <p class="text-right my-0"><strong>Original</strong></p>
                </div>
            </div>
        <?php endif; ?>
    </header>


    <footer>
        <?php if (!isset($is_receipt)) : ?>

            <?php


            $total = $video_amount + $video_amount * 0.16;
            $subtotal = $video_amount;
            $tax =  $video_amount * 0.16;
            $discount = 0;
            ?>



            <?php $in_full = $this->core_model->por_extenso(number_format($total, 2, ',', '')) ?>
            <?php $in_full = str_replace(',', ' e ', str_replace('um mil', 'Mil', $in_full)) ?>
            <div class="border-top-separator position-relative" style="height: 90px; width: 100%">
                <div class="position-absolute left-0 top-0" style="width: 55%;">
                    <p class="text-center mb-2"><strong>Resumo do IVA</strong></p>
                    <table class="table table-small">
                        <thead>
                            <tr class="bg-light f-s-10 text-nowrap">
                                <th class="border-top border-left bg-white" style="width: 20%"><?= 'Taxa' ?></th>
                                <th class="border-top bg-white text-right" style="width: 50%"> <?= 'Base de Incidência' ?></th>
                                <th class="border-top text-right bg-white" style="width: 30%"><?= 'IVA' ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-top-0">16.00%</td>
                                <td class="border-top-0 text-right"><?= number_format($video_amount, 2) ?></td>
                                <td class="border-top-0 text-right"><?= number_format($tax, 2) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="position-absolute" style="width: 5%"></div>
                <div class="position-absolute top-0 right-0" style="width: 40%;">
                    <p class="mb-0">&nbsp;</p>
                </div>
            </div>

            <div class="position-relative" style="height: 100px">
                <div class="position-absolute top-0 left-0" style="width: 55%">
                    <div class="border px-2" style="height: 123px">
                        <p>
                            <strong>Por extenso:</strong>
                        </p>

                        <p class="text-capitalize"><?= $in_full ?></p>
                    </div>
                </div>
                <div class="position-absolute" style="width: 5%"></div>
                <div class="position-absolute top-0 right-0" style="width: 40%">
                    <div class="border">
                        <table class="table table-small table-small-border pb-0 mb-0">
                            <tbody>
                                <tr>
                                    <td class="border-right">Total antes de descontos</td>
                                    <td class="text-right"><?= number_format($subtotal, 2) ?></td>
                                </tr>
                                <tr>
                                    <td class="border-right">Desconto Comercial</td>
                                    <td class="text-right"><?= number_format(0, 2) ?></td>
                                </tr>
                                <tr>
                                    <td class="border-right">Desconto Financeiro</td>
                                    <td class="text-right"><?= number_format(0, 2) ?></td>
                                </tr>
                                <tr>
                                    <td class="border-right">Base de Incidência de I.V.A</td>
                                    <td class="text-right"><?= $tax ?></td>
                                </tr>
                                <tr>
                                    <td class="border-right">Total de I.V.A</td>
                                    <td class="text-right"><?= number_format($tax, 2) ?></td>
                                </tr>
                                <tr>
                                    <td class="border-right">Total do documento</td>
                                    <td class="text-right"><?= number_format($total, 2) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
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
            <div id="page">
                <p class="my-0 f-s-10">
                    <span class=""><?= $this->lang->line('document_processed') ?> / © <?= $company->name ?></span>
                    <span class="float-right page">Página </span>
                </p>
            </div>
        <?php else : ?>
            <?php $in_full = $this->core_model->por_extenso(number_format($total, 2, ',', '')) ?>
            <?php $in_full = str_replace(',', ' e ', str_replace('um mil', 'Mil', $in_full)) ?>
            <p class="mb-2 border-top-separator">
                <strong>Total:</strong>
                <span class="float-right"><strong><?= number_format($total, 2) ?></strong></span>
            </p>
            <p class="my-0">Extenso:</p>
            <p class="text-uppercase"><?= $in_full ?></p>.
            <br>
            <br>
            <p class="text-center"><strong>_______________________________________________</strong></p>
            <p class="text-center"><strong>( Assinatura e carimbo )</strong></p>
        <?php endif; ?>
    </footer>
    <main class='' style="margin-top: 	<?= ($table === 'invoice' || $table === 'quotation') ? '-95px' : '-10px' ?> !important; margin-bottom:-60px:">
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

        <?php else : ?>
            <table id="table" class="table table-small">
                <thead>
                    <tr>
                        <th class="border-top border-left" style="width: 20%"><?= "Tipo de documento" ?>
                        </th>
                        <th class="border-top" style="width: 20%"> <?= 'Número' ?></th>
                        <th class="border-top text-right" style="width: 15%"><?= 'Total' ?></th>
                        <th class="border-top text-right" style="width: 15%"><?= 'Pendente' ?></th>
                        <th class="border-top text-right" style="width: 15%"><?= 'Valor pago' ?></th>
                        <th class="border-top text-right border-right" style="width: 15%"><?= 'Remanescente' ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices as $invoice) : ?>
                        <tr>
                            <td class="border-to-0 text-left"><?= 'FACTURA' ?></td>
                            <td class="border-to-0 "><?= 'FT-' . $invoice->invoice_number ?></td>
                            <td class="border-to-0 text-right"><?= number_format($total, 2) ?></td>
                            <td class="border-to-0 text-right"><?= number_format(0, 2) ?></td>
                            <td class="border-to-0 text-right"><?= number_format($total, 2) ?></td>
                            <td class="border-to-0 text-right"><?= number_format(0, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>

</body>