<?php $this->load->view('layout/header') ?>

<div class="col-12 mb-3">
    <div class="row justify-content-between bg-white py-2 rounded">
        <div class="col-6 mb-lg-0 pt-2">
            <i class="feather icon-settings text-micro border-right pr-2"></i>
            <label for="" class="pb-2"><?= $title ?></label>
        </div>
    </div>
</div>

<div class="mb-4">
    <ul class="nav nav-pills shadow rounded" id="ul-links" role="tablist">
        <?php if ($this->core_model->is_granted('config_read')) : ?>
            <li class="nav-item">
                <a id="nav-link-general-config" class="nav-link py-3 text-capitalize general" href="javascript:void(0)" role="tab" data-target="general">
                    <i class="feather icon-settings mr-2"></i>Conta
                </a>
            </li>
        <?php endif; ?>

        <li class="nav-item d-none">
            <a id="nav-link-other-config" class="nav-link py-3 text-capitalize config" href="javascript:void(0)" role="tab" data-target="config">
                <i class="feather icon-settings mr-2"></i>Outras configurações
            </a>
        </li>
    </ul>
</div>

<div id="div-render"></div>
<script src="<?= base_url() ?>public/js/jquery.mask.min.js"></script>
<script>
    let croImage = 0;
    $('#ul-links .nav-link').on('click', function() {
        $('#ul-links .nav-link').removeClass('active');
        $(this).addClass('active');
        const target = $(this).data('target');
        // console.log(target)

        $.ajax({
            url: "<?= base_url('settings/getIndex') ?>",
            type: 'POST',
            data: {
                target: target
            },
            beforeSend: function() {
                show_loader()
            },
            success: function(data) {
                $('#div-render').html(data);
                updateSelect2NoSearch();
                localStorage.setItem('target_link_setting', target);
                close_loader()
            },
            error: function() {
                close_loader()
            }
        });
    });

    $(document).ready(function() {
        const setting_link = localStorage.getItem('target_link_setting');
        <?php if ($this->ion_auth->in_group(array('super admin'))) : ?>
            if (setting_link) {
                $('#ul-links').find('.' + setting_link).trigger('click');
            } else {
                $('#ul-links .nav-link:first').trigger('click');
            }
        <?php else : ?>
            $('#nav-link-general-config').trigger('click');
        <?php endif; ?>
    });

    //other settings
    function set_config() {
        $.ajax({
            url: '<?= base_url('settings/set_config') ?>',
            type: 'POST',
            success: function(data) {
                $('#modal-small-content').html(data);
                updateSelect2NoSearch();
                $('#modal-small').modal({
                    show: true,
                })
            },
        });
    }

    $(document).on('submit', '#form-config', function(e) {
        e.preventDefault();
        $.ajax({
            url: "settings/config_save",
            type: 'POST',
            dataType: "JSON",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status.toString() === 'success') {
                    $('#nav-link-other-config').trigger('click');
                    show_toast_success(data.message);
                    $('#modal-small').modal('toggle');
                }

                if (data.status.toString() === 'error') {
                    show_message(data.message, data.status)
                }
                if (data.status.toString() === 'error_validation') {
                    setErrorValidation(data);
                }
            },
            error: function(xhr, status, error) {
                close_loader();
                show_toast_error('Erro interno');
            }
        })
    });

    function set_working_days(value) {
        $.ajax({
            type: 'POST',
            url: "<?= base_url('settings/set_working_days') ?>",
            data: {
                'days': value
            },
            success: function(data, textStatus) {

                if(data == true){
                    show_message('Dias úteis definidos com sucesso', 'success')
                }else{
                    show_message('Dias uteis não definidos', 'error')
                }
             
            }
        });
    }


</script>


<?php $this->load->view('layout/footer') ?>