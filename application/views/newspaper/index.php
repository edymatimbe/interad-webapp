<?php $this->load->view('layout/header') ?>
<div class="col-12 mb-3">
    <div class="row justify-content-between bg-white py-2 rounded">
        <div class="col-6 mb-lg-0 pt-2 mt-1">
            <i class="feather icon-list text-micro border-right pr-2"></i>
            <label for=""><?= $title ?></label>
        </div>
        <div class="col-6">
            <button class="btn btn-dark float-right br-2 text-nowrap has-ripple" type="button" onclick="add('newspapers','small')">
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
            <table class="table data-table table-hover table-bordered" id="table-newspapers">
                <thead>
                    <tr>
                        <th class="text-center no-sort" style="width: 5%">#</th>
                        <th style="width: 20%"><?= $this->lang->line('name') ?> do Jornal</th>
                        <th class="text-left" style="width: 20%"><?= 'Data da publicacao' ?></th>
                        <th class="text-center" style="width: 15%"><?= $this->lang->line('status') ?></th>
                        <th class="text-center" style="width: 20%"><?= $this->lang->line('actions') ?></th>
                    </tr>
                </thead>
                <tbody id="table_newspaper">
                    <?php echo $this->load->view('newspaper/_table', ['newspapers' => $newspapers], true); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        initDataTable('table-newspapers')
    })

    $(document).on('submit', '#form-newspaper', function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('newspapers/save') ?>",
                type: 'POST',
                dataType: "JSON",
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status.toString() === 'success') {
                        show_toast_success(data.message);
                        $("#modal-small").modal('toggle');
                        getAllData();
                    }
                    if (data.status.toString() === 'error') {
                        show_message(data.message, 'error');
                    }
                    if (data.status.toString() === 'error_validation') {
                        setErrorValidation(data)
                    }

                    console.log(data)
                },
                error: function(xhr, status, error) {
                    console.log(JSON.stringify(error))
                }
            })
            // console.log('dddddddddddddddddd');
        });

        function getAllData() {
            $.ajax({
                url: "<?= base_url('newspapers/getAll') ?>",
                type: 'GET',
                success: function(data) {
                    // reDrawTable(data)
                    $('#table_newspaper').html(data)
                },
            });
        }

</script>
<?php $this->load->view('layout/footer') ?>