</div>
</div>

<div id="modal-new-sale" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-bb-blue">
                <i class="fa fa-question-circle fa-4x text-white d-block mx-auto"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <button class="btn btn-block btn-primary btn-new-sale d-flex flex-column" data-target="sale">
                            <i class="fa fa-file-invoice-dollar fa-3x mx-auto mb-2"></i>
                            <span class="mx-auto"><?= $this->lang->line('vd') ?></span>
                        </button>
                    </div>
                    <div class="col-md-6 mb-4">
                        <button class="btn btn-block btn-success btn-new-sale d-flex flex-column" data-target="invoice">
                            <i class="fa fa-file-invoice fa-3x mx-auto mb-2"></i>
                            <span class="mx-auto"><?= $this->lang->line('vc') ?></span>
                        </button>
                    </div>
                    <div class="col-md-6 mb-4 mb-lg-0">
                        <button class="btn btn-block btn-secondary btn-new-sale d-flex flex-column"
                            data-target="quotation">
                            <i class="fa fa-file-text fa-3x mx-auto mb-2"></i>
                            <span class="mx-auto"><?= $this->lang->line('quotation') ?></span>
                        </button>
                    </div>
                    <div class="col-md-6 d-none">
                        <button class="btn btn-block btn-success btn-new-sale d-flex flex-column" data-target="invoice">
                            <i class="fa fa-file-invoice fa-3x mx-auto mb-2"></i>
                            <span class="mx-auto text-capitalize"><?= $this->lang->line('vc') ?></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-lg" class="modal fixed-left fade">
    <button id="btn-close-modal" class="btn bg-white position-absolute" data-dismiss="modal">
        <i class="fa fa-close"></i>
    </button>
    <div class="modal-dialog modal-dialog-aside modal-dialog-aside-lg" id="modal-lg-content">

    </div>
</div>

<div id="modal-md" class="modal fixed-left fade">
    <button id="btn-close-modal-md" class="btn bg-white position-absolute" data-dismiss="modal">
        <i class="fa fa-close"></i>
    </button>
    <div class="modal-dialog modal-dialog-aside modal-dialog-aside-md" id="modal-md-content">
    </div>
</div>

<div id="modal-sm" class="modal fixed-left fade">
    <button id="btn-close-modal-sm" class="btn bg-white position-absolute" data-dismiss="modal">
        <i class="fa fa-close"></i>
    </button>
    <div class="modal-dialog modal-dialog-aside modal-dialog-aside-sm" id="modal-sm-content">

    </div>
</div>

<div id="modal-sm-2" class="modal fixed-left fade">
    <button id="btn-close-modal-sm-2" class="btn bg-white position-absolute" data-dismiss="modal">
        <i class="fa fa-close"></i>
    </button>
    <div class="modal-dialog modal-dialog-aside modal-dialog-aside-sm-2" id="modal-sm-2-content">

    </div>
</div>
<div id="modal-small" class="modal fixed-left fade">
    <button id="btn-close-modal-small" class="btn bg-white position-absolute" data-dismiss="modal">
        <i class="fa fa-close"></i>
    </button>
    <div class="modal-dialog modal-dialog-aside modal-dialog-aside-small" id="modal-small-content">

    </div>
</div>

<div class="modal fade" id="modal-image">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body bg-light p-lg-0">
                <div class="container-fluid" style="height: 490px">
                    <h6 class="text-white text-center w-100 bg-dark-transparent-5 pt-sm-2 pb-sm-2 pr-sm-2"><i
                            class="fa fa-photo"></i>&nbsp;<?= $this->lang->line('image') ?>
                        <label class="close text-danger" data-dismiss="modal">&times;</label>
                    </h6>

                    <div id="div-cropper" class="m-0"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-center-md" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="modal-center-md-content">

        </div>
    </div>
</div>


<div class="modal fade" id="modal-new" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-gray-400 my-border-radius shadow-sm">
            <div class="modal-header">
                <h5 class="modal-title"><span id="modal-new-title"></span></h5>
                <button class="close btn-close-new" type="button" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="new_name"><?= $this->lang->line('name') ?></label>
                    <input id="new_name" type="text" class="form-control" autofocus autocomplete="off">
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-between w-100">
                    <button class="btn btn-sm btn-secondary btn-close-new"
                        type="button"><?= $this->lang->line('cancel') ?></button>
                    <button class="btn btn-sm btn-success" id="btn-save-new"><i
                            class="feather icon-save">&nbsp;</i><?= $this->lang->line('save') ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<input type="hidden" id="baseURL" value="<?= base_url() ?>">

<script src="<?= base_url(); ?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>public/vendor/bootstrap4-toggle/bootstrap4-toggle.min.js"></script>
<script src="<?= base_url(); ?>public/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url(); ?>public/vendor/select2/select2.min.js"></script>
<script src="<?= base_url(); ?>public/vendor/aos/aos.js"></script>
<script src="<?= base_url(); ?>public/js/jquery.slimscroll.js"></script>
<script src="<?= base_url(); ?>public/js/ripple.js"></script>
<script src="<?= base_url(); ?>public/js/pcoded.min.js"></script>
<script src="<?= base_url(); ?>public/vendor/aos/aos.js"></script>
<script src="<?= base_url(); ?>public/js/app.js"></script>
<script src="<?= base_url(); ?>public/vendor/bootstrap-notify.min.js"></script>
<section id="script"></section>

<?php $setting = $this->core_model->get_by_id('setting', array('company_id' => $this->session->userdata('company_id'))) ?>
<script>
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js').then(function(registration) {
            console.log('ServiceWorker registration successful with scope: ', registration.scope);
        }, function(err) {
            console.log('ServiceWorker registration failed: ', err);
        });
    });
}
</script>

<script>
AOS.init();

$("#styleSelector > .style-toggler").on("click", function() {
    $("#styleSelector").toggleClass("open").removeClass("prebuild-open")
});

$(document).ready(function() {
    setTimeout(function() {
        $(".loader-bg").fadeOut("slow", function() {
            $(this).remove()
        })
    }, 400);

    updateSelect2NoSearch();
    updateSelect2();
    $("#loader-one").fadeOut();
    $('#div-customize').addClass('');
});

function updateSelect2NoSearch() {
    $('.select2-no-search').select2({
        minimumResultsForSearch: -1,
    });
}

function updateSelect2() {
    $('.my-select2').select2();
}

function updateSelect2NoSearch() {
    $('.select2-no-search').select2({
        minimumResultsForSearch: -1,
    });

    $('.select2-no-search').each(function() {
        $(this).css('width', '100%')
    })
}


function new_sale_invoice() {
    const url = window.location.href.split('/');
    if (url[url.length - 1].toString() !== 'new-sale') {
        $('#modal-new-sale').modal('show')
    }
}

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: false,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

function show_message(msg, type) {
    // Toast.fire({
    //     icon: type,
    //     title: msg,
    // })
    //
    type === 'error' ? type = 'danger' : type;

    notify(msg, 'top', 'right', 'feather icon-bell', type);

}

function notify(message, from, align, icon, type) {
    $.notify({
        icon: icon,
        title: '',
        message: message,
        url: ''
    }, {
        element: 'body',
        type: type,
        allow_dismiss: true,
        placement: {
            from: from,
            align: align
        },
        offset: {
            x: 30,
            y: 30
        },
        spacing: 10,
        z_index: 999999,
        delay: 2500,
        timer: 1000,
        url_target: '_blank',
        mouse_over: false,

        icon_type: 'class',
        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
    });
}

function config_toast(position) {
    return {
        toast: true,
        position: position,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    }
}

function show_toast_success(msg) {
    // const default_position = 'top-end';
    const position = "<?= $setting ? ($setting->message_success ?: 'top-end') : 'top-end' ?>";
    Swal.mixin(config_toast(position)).fire({
        icon: 'success',
        title: msg
    })
}

function show_toast_warning(msg) {
    const default_position = 'top-end';
    const position = "<?= $setting ? ($setting->message_warning ?: 'top-end') : 'top-end' ?>";

    Swal.mixin(config_toast(position)).fire({
        icon: 'warning',
        title: msg
    })
}

function show_toast_error(msg) {
    const default_position = 'top-end';
    const position = "<?= $setting ? ($setting->message_error ?: 'top-end') : 'top-end' ?>";

    Swal.mixin(config_toast(position)).fire({
        icon: 'error',
        title: msg
    })
}

function setErrorValidation(data) {
    $('.text-error').remove();
    $.each(data.error, function(key, value) {
        const query = 'input[name=' + key + ']';
        const parent = $(query).parent();
        const input = $(query);
        parent.after('<small id="error-' + key + '" class="form-text text-danger text-error mb-0 mb-lg-0">' +
            value + '</small>')
        input.on('input', function() {
            $('#error-' + key).remove();
        })
    });
}

function logOut() {
    window.location = '<?= base_url('auth/logout') ?>';
}

function justMain() {
    if ($('#page-top').hasClass('sidebar-toggled')) {
        $('.main-container').addClass('full')
    } else {
        $('.main-container').removeClass('full')
    }
}

$('#sidebarToggle').on('click', function() {
    justMain()
});

$('#nav-bar').addClass(localStorage.getItem('navbar'));

$('#mobile-collapse').on('click', function() {
    if ($('.navbar-collapsed').length) {
        localStorage.setItem('navbar', 'navbar-collapsed')
    } else {
        localStorage.setItem('navbar', '');
    }
});

const deviceType = () => {
    const ua = navigator.userAgent;
    if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
        return "tablet";
    } else if (/Mobile|Android|iP(hone|od)|IEMobile|BlackBerry|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/
        .test(ua)) {
        return "mobile";
    }
    return "desktop";
};

$(document).ready(function() {
    updateSelect2NoSearch();

    close_loader();
    $("#loader-one").fadeOut();
    $('#div-customize').addClass('');
    $('.data-table').addClass('table-bordered');

    $('#select-sale-type').on('change', function() {
        window.location.href = '<?= base_url() ?>' + $(this).val();
    });

    $('.btn-new-sale').on('click', function(e) {
        e.preventDefault();
        const target = $(this).data('target');
        $.ajax({
            type: 'POST',
            url: 'sale/setSourceAJAX',
            dataType: "JSON",
            data: {
                'value': target
            },
            success: function(data) {
                console.log(data);
                // alert()
                window.location.href = '<?= base_url() . 'new-sale' ?>'
            },
            error: function() {
                alert('error')
            }
        });
    });
});

function show_loader() {
    $("#loader-two").fadeIn();
}

function close_loader() {
    $("#loader-two").fadeOut();
}

function get_payment_details(id) {
    $.ajax({
        url: '<?= base_url('/payment/get_details') ?>',
        type: 'POST',
        data: {
            id: id
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
            close_loader()
        }
    });
}

function back() {
    window.history.back();
}

function get_payment_receipt(id, target) {
    $.ajax({
        url: '<?= base_url('/payment/getReceipt') ?>',
        type: 'POST',
        data: {
            id: id,
            target: target
        },
        beforeSend: function() {
            show_loader();
        },
        success: function(data) {
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
        },
        error: function() {
            close_loader()
        }
    });
}

function initDatepicker() {
    $.fn.datepicker.dates['pt'] = {
        days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
        daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
        daysMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
        // daysMin: ["Do", "Se", "Te", "Qu", "Qui", "Se", "Sa"],
        months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro",
            "Outubro", "Novembro", "Dezembro"
        ],
        monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
        today: "Hoje",
        monthsTitle: "Meses",
        clear: "Limpar",
        format: "dd/mm/yyyy"
    };
}

function add(target, modal_size) {
    $.ajax({
        url: "<?= base_url() ?>" + target + '/form',
        type: 'POST',
        success: function(data) {
            $('#modal-' + modal_size + '-content').html(data);
            $('#modal-' + modal_size + '').modal('show');
            updateSelect2NoSearch();
        },
    });
}

function get_modal(id, target, modal_size, action, backdrop = '', other = '') {
    $.ajax({
        url: "<?= base_url() ?>" + target + '/' + action,
        type: 'POST',
        data: {
            id: id,
            other: other
        },
        success: function(data) {
            $('#modal-' + modal_size + '-content').html(data);
            if (backdrop) {
                $('#modal-' + modal_size + '').modal({
                    show: true,
                    backdrop: 'static'
                });
            } else {
                $('#modal-' + modal_size + '').modal('show');
            }
            updateSelect2NoSearch();
        },
    });
}
</script>
<!--local scripts-->
<?php if (isset($scripts)) : ?>
<?php foreach ($scripts as $script) : ?>
<script src="<?= base_url(); ?>public/<?= $script ?>"></script>
<?php endforeach; ?>
<?php endif ?>


</body>

</html>