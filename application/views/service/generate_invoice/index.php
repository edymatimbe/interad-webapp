<?php $this->load->view('layout/header') ?>

<div class="col-12 mb-3">
    <div class="row justify-content-between bg-white py-2 rounded">
        <div class="col-6 mb-lg-0 pt-2">
            <i class="feather icon-server text-micro border-right pr-2"></i>
            <label for=""><?= $title ?></label>
        </div>
        <div class="col-3">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card email-card">
            <div class="card-body">
                <div class="mail-body">
                    <div class="row">
                        <!-- [ inbox-left section ] start -->
                        <div class="col-xl-3 col-md-4 border-right" id="render1">

                            <ul class="list-group list-group-flush border px-3 d-none">
                                <li class="list-group-item px-0 ">Numero de processos: <label class="font-weight-bold float-right"><?= count($processes) ?></label></li>
                            </ul>
                        </div>
                        <!-- [ inbox-left section ] end -->
                        <!-- [ inbox-right section ] start -->
                        <div class="col-xl-9 col-md-8 inbox-right">
                            <div class="tab-content p-0">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <ul class="nav nav-pills nav-fill mb-0" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-primary-tab" data-toggle="pill" href="#pills-primary" role="tab" aria-controls="pills-primary" aria-selected="true"><span><i class="feather icon-grid"></i>
                                                    Codigo</span></a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link active" id="pills-social-tab" data-toggle="pill" href="#pills-social" role="tab" aria-controls="pills-social" aria-selected="false"><span><i class="feather icon-clipboard"></i>
                                                    Tipo de processo</span></a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link active" id="pills-Promotion-tab" data-toggle="pill" href="#pills-Promotion" role="tab" aria-controls="pills-Promotion" aria-selected="false"><span><i class="feather icon-user-check"></i>
                                                    Beneficiário(a)</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-update-tab" data-toggle="pill" href="#pills-update" role="tab" aria-controls="pills-update" aria-selected="false"><span><i class="feather icon-home"></i>
                                                    Empresa</span></a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link active" id="pills-forum-tab" data-toggle="pill" href="#pills-forum" role="tab" aria-controls="pills-forum" aria-selected="false"><span><i class="feather icon-clock"></i>
                                                    Data de entrada</span></a>
                                        </li>
                                    </ul>

                                    <div class="mail-body-content table-responsive mt-1" id="render">
                                        <table class="table">
                                            <tbody>
                                                <?= $this->load->view('service/generate_invoice/processes', ['processes' => $processes], true) ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- [ inbox-right section ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row d-none">
    <div class="col-md-5 col-lg-4">
        <div class="card pb-0">
            <div class="card-header">
                <h5>Filtros</h5>
            </div>
            <div class="card-body">
                <div class="position-relative">
                    <div id="select-created_date" class="form-control w-100 cursor-pointer d-flex justify-content-between px-2">
                        <div class="">
                            <i class="feather icon-calendar"></i>&nbsp;
                        </div>
                        <span class="f-s-14"><?= 'Todos' ?></span>
                        <i class="fa fa-caret-down mt-1"></i>
                    </div>
                    <label for="" class="position-absolute bg-white px-1" style="top: -10px;left: 25px">
                        Data da operação
                    </label>
                </div>

            </div>
        </div>
        <div class="card pb-0">
            <div class="card-header">
                <h5>Estatistica</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush border px-3">
                    <li class="list-group-item px-0 ">Numero de processos: <label class="font-weight-bold float-right"><?= count($processes) ?></label></li>

                </ul>
            </div>
        </div>
        <!-- <div id="div-list-loans" class="scroll" style="overflow-y: auto;overflow-x: hidden"></div> -->
    </div>
    <div class="col-md-7 col-lg-8 scroll" style="overflow-y: auto; overflow-x: hidden" id="render">
        <?= $this->load->view('service/generate_invoice/processes', ['processes' => $processes], true) ?>
    </div>
</div>


<script src="<?= base_url() ?>public/vendor/moment/moment.js"></script>

<script !src="">
    $('#menu-loan').addClass('active pcoded-trigger');
    $('#menu-loan .pending').addClass('active');
    $('#menu-loan .pcoded-submenu').css('display', 'block');




    function form_detail(id) {
        $.ajax({
            url: '<?= base_url('service/form_detail') ?>',
            type: 'POST',
            data: {
                id: id,
            },
            beforeSend: function() {
                show_loader();
            },
            success: function(data) {
                close_loader();
                $('#render1').html(data)

            },
            error: function() {
                close_loader();
                show_toast_error('error')
            }
        });
    }

    function show_process(id, process_type) {
        $.ajax({
            url: '<?= base_url('process/show_process') ?>',
            type: 'POST',
            data: {
                id: id,
                process_type: process_type
            },
            beforeSend: function() {
                show_loader();
            },
            success: function(data) {
                close_loader();
                $('#modal-sm-content').html(data);
                $('#modal-sm').modal('show')

            },
            error: function() {
                close_loader();
                show_toast_error('error')
            }
        });
    }
    $(document).on('submit', '#form-invoicing', function(e) {
        e.preventDefault();
        Swal.fire({
            title: "",
            text: "Confirmar",
            icon: "question",
            confirmButtonColor: "#00a897",
            confirmButtonText: "<i class='feather icon-save mr-2'></i>Sim",
            cancelButtonText: "<i class='feather icon-x mr-2'></i>Cancelar",
            cancelButtonClass: 'bg-dark',
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('service/invoicing') ?>',
                    type: 'POST',
                    dataType: "JSON",
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        show_loader();
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.status.toString() === 'success') {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2500
                            })
                            $('#render').html(data.list)
                            $('#render1').html('<div class="col-xl-3 col-md-4 border-right" id="render1"> </div>')
                        }
                        if (data.status.toString() === 'error_validation') {
                            setErrorValidation(data)
                        }
                        close_loader();
                    },
                    error: function(xhr, status, error) {
                        close_loader();
                        show_toast_error('Error when try save')
                        console.log(JSON.stringify(error))
                    }
                })
            }
        })
    });


  
</script>

<?php $this->load->view('layout/footer') ?>