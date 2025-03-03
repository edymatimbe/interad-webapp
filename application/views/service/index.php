<?php $this->load->view('layout/header') ?>
<div class="col-12 mb-3">
    <div class="row justify-content-between bg-white py-2 rounded">
        <div class="col-6 mb-lg-0 pt-2 mt-1">
            <i class="feather icon-list text-micro border-right pr-2"></i>
            <label for=""><?= $title ?></label>
        </div>
        <div class="col-6">
            <button class="btn btn-dark float-right br-2 text-nowrap has-ripple" type="button"
                    onclick="add('service','small')">
                <i class=" feather icon-plus">&nbsp;</i>Novo <span class="ripple ripple-animate"
                                                                   style="height: 161.024px; width: 161.024px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -56.4659px; left: -176.093px;"></span>
            </button>
        </div>
    </div>
</div>
<div class="mb-4">
    <ul class="nav nav-pills shadow rounded" id="ul-links" role="tablist">
        <li class="nav-item">
            <a id="nav-link-bank" class="nav-link active py-3 text-capitalize bank" href="javascript:void(0)" role="tab"
               data-target="bank">
                <i class="fa fa-bank mr-2"></i>Bancos
            </a>
        </li>
        <li class="nav-item d-none">
            <a id="nav-link-bank-account" class="nav-link py-3 text-capitalize bank-account" href="javascript:void(0)"
               role="tab"
               data-target="bank-account">
                <i class="feather icon-credit-card mr-2"></i>Contas bancárias
            </a>
        </li>
        <li class="nav-item">
            <a id="nav-link-mobile-service" class="nav-link py-3 text-capitalize mobile-service"
               href="javascript:void(0)"
               role="tab"
               data-target="mobile-service">
                <i class="feather icon-smartphone mr-2"></i>Serviços Móveis
            </a>
        </li>
    </ul>
</div>
<div id="div-render"></div>
<script>
    $(document).ready(function () {
        // initDataTable('table-service');
        $(document).on('submit', '#form-service', function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('service/save') ?>",
                type: 'POST',
                dataType: "JSON",
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status.toString() === 'success') {
                        show_toast_success(data.message);
                        console.log('#nav-link-' + data.target);
                        $('#nav-link-' + data.target).trigger('click');
                        $('.modal').modal('hide')
                    }
                    if (data.status.toString() === 'error') {
                        show_message(data.message, 'error');
                    }
                    if (data.status.toString() === 'error_validation') {
                        setErrorValidation(data)
                    }
                },
                error: function (xhr, status, error) {
                    console.log(JSON.stringify(error))
                }
            })
        });

    });

    $('#ul-links .nav-link').on('click', function () {
        $('#ul-links .nav-link').removeClass('active');
        $(this).addClass('active');
        const target = $(this).data('target');

        $.ajax({
            url: '<?=base_url('service/getIndex')?>',
            type: 'POST',
            data: {target: target},
            beforeSend: function () {
                show_loader()
            },
            success: function (data) {
                $('#div-render').html(data);
                localStorage.setItem('target_link_bank', target);
                initDataTable('table-service');
                close_loader()
            },
            error: function () {
                close_loader()
            }
        });
    });

    $(document).ready(function () {
        const bank_link = localStorage.getItem('target_link_bank');
        if (bank_link) {
            $('#ul-links').find('.' + bank_link).trigger('click');
        } else {
            $('#ul-links .nav-link:first').trigger('click');
        }
    });
</script>
<?php $this->load->view('layout/footer') ?>
