<?php $this->load->view('layout/header') ?>

<div class="col-12 mb-3">
    <div class="row justify-content-between bg-white py-2 rounded">
        <div class="col-6 mb-lg-0 pt-2 mt-1">
            <i class="feather icon-image text-micro border-right pr-2"></i>
            <label for=""><?= 'Configuração de baners' ?></label>
        </div>

    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5><strong> Formulario de banner </strong></h5>
            </div>
            <div class="card-body" id="form">

            </div>

        </div>
    </div>
    <input type="hidden" value="<?= isset($contest_id) ? $contest_id : '' ?>" id="contest">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive" style="z-index: -1;">
                    <table class="table table-bordered" id="table-banner">
                        <thead>
                            <tr role="row">
                                <th class="text-center no-sort "> # </th>
                                <th class="text-left no-sort "> Motorista</th>
                                <th class="text-left">Carro</th>
                                <th class="text-center no-sort "> Matricula</th>
                              
                                <th> Titulo</th>

                                <th class="text-center text-capitalize">Estado</th>
                                <th class="text-center no-sort text-capitalize">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $this->load->view('layout/footer') ?>
<script type="text/javascript">
  
    $(document).ready(function() {
        var contest_id = $('#contest').val();
        initDataTable('table-banner');
        getAllData()
        get_form(null, contest_id)
    });

    cropImage(
        'image_banner',
        'file_image_banner',
        'image_data_banner',
        'modal-image',
        'div-cropper', 300, 410
    );

    $(document).on('submit', '#form-banner', function(event) {
        event.preventDefault();
        $.ajax({
            url: "<?= base_url('banner/save') ?>",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            beforeSend: function() {
                show_loader()
            },
            success: function(data) {
                close_loader();
                console.log(data)


                if (data.status.toString() === 'success') {
                    show_message(data.message, data.status);
                    getAllData()
                    get_form()
                    // setTimeout(function() {
                    //     window.location = '<?= base_url('banner') ?>'
                    // }, 2000)
                }

                if (data.status.toString() === 'error') {
                    show_message(data.message, data.status);
                }

                if (data.status.toString() === 'error_validation') {
                    setErrorValidation(data)
                }
            },
            error: function() {
                close_loader();
                show_message('Error ao salvar banner', 'error')
                // console.log(data)
            }
        })

    });

    function getAllData() {
        $.ajax({
            url: "<?= base_url('banner/getAll') ?>",
            type: 'GET',
            success: function(data) {
                reDrawTable(data)
            },
        });
    }

    // $(document).ready(function() {
    //     $( "#foo" ).trigger( "click" );

    //     $("button").click(function() {
    //         $("input").trigger("select");
    //     });
    // });

    function get_form(id = null, contest_id = null) {
        // alert(contest_id)
        $.ajax({
            url: "<?= base_url('banner/form') ?>",
            type: 'POST',
            dataType: "JSON",
            data: {
                id,
                contest_id
            },
            success: function(data) {
                $('#form').html(data);
            },
        });
    }
</script>