<?php $this->load->view('layout/header') ?>

<!--<style>-->
<!--    .select2-container--default .select2-selection--single {-->
<!--        border: 1px solid #d1d3e2;-->
<!--        border-radius: 3px;-->
<!--        outline: none;-->
<!--        height: 38px;-->
<!--        padding-top: 5px;-->
<!--        padding-left: 30px;-->
<!--    }-->
<!---->
<!--    .select2-container--default .select2-search--dropdown .select2-search__field {-->
<!--        outline: none;-->
<!--    }-->
<!--</style>-->
<div class="col-12 mb-3">
    <div class="row justify-content-between bg-white py-2 rounded">
        <div class="col-6 mb-lg-0 pt-2">
            <i class="fa fa-money-check text-micro border-right pr-2"></i>
            <label for=""><?= $this->lang->line('payments') ?></label>
        </div>
        <div class="col-6">
            <a class="btn btn-dark float-right text-nowrap"
               type="button" href="<?= base_url('add-payment') ?>">
                <i class="feather icon-plus">&nbsp;</i><?= $this->lang->line('new') . ' ' . $this->lang->line('payment') ?>
            </a>
        </div>
    </div>
</div>

<div class="card shadow mb-4" data-aos="fade-down" data-aos-delay="200">
    <div class="card-body">
        <div class="row mb-lg-2">
            <div class="col-md-3 form-group position-relative">
                <div id="select-date"
                     class="form-control w-100 cursor-pointer d-flex justify-content-between px-2">
                    <div class="">
                        <i class="feather icon-calendar"></i>&nbsp;
                    </div>
                    <span class="f-s-14"><?= 'Hoje' ?></span>
                    <i class="fa fa-caret-down mt-1"></i>
                </div>
                <label for="" class="position-absolute bg-white px-1" style="top: -10px;left: 25px">
                    Data de pagamento
                </label>
            </div>
            <div class="col-md-3">
                <div class="form-group inputBox">
                    <select id="select-pay-method" class="select2-no-search w-100" onchange="filter_payments()">
                        <option value="">Todas</option>
                        <?php foreach ($this->core_model->get_all('payment_method', array('active' => 1, 'in_select' => 1)) as $item): ?>
                            <option value="<?= $item->id ?>"><?= $item->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="select-pay-method"><?= 'Forma de pagamento' ?></label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="inputBox">
                    <select id="select-customer" class="form-control">
                        <option value="">Todos</option>
                        <?php foreach (users_groups(['groups.id' => 3, 'users.active' => 1]) as $customer): ?>
                            <option value="<?= $customer->user_id ?>"><?= $customer->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="select-customer">Cliente</label>
                </div>
            </div>
            <div class="col d-flex justify-content-end">
                <div class="">

                    <div class="btn-group">
                        <button class="btn btn-outline-dark dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-file mr-2"></i>Exportar
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#!" onclick="export_payment('pdf')"><i
                                        class="fa fa-file-pdf-o text-danger mr-2"></i>PDF</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#!" onclick="export_payment('excel')"><i
                                        class="fa fa-file-excel-o text-success mr-2"></i>EXCEL</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive scroll">
            <table class="table table-bordered" id="table-payment">
                <thead>
                <tr class="text-nowrap">
                    <th style="width: 5%" class="text-center">#</th>
                    <th style="width: 10%"
                        class="text-left"><?= $this->lang->line('Forms') . ' ' . $this->lang->line('of') . ' ' . $this->lang->line('receipt') ?></th>
                    <th style="width: 25%" class="text-capitalize"><?= $this->lang->line('customer') ?></th>
                    <th style="width: 20%"
                        class="text-left"><?= 'Forma de ' . $this->lang->line('payment') ?></th>
                    <th style="width: 15%" class="text-right pr-4"> <?= 'Valor pago' ?></th>
                    <th style="width: 15%" class="text-center"><?= 'Data' ?></th>
                    <th style="width: 10%" class="text-center no-sort"><?= $this->lang->line('actions') ?></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="<?= base_url() ?>public/vendor/moment/moment.js"></script>

<script>
    let target = '';
    let firstDate = moment().format('YYYY-MM-DD');
    let lastDate = moment().format('YYYY-MM-DD');

    $('#menu-payment').addClass('active pcoded-trigger');
    $('#menu-payment .index').addClass('active');
    $('#menu-payment .pcoded-submenu').css('display', 'block');

    $(document).ready(function () {
        filter_payments();
        $("#select-customer").select2({
            "language": {
                "noResults": function () {
                    return "Sem resultado encontrado";
                }
            }
        }).on('select2:select', function (e) {
            filter_payments()
        });

        $('#select-date').daterangepicker({
            ranges: {
                'Hoje': [moment(), moment()],
                'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Últimos 7 Dias ': [moment().subtract(6, 'days'), moment()],
                'Últimos 30 Dias': [moment().subtract(29, 'days'), moment()],
                'Este mês': [moment().startOf('month'), moment().endOf('month')],
                'Mês Passado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            showDropdowns: true,
            startDate: moment(),
            endDate: moment(),
            locale: {
                applyLabel: "Aplicar",
                cancelLabel: 'Cancelar',
                startLabel: 'Date initiale',
                endLabel: 'Date limite',
                customRangeLabel: 'Customizar',
                daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
                monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                firstDay: 1
            }
        }, function (start, end, label) {

            firstDate = start.format('YYYY-MM-DD');
            lastDate = end.format('YYYY-MM-DD');
            $('#select-date span').html(label);
            filter_payments()
        });
    });

    function get_payment_details(id) {
        $.ajax({
            url: '<?=base_url('payment/get_details')?>',
            type: 'POST',
            data: {id: id},
            beforeSend: function () {
                show_loader();
            },
            success: function (data) {
                close_loader();
                $('#modal-sm-content').html(data);
                $('#modal-sm').modal('show')
            },
            error: function () {
                close_loader()
            }
        });
    }

    function get_payment_receipt(id, target) {
        $.ajax({
            url: '<?=base_url('payment/getReceipt')?>',
            type: 'POST',
            data: {id: id, target: target},
            beforeSend: function () {
                show_loader();
            },
            success: function (data) {
                close_loader();
                if (target === 'modal') {
                    $('#modal-sm-2-content').html(data.modal);
                    $('#modal-sm-2').modal('show')
                } else {
                    printJS({
                        printable: data.pdf,
                        type: 'pdf',
                        base64: true
                    })
                }
            }, error: function () {
                close_loader()
            }
        });
    }

    function filter_payments() {
        const customer = $('#select-customer').val();
        const payment_method = $('#select-pay-method').val();
        const dataSide = {
            language: {
                paginate: {
                    next: "<i class='fa fa-angle-right'></i>",
                    previous: "<i class='fa fa-angle-left'></i>",
                },
                emptyTable: "Sem dados disponíveis na tabela"
            },
            bDestroy: true,
            bSort: false,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?=base_url('payment/filter')?>",
                dataType: "json",
                type: "POST",
                data: {
                    payment_method: payment_method,
                    customer: customer,
                    init_date: firstDate,
                    final_date: lastDate,
                }
            },
            columns: [
                {data: "counter"},
                {data: "receipt"},
                {data: "customer"},
                {data: "pay_method_name"},
                {data: "amount"},
                {data: "created_at"},
                {data: "action"},
            ]
        };
        initDataTableServer('table-payment', dataSide);
    }

    function export_payment(action) {
        const customer = $('#select-customer').val();
        const payment_method = $('#select-pay-method').val();
        $.ajax({
            type: 'POST',
            url: '<?= base_url('payment/filter_export') ?>',
            dataType: "JSON",
            data: {
                payment_method: payment_method,
                customer: customer,
                init_date: firstDate,
                final_date: lastDate,
                action: action
            },
            beforeSend: function () {
                $("#loader-two").fadeIn();
            },
            success: function (data) {
                $("#loader-two").fadeOut();
                if (data.ok) {
                    // show_toast_success(data.message);
                    if (data.action === 'excel') {
                        window.open('<?=base_url('report/download_excel')?>');
                    } else {
                        printJS({
                            printable: data.file,
                            type: 'pdf',
                            base64: true
                        });
                    }
                } else {
                    show_toast_error(data.message)
                }
            }
        });
    }
</script>


<?php $this->load->view('layout/footer') ?>
