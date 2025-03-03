<style>
    .select2-container--default .select2-selection--single {
        border: 1px solid #d1d3e2;
        border-radius: 3px;
        outline: none;
        height: 38px;
        padding-top: 5px;
        padding-left: 30px;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field {
        outline: none;
    }
</style>

<div class="row">
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-body row">
                <div class="col-lg-12 col-md-12">
                    <div id="div-select-customer">
                        <div class="d-flex position-relative">
                            <select id="select-customer" class="form-control select-cs rounded pl-5" style="width: 100%">
                                <option value=""><?= $this->lang->line('select') . ' ' . $this->lang->line('customer') ?></option>
                                <?php foreach (users_groups(['groups.id' => 3, 'users.active' => 1]) as $customer) : ?>

                                    <option <?= isset($customer_id) ? (($customer->user_id == $customer_id) ? 'selected' : '') : '' ?> value="<?= $customer->user_id ?>"><?= $customer->name ?>
                                    </option>

                                <?php endforeach; ?>
                            </select>
                            <i class="feather icon-user position-absolute border-right pr-2" style="left: 10px; top: 13px"></i>
                        </div>
                    </div>
                    <hr>


                    <ul class="list-group">
                        <li class="list-group-item  d-flex justify-content-between align-items-center">
                            <span>Factura nº</span> <strong class="float-right"><?= isset($controller) ? $controller->code : 0 ?></strong>
                        </li>
                        <li class="list-group-item  d-flex justify-content-between align-items-center">
                            <span>Data de emissão </span>
                            <strong class="float-right">
                                <?= isset($loan) ? date_format(date_create($loan->created_at), 'd-m-Y') : '' ?>
                            </strong>
                        </li>
                        <li class="list-group-item  d-flex justify-content-between align-items-center d-none">
                           
                            <strong class="float-right text-nowrap">
                                <button class="btn btn-sm btn-danger mx-2">Vencidas
                                    <span class="badge badge-dark">
                                        <?= isset($controller) ? count(get_all('controller', ['created_by' => $_POST['id'], 'status' => 'expirou'])) : 0 ?>
                                    </span>
                                </button>
                                <button class="btn btn-sm btn-warning mx-2">Pendentes
                                    <span class="badge badge-dark">
                                        <?= isset($controller) ? count(get_all('controller', ['created_by' => $_POST['id'], 'status' => 'pendente'])) : 0 ?>
                                    </span>
                                </button>
                                <button class="btn btn-sm btn-success">Pagas
                                    <span class="badge badge-dark">
                                        <?= isset($controller) ? count(get_all('controller', ['created_by' => $_POST['id'], 'status' => 'pago'])) : 0 ?>
                                    </span>
                                </button>
                            </strong>
                        </li>
                        <li class="list-group-item  d-flex justify-content-between align-items-center">
                            <span>Data de vencimento </span>
                            <strong class="float-right">
                                <?= isset($loan) ? date_format(date_create($loan->due_date), 'd-m-Y') . ' | ' : '' ?>
                                <?php if (isset($loan)) : ?>
                                    <?php if ($loan->status == 'aberto') : ?>
                                        <span class="text-info text-capitalize"><?= $loan->status ?></span>
                                    <?php elseif ($loan->status == 'vencido') : ?>
                                        <span class="text-warning text-capitalize"><?= $loan->status ?></span>
                                    <?php elseif ($loan->status == 'fechado') : ?>
                                        <span class="text-success text-capitalize"><?= $loan->status ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </strong>
                        </li>
                    </ul>
                    <ul class="list-group mt-3">
                        <li class="list-group-item ">
                            <span class="f-w-600"> Subtotal</span>
                            <span class="float-right"><?= number_format(isset($controller) ? $controller->cost : 0, 2) ?> MT</span>
                        </li>
                        <li class="list-group-item ">
                            <span class="f-w-600"> Taxa (imposto)</span>
                            <span class="float-right">(16 %) <?= isset($controller) ? $controller->cost * 0.16 . 'MT' : '' ?></span>
                        </li>
                        <li class="list-group-item">
                            <span class="f-w-600">Total</span>
                            <span class="float-right">
                                <?= isset($controller) ? number_format($controller->cost + $controller->cost * 0.16, 2) . ' MT' : 0 ?>
                            </span>
                        </li>
                        <li class="list-group-item text-success">
                            <span class="f-w-600"> Total pago</span>
                            <span class="float-right cart-total">
                                <?= number_format(isset($total_paid_all) ? $total_paid_all : 0, 2) ?> MT
                            </span>
                        </li>
                        <li class="list-group-item text-danger">
                            <span class="f-w-600"> Dívida total</span>
                            <span class="float-right cart-total">
                                <span id="total_debt_text"><?= isset($controller) ?  number_format($controller->cost + $controller->cost * 0.16, 2) : 0 ?></span>
                                MT
                            </span>
                            <input type="hidden" id="total_debt" value="<?= isset($controller) ?  number_format($controller->cost + $controller->cost * 0.16, 2) : 0 ?>">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-8">
        <div id="carousel-payment" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">
               
                <div class="carousel-item active">
                    <div class="card">
                        <datalist id="bankList">
                            <?php foreach (get_all('service', ['is_bank' => 1]) as $item) : ?>
                                <option value="<?= $item->name ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                        <div class="card-body card-payment">
                            <div class="row">
                                <div class="col-lg-4">

                                    <div class="form-group">
                                        <label for="amount">Valor a pagar</label>
                                        <div class="d-flex position-relative">
                                            <input type="text" class="form-control pr-10 f-s-30" id="paid" value="<?= isset($controller) ?  number_format($controller->cost + $controller->cost * 0.16, 2) : 0 ?>" readonly>
                                            <span class="position-absolute border-left pl-2 f-s-30" style="right: 10px; top: 10px">MT</span>
                                        </div>
                                    </div>
                                    <input type="hidden"  id="amount" value="<?= isset($controller) ? $controller->cost + $controller->cost * 0.16: 0 ?>" >
                                    <div class="form-group d-none">
                                        <label for="amount">Data de pagamento</label>
                                        <div class="d-flex position-relative">
                                            <input type="date" class="form-control  f-s-30" id="payment_date" value="<?= date('Y-m-d')  ?>">
                                        </div>
                                    </div>




                                    <div class="row row-cols-4 row-cols-lg-1 justify-content-center">
                                        <?php foreach ($this->core_model->get_all('payment_method', array('active' => 1, 'parent_id' => null)) as $item) : ?>
                                            <div class="col mb-3">
                                                <button value="<?= $item->id ?>" id="btn-payment-method-<?= $item->id ?>" class="btn btn-outline-secondary text-nowrap btn-block btn-payment-method <?= ($item->id == 1) ? 'bg-gray-200 text-info' : '' ?>" style="height: 70pt">
                                                    <?php if ($item->icon) : ?>
                                                        <i class="<?= $item->icon ?> icon" id="icon-method-<?= $item->id ?>"></i>
                                                    <?php else :; ?>
                                                        <i class="fa fa-mobile fa-2x icon" id="icon-method-<?= $item->id ?>"></i>
                                                    <?php endif; ?>
                                                    <br>
                                                    <span>
                                                        <?= $item->name ?>
                                                    </span>
                                                </button>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <br>
                                    <div id="div-payment-numeric">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-8 d-flex flex-column justify-content-center">
                                                <div class="card shadow-none border">
                                                    <div class="card-header bg-gray-200 ">
                                                        <h6 class="text-info card-text f-w-600 f-s-15">Valor
                                                            recebido</h6>
                                                    </div>
                                                    <div class="card-body pb-0">
                                                        <div class="form-group">
                                                            <div class="d-flex position-relative">
                                                                <input type="text" class="form-control pr-10 f-s-30" id="total-paid">
                                                                <span class="position-absolute border-left pl-2 f-s-30" style="right: 10px; top: 10px">MT</span>
                                                            </div>
                                                        </div>
                                                        <input id="change" readonly type="hidden" value="<?= 0 ?>">
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-center mb-0 f-s-15 f-w-700">
                                                            <span class="text-capitalize"><?= $this->lang->line('change') ?>:</span>
                                                            <span id="change_s">0</span>
                                                            <span>&nbsp;MT</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="div-payment-card" class="d-none border rounded p-3">
                                        <div class="form-group">
                                            <input type="hidden" id="bank-service">
                                            <h6 class="f-s-14 text-center bg-gray-200 rounded py-2 text-info f-w-600"><?= $this->lang->line('kind_service') ?></h6>
                                            <div class="row row-cols-3 justify-content-center">
                                                <?php foreach ($this->core_model->get_all('payment_method', array('active' => 1, 'parent_id' => 2)) as $item) : ?>
                                                    <div class="col mb-3">
                                                        <button value="<?= $item->id ?>" data-parent="2" class="btn btn-outline-secondary text-nowrap btn-block btn-bank-service" style="height: 70pt">
                                                            <?php if ($item->icon) : ?>
                                                                <i class="<?= $item->icon ?>"></i>
                                                            <?php else :; ?>
                                                                <i class="fa fa-credit-card fa-2x"></i>
                                                            <?php endif; ?>
                                                            <br>
                                                            <span>
                                                                <?= $item->name ?>
                                                            </span>
                                                        </button>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <div id="div-input-bank">
                                            <?php $this->load->view('payment/input_check') ?>
                                        </div>
                                    </div>
                                    <div id="div-payment-mobile" class="d-none border rounded p-3">
                                        <h6 class="f-s-14 text-center bg-gray-200 rounded py-2 text-info f-w-600"><?= $this->lang->line('kind_service') ?></h6>

                                        <div class="form-group">
                                            <input type="hidden" id="mobile-service">
                                            <div class="row row-cols-3 justify-content-center">
                                                <?php foreach ($this->core_model->get_all('payment_method', array('active' => 1, 'parent_id' => 4)) as $item) : ?>
                                                    <div class="col mb-3">
                                                        <button value="<?= $item->id ?>" data-parent="4" class="btn btn-outline-secondary text-nowrap btn-block btn-mobile-service" style="height: 70pt">
                                                            <i class="fa fa-mobile-alt fa-2x mb-2"></i>
                                                            <br>
                                                            <span>
                                                                <?= $item->name ?>
                                                            </span>
                                                        </button>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mobile_holder"><?= $this->lang->line('owner') ?>
                                                        <span class="text-danger">&nbsp;*</span></label>
                                                    <input type="text" class="form-control" id="mobile_holder" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mobile_number"><?= $this->lang->line('phone') ?>
                                                        <span class="text-danger">&nbsp;*</span></label>
                                                    <input type="text" class="form-control" id="mobile_number" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group" id="div-reference">
                                            <label for="mobile_reference"><?= $this->lang->line('reference') ?><span class="text-danger">&nbsp;*</span></label>
                                            <input type="text" class="form-control" id="mobile_reference" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="controller_id" value="<?= isset($controller) ? $controller->id : 0 ?>">
                    <input type="hidden" id="customer_id" value="<?= isset($controller) ? $customer_id: 0 ?>">
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <button id="btn-pay" onclick="savePayment()" <?= isset($controller) ? (($controller->cost + $controller->cost * 0.16)>0? '' :'disabled'):'disabled' ?> class="btn btn-success waves-effect waves-green" type="button"><i class="feather icon-save mr-2"></i>Pagar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script !src="">
    // $(document).ready(function() {
    //     $('#select-customer').select2();
    //     setFullHeight('#card-body-payment', 0);
    // })
</script>