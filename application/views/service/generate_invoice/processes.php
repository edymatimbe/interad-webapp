<?php foreach ($processes as $item) : ?>
    <?php $service = get_by_id('product', ['id' => $item->process_type_id]); ?>
    <tr class="read">
        <td style="width:20% ;">
            <div class="check-star">
                <div class="form-group d-inline mr-5">
                    <div class="checkbox checkbox-primary checkbox-fill d-inline">
                        <button class="btn btn-sm waves-effect waves-light btn-outline-success border border-success" onclick="form_detail(<?= $item->id ?>)">
                            <i class="feather icon-chevrons-left m-0"></i>
                        </button>
                    </div>
                </div>
                <strong><?= $item->code ?></strong>
            </div>
        </td>
        <td style="width:20% ;"><a href="email_read.html" class="email-name waves-effect"><?= $service->name ?></a></td>
        <td style="width:20% ;"><a href="email_read.html" class="email-name waves-effect"><?= get_by_id('customer', ['id' => $item->beneficiary_id])->name ?></a></td>
        <td style="width:20% ;" class="text-cemter"><?= $item->company ?></td>
        <td style="width:20% ;" class="text-cemter"><?= $item->created_at ?></td>
    </tr>
<?php endforeach ?>


<div class=" d-none">
    <?php foreach ($processes as $item) : ?>
        <?php $service = get_by_id('product', ['id' => $item->process_type_id]); ?>
        <div class="card card-border-c-blue" style="z-index: 999">
            <div class="card-body px-0 pt-0">
                <div class="">
                    <h5 class="d-flex justify-content-between m-b-10 w-100 p-3 rounded-top shadow-sm ">
                        <i class="feather icon-layers mr-2"> &nbsp; <?= get_by_id('product', ['id' => $item->process_type_id])->name ?></i>
                        <strong>Nr <?= $item->code ?></strong>
                    </h5>
                </div>
                <div class="px-3">
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0 ">Instituição: <label class="font-weight-bold float-right"><?= $item->company  ?></label></li>
                                <li class="list-group-item px-0 ">Beneficiario: <label class="font-weight-bold float-right"><?= get_by_id('customer', ['id' => $item->beneficiary_id])->name ?></label>
                                </li>
                                <li class="list-group-item px-0">Data de registo:
                                    <label class="float-right font-weight-bold">
                                        <?= date_format(date_create($item->created_at), 'd-m-Y') ?>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div id="accordion">
                        <ul class="list-group f-s-14 border border-warning mb-2" id="headingOne<?= $item->id  ?>">
                            <li class="list-group-item  shadow m-0">
                                <label class="f-w-600 mt-1">
                                    <button class="btn waves-effect waves-light btn-primary" onclick="show_process(<?= $item->id ?> , <?= $item->process_type_id ?>)">
                                        <i class="feather icon-eye m-0 mr-2"></i>Ver o processo
                                    </button>
                                </label>
                                <label class="float-right text-capitalize">
                                    <button class="btn btn-secondary" data-toggle="collapse" data-target="#collapse<?= $item->id  ?>" aria-expanded="true" aria-controls="collapse<?= $item->id  ?>">
                                        <i class="feather icon-chevrons-down"></i>&nbsp;Nova factura
                                    </button>
                                </label>
                            </li>
                            <li class="list-group-item  shadow m-0 collapse" id="collapse<?= $item->id  ?>" aria-labelledby="heading<?= $item->id  ?>" data-parent="#accordion">
                                <form id="form-invoicing" method="post" autocomplete="off" class="h-100">
                                    <input type="hidden" name="id" value="<?= $item->id  ?>">
                                    <input type="hidden" name="product_id" value="<?= $service->id  ?>">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group inputBox no-icon">
                                                <input type="text" class="form-control" id="other_price" name="other_price" value="<?= $service->price  ?>">
                                                <label for="other_price"><?= 'Preço' ?> <span class="text-danger">&nbsp;*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group inputBox no-icon">
                                                <input type="text" class="form-control" id="percent" name="percent" value="<?= 17 ?>">
                                                <label for="percent"><?= 'Taxa (%)' ?> <span class="text-danger">&nbsp;*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group inputBox no-icon">
                                                <input type="text" class="form-control" id="subtotal" name="subtotal" value="<?= $service->price * 0.16  ?>">
                                                <label for="subtotal"><?= 'Subtotal' ?> <span class="text-danger">&nbsp;*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group inputBox no-icon">
                                                <input type="text" class="form-control" id="total" name="total" value="<?= $service->price + ($service->price * 0.16) ?>">
                                                <label for="total"><?= 'Total' ?> <span class="text-danger">&nbsp;*</span></label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-1">
                                            <button class="btn btn-success float-right br-2 text-nowrap has-ripple" type="submit">
                                                <i class=" fa fa-save">&nbsp;</i> <?= $this->lang->line('save') ?> <span class="ripple ripple-animate" style="height: 161.024px; width: 161.024px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -56.4659px; left: -176.093px;"></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>