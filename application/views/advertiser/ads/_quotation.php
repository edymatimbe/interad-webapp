<div class="modal-content bg-light">
    <div class="modal-header">
        <h5 class="modal-title">Factura </h5>
        <div class="div">
            <a href="" class="btn btn-primary" onclick="invoice_pdf(<?= $controller_id ?>)"> Imprimir&nbsp;<i class="feather icon-printer"></i></a>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="page-body">
            <div class="container-xl">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <p style="">
                                    <?php if ($company->image) : ?>
                                        <?php if (is_file(FCPATH . $company->image)) : ?>
                                            <img width="175" src="<?= base_url($company->image) ?>" alt="image">
                                        <?php else : ?>
                                            <img width="175" src="<?= base_url('public/img/logo/invoice_logo.jpg') ?>" alt="image">
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <img width="175" src="<?= base_url('public/img/logo/invoice_logo.jpg') ?>" alt="image">
                                    <?php endif; ?>
                                </p>
                                <div class=" pl-2">
                                    <?php if ($company->nuit) : ?>
                                        <p class="my-1">Nuit: <?= $company->nuit ?></p>
                                    <?php endif; ?>
                                    <?php if ($company->address) : ?>
                                        <p class="my-1"><?= ($company->address) . '' . ($company->city ? ', ' . $company->city : '') ?></p>
                                    <?php endif; ?>
                                    <p class="my-1">
                                        <?= $company->phone ? 'Cell: ' . $company->phone : '' ?> <?= ($company->phone2) ? ' / ' . $company->phone2 : '' ?> </p>
                                    <?php if ($company->email) : ?>
                                        <p class="my-1">Email: <?= $company->email ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-3 ">
                                <p class="my-0 text-left h3"><?= 'Exmo.(s) Sr.(s)' ?></p>
                                <p class="my-0 text-left">
                                    <Strong><?= isset($customer) && !empty($customer) ? $customer->first_name . ' ' . $customer->last_name : 'Nome do cliente' ?></Strong>
                                </p>
                                <p class="my-0 text-left"><?= isset($customer)   && !empty($customer) ? $customer->address : '### ## ### ####' ?></p>
                                <p class="my-0 text-left"> Contacto : <?= isset($customer)   && !empty($customer) ? $customer->phone : '### ## ### ####' ?></p>
                                <p class="my-0 text-left"> Nuit : <?= isset($customer)   && !empty($customer) ? $customer->nuit : '#########' ?></p>
                                <p class="my-0 text-left"> Email : <?= isset($customer)   && !empty($customer) ? $customer->email : '#########' ?></p>
                                <p class="my-0 text-left"> Endereço : <?= isset($customer)   && !empty($customer) ? $customer->address : '#########' ?></p>
                            </div>
                            <div class="row py-5 border-top">
                                <div class="col-6">
                                    <p class="my-0 "><strong>Data
                                            Emissão: </strong><?= simple_date(date("Y-m-d")) ?></p>
                                    <p class="my-0 "><strong>Data de
                                            Vencimento: </strong><?= simple_date(date("Y-m-d")) ?></p>
                                    <p class="my-0 "><strong>Prazo de
                                            Pagamento: </strong><?= ' Pronto pagamento' ?>
                                        <span class="float-end"></span>
                                    </p>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="text-end my-0"><strong> Factura Nº <?= isset($type) && $type == 'saved'? $code : $this->core_model->code_generator('controller')  ?><?='/'.date('Y') ?> </strong></p>
                                    <p class="text-end my-0"><strong>Original</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table  border-collapse border table-sm ">
                                <thead>
                                    <tr class="">
                                        <th class="text-center" style="width: 10%;"><?= $this->lang->line('quantity') ?></th>
                                        <th class="text-center" style="width: 10%;">Unidades</th>
                                        <th class=" " style="width: 40%;"> <?= 'Descrição' ?></th>
                                        <th class=" text-end" style="width: 20%;"><?= $this->lang->line('Unit_price') ?></th>
                                        <th class=" text-end" style="width: 20%;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">10 </td>
                                        <td class="text-center">dias</td>
                                        <td> Duração da campanha</td>
                                        <td class="text-end" rowspan="3" style=" border: 1px solid; border-color: inherit"> <?= number_format($video_amount,2). ' MT' ?></td>
                                        <td class="text-end" rowspan="3" style=" border: 1px solid; border-color: inherit"><?= number_format($video_amount,2). ' MT' ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2 </td>
                                        <td class="text-center">qty</td>
                                        <td> Número de veículos </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2 </td>
                                        <td class="text-center">minutos</td>
                                        <td> Duração do spot </td>
                                    </tr>
                                </tbody>
                                <tfoot class="border bg-light">
                                    <tr class="">
                                        <td colspan="3" rowspan="4" style=" border: 1px solid; border-color: inherit"></td>
                                        <td class="text-end">Subtotal</td>
                                        <td class="text-end"><?= number_format($video_amount,2) ?> MT</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end">Desconto</td>
                                        <td class="text-end">0 MT</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end">IVA ( 16% )</td>
                                        <td class="text-end"><?= number_format($video_amount*0.16,2) ?> MT</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end">Total</td>
                                        <td class="text-end"><?= number_format($video_amount+$video_amount*0.16,2) ?> MT</td>
                                    </tr>
                                </tfoot>
                            </table>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
    </div>
</div>
