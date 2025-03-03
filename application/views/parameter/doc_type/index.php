<?php $this->load->view('layout/header') ?>
<div class="col-12 mb-3">
    <div class="row justify-content-between bg-white py-2 rounded">
        <div class="col-6 mb-lg-0 pt-2 mt-1">
            <i class="feather icon-list text-micro border-right pr-2"></i>
            <label for=""><?= $title ?></label>
        </div>
        <div class="col-6">
            <button class="btn btn-dark float-right br-2 text-nowrap has-ripple" type="button" onclick="set_doc_type(0)">
                <i class=" feather icon-plus">&nbsp;</i>Novo <span class="ripple ripple-animate" style="height: 161.024px; width: 161.024px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -56.4659px; left: -176.093px;"></span>
            </button>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row mb-lg-2 d-flex justify-content-between">
            <div class="col-md-4">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-white"><i class="fa fa-search"></i></div>
                    </div>
                    <input type="text" class="form-control no-focus" id="my-search" placeholder="<?= $this->lang->line('search') ?>" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table data-table table-hover table-bordered" id="table-service">
                <thead>
                    <tr>
                        <th class="text-center no-sort" style="width: 5%">#</th>
                        <th><?= $this->lang->line('name') ?></th>
                        <th style="width: 15%" class="text-center"><?= $this->lang->line('status') ?></th>
                        <th style="width: 15%" class="text-center"><?= $this->lang->line('actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?= $this->load->view('parameter/doc_type/_table', null, true) ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
   $(document).ready(function() {
        initDataTable('table-service');
    });

    function set_doc_type(id) {
        $.ajax({
            url: "<?= base_url('parameter/form_doc') ?>",
            data: {
                'id': id
            },
            type: 'POST',
            success: function(data) {
                $('#modal-small-content').html(data);
                $('#modal-small').modal({
                    show: true,
                })
            },
        });
    }
    $(document).ready(function() {
        $(document).on('submit', '#form-doc-type', function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('parameter/save_doc') ?>",
                type: 'POST',
                dataType: "JSON",
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status.toString() === 'success') {
                        show_toast_success(data.message);
                        $('#modal-small').modal('toggle');
                        getAllData()
                    }
                    if (data.status.toString() === 'error') {
                        show_toast_error(data.message)
                    }
                    if (data.status.toString() === 'error_validation') {
                        setErrorValidation(data)
                    }
                },
                error: function(xhr, status, error) {
                    show_toast_error('')
                }
            })
        });
    });


    function getAllData() {
        $.ajax({
            url: "<?= base_url('parameter/get_all_docs') ?>",
            type: 'GET',
            success: function(data) {
                reDrawTable(data)
            },
        });
    }
</script>
<?php $this->load->view('layout/footer') ?>