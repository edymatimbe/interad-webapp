<?php $this->load->view('layout/header') ?>
<style>
    .sticky-col {
        position: -webkit-sticky !important;
        position: sticky !important;
    }

    .first-col {
        width: 250px;
        min-width: 250px;
        left: 0;
    }

    .last-col {
        width: 140px;
        min-width: 140px;
        right: 0;
    }

    table tbody .sticky-col {
        background-color: white !important;
    }

    .tableFixHead th.sticky-col {
        z-index: 4;
    }

    /*.second-col {*/
    /*    width: 150px;*/
    /*    min-width: 150px;*/
    /*    max-width: 150px;*/
    /*    left: 100px;*/
    /*}*/
</style>
<div class="col-12 mb-3">
    <div class="row justify-content-between bg-white py-2 rounded">
        <div class="col-6 mb-lg-0 py-2">
            <i class="feather icon-upload text-micro border-right pr-2"></i>
            <label for=""><?= $title ?></label>
        </div>
        <div class="col-6">
            <a href="<?= base_url('assiduity') ?>" class="btn btn-dark float-right br-2 text-nowrap has-ripple">
                <i class="feather icon-list mr-2"></i>Lista
            </a>
        </div>
    </div>
</div>
<div class="shadow bg-white border-0 rounded br-3">
    <div class="bg-white mb-1">
        <div class="row d-flex justify-content-between px-3 pt-4">
            <div class="col-md-7">
                <form class="mb-sm-3 mb-3 mb-lg-0 " id="form-import-presences">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="input-file-box border-2 br-3" for="file" style="height: 38px; width: 100%">
                                <input name="file" type="file" id="file" class="input-file w-100" accept=".xls, .xlsx" onchange="uploadFile(this)">
                                <label for="file" title="Ficheiro de presenças">
                                    <span id="file-name" class="file-box mt-1 pl-3"></span>
                                    <label class="file-button bg-light-2 pt-2 cursor-pointer" id="btn-file" for="file" title="Carregar ficheiro de presenças">
                                        <i class="fa fa-upload" aria-hidden="true"></i>
                                        Carregar ficheiro
                                    </label>
                                </label>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary py-2" type="button" disabled id="btn-print-nominal" onclick="print_nominal()">
                                <i class="feather icon-printer mr-2"></i>Imprimir lista nominal
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <div class="row justify-content-end">
                    <div class="col-md-5 col-sm-4 col-12">
                        <div class="inputBox">
                            <input id="month" type="text" readonly class="bg-white">
                            <label for="month">Mes</label>
                            <i class="fa fa-calendar-check-o"></i>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="inputBox">
                            <input id="year" type="text" readonly class="bg-white">
                            <label for="year">Ano</label>
                            <i class="fa fa-calendar-week"></i>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="inputBox">
                            <input name="working_days" id="working_days" type="text" readonly class="bg-white">
                            <label for="working_days">Dias úteis</label>
                            <i class="fa fa-calendar-o"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-none table-card">
        <div class="card-body p-0">
            <div class="table-responsive scroll tableFixHead position-relative" style="overflow-y: auto" id="div-table-nominal">
                <table class="table table-bordered mb-0" id="table-nominal">
                    <thead>
                        <tr class="py-5">
                            <th class="sticky-col first-col" style="width: 30%">
                                <div class="chk-option">
                                    <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                        <input type="checkbox" class="custom-control-input" id="check-all-presence">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </div>
                                <label for="check-all-presence">Funcionário</label>
                            </th>
                            <th style="width: 10%;" class="text-center">Código</th>
                            <th style="width: 10%;" class="text-right">Salário bruto</th>
                            <th style="width: 10%;" class="text-right">INSS</th>
                            <th style="width: 10%;" class="text-right">IRPS</th>
                            <th style="width: 15%;" class="text-right">Salário líquido</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($employees as $key => $employee) : ?>
                            <?php $irpsinss = calculate_tax($employee->salary, $employee->inss_id, $employee->dependents_count) ?>
                            <tr id="tr-employee-<?= $employee->id ?>">
                                <td class="sticky-col first-col">
                                    <div class="chk-option">
                                        <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                            <input type="checkbox" class="custom-control-input input-check-presence" data-id="<?= $employee->id ?>" id="check-<?= $employee->id ?>">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                    <div class="d-inline-block align-middle">
                                        <?php if ($employee->image) : ?>
                                            <?php if (is_file(FCPATH . $employee->image)) : ?>
                                                <img id="image-<?= $employee->id ?>" class="img-radius align-top m-r-15" width="40" src="<?= base_url($employee->image) ?>" alt="image">
                                            <?php else : ?>
                                                <img class="img-radius align-top m-r-15" width="40" src="<?= base_url('public/img/avatar/' . $employee->gender . '_avatar.svg') ?>" alt="image">
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <img class="img-radius align-top m-r-15" width="40" src="<?= base_url('public/img/avatar/' . $employee->gender . '_avatar.svg') ?>" alt="image">
                                        <?php endif; ?>
                                        <label class="d-inline-block" for="check-<?= $employee->id ?>">
                                            <h6><?= $employee->first_name . ' ' . $employee->last_name ?></h6>
                                            <p class="text-muted m-b-0"><?= get_job_name($employee->job_id) ?></p>
                                        </label>
                                    </div>
                                </td>
                                <td class="text-center"><?= $employee->presence_code ?></td>
                                <td class="text-right"><?= this_number_format($employee->salary) ?></td>
                                <td class="text-right"><?= this_number_format($irpsinss['inss_amount']) ?></td>
                                <td class="text-right"><?= this_number_format($irpsinss['irps_amount']) ?></td>
                                <td class="text-right"><?= this_number_format($irpsinss['net_salary']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<!--ul-li{$}*2-->

<script>
    setFullHeight('#div-table-nominal', -110);
</script>
<input type="hidden" name="no_presences">
<input type="hidden" name="no_presences_id">
<input type="hidden" name="already_imported">
<input type="hidden" name="already_imported_id">
<script type="text/javascript">
    let file_name = '';
    const form_presences = $('#form-import-presences');
    let employeesIDS = [];


    function uploadFile(target) {
        form_presences.trigger('submit')
    }

    form_presences.on('submit', function(event) {
        event.preventDefault();
        const data = new FormData(this);
        $.ajax({
            url: "<?= base_url('uploads/import_presences') ?>",
            method: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            beforeSend: function() {
                show_loader()
            },
            success: function(data) {
                close_loader();
                console.log(data);
                // if (data.ok) {
                  
                //     show_message(data.message, data.status);
                // }
            },
            error: function() {
                close_loader();
                show_message('Erro ao importar ficheiro', 'error')
            }
        })
    });

    $(document).on('change', '#check-all-presence', function() {
        $("input.input-check-presence:checkbox").prop('checked', $(this).prop("checked"));
        verify_employees();
    });

    $(document).on('change', '.input-check-presence', function() {
        if ($('.input-check-presence:not(:checked)').length === 0) {
            $('#check-all-presence').prop('checked', true)
        } else {
            $('#check-all-presence').prop('checked', false)
        }
        verify_employees();
    });

    function print_nominal() {
        $.ajax({
            url: "<?= base_url('payment/print_nominal') ?>",
            method: "POST",
            dataType: 'JSON',
            data: {
                ids: JSON.stringify(employeesIDS)
            },
            beforeSend: function() {
                show_loader()
            },
            success: function(data) {
                close_loader();
                printJS({
                    printable: data.file,
                    type: 'pdf',
                    base64: true
                })
            },
            error: function() {
                close_loader();
                show_message('Erro ao ...', 'error')
            }
        })
    }

    function check_employee() {
        if (employeesIDS.length <= 0) {
            show_message('Selecione funcionários', 'warning')
        }
    }

    function verify_employees() {
        const checksChecked = $('.input-check-presence:checked');
        employeesIDS = [];
        checksChecked.each(function() {
            const id = $(this).attr('data-id');
            employeesIDS.push(id)
        });

        if (employeesIDS.length > 0) {
            $('#btn-file').removeClass('bg-light-2').addClass('bg-primary text-white');
            $('#file').removeAttr('disabled');
            $('#btn-print-nominal').removeAttr('disabled');
        } else {
            $('#file').prop('disabled', true);
            $('#btn-file').removeClass('bg-primary text-white').addClass('bg-light-2');
            $('#btn-print-nominal').prop('disabled', true);
        }
    }
</script>
<?php $this->load->view('layout/footer') ?>