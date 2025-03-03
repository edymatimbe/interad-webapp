<?php $this->load->view('layout/header') ?>

<div class="col-12 mb-3">
    <div class="row justify-content-between bg-white py-2 rounded">
        <div class="col-6 mb-lg-0 pt-2">
            <i class="feather icon-users text-funae border-right pr-2"></i>
            <label for=""><?= $title ?></label>
        </div>
        <div class="col-6">

        </div>
    </div>
</div>

<ul class="nav nav-pills shadow rounded mb-4" id="ul-links" role="tablist">
    <li class="nav-item">
        <a class="nav-link py-3 user" href="javascript:void(0)" role="tab" data-target="user" id="link-users">
            <i class="feather icon-list pr-2"></i>
            <?= $title ?>
        </a>
    </li>
    <?php if ($this->ion_auth->in_group(array('admin','super admin'))): ?>
        <li class="nav-item">
            <a class="nav-link py-3 access" href="javascript:void(0)" data-target="access" id="link-access">
                <i class="fa fa-user-shield pr-2"></i>
                <?= $this->lang->line('access_management') ?>
            </a>
        </li>
    <?php endif; ?>

</ul>
<div id="div-render"></div>



<script>
    $('#menu-user').addClass('active pcoded-trigger');
    $('#menu-user .pcoded-submenu').css('display', 'block');


    $('#ul-links .nav-link').on('click', function () {
        $('#ul-links .nav-link').removeClass('active');
        $(this).addClass('active');
        const target = $(this).data('target');
        $.ajax({
            url: 'user/getIndex',
            type: 'POST',
            data: {target: target},
            beforeSend: function () {
                show_loader()
            },
            success: function (data) {
                $('#div-render').html(data);
                localStorage.setItem('user_link', target);
                close_loader()
            },
            error: function () {
                close_loader()
            }
        });
    });

    $(document).ready(function () {
        const user_link = localStorage.getItem('user_link');
        <?php if ($this->ion_auth->in_group(array('admin','super admin'))): ?>

        if (user_link) {
            $('#ul-links').find('.' + user_link).trigger('click');
        } else {
            $('#ul-links .nav-link:first').trigger('click');
        }
        <?php else:?>
        $('#ul-links').addClass('d-none');
        $('#ul-links .nav-link:first').trigger('click');
        <?php endif;?>
    });

    function add_user() {
        $.ajax({
            url: 'user/create',
            type: 'GET',
            success: function (data) {
                $('#modal-sm-content').html(data);
                $('#modal-sm').modal('show')
            },
        });
    }

    function show_user(id) {
        $.ajax({
            url: 'user/show',
            type: 'POST',
            data: {'id': id},
            success: function (data) {
                $('#modal-sm-content').html(data);
                $('#modal-sm').modal('show');
                initDataTable('table-user-products', false, 8)
            },
        });
    }

</script>

<!--Access-->
<?php $this->load->view('layout/footer') ?>
