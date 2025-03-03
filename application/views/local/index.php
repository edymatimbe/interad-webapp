<?php $this->load->view('layout/header') ?>
<div class="col-12 mb-3">
    <div class="row justify-content-between bg-white py-2 rounded">
        <div class="col-6 mb-lg-0 pt-2 mt-1">
            <i class="feather icon-list text-micro border-right pr-2"></i>
            <label for="" class="pb-2"><?= $title ?></label>
        </div>
        <div class="col-6">

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="card-title mb-0">Províncias</h6>
            </div>
            <div class="card-body p-0">
                <div class="row d-none">
                    <div class="col-md-4">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-white"><i class="fa fa-search"></i></div>
                            </div>
                            <input type="text" class="form-control no-focus" id="my-search"
                                   placeholder="<?= $this->lang->line('search') ?>" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table data-table table-hover table-bordered mb-0" id="table-province">
                        <thead>
                        <tr>
                            <th class="text-center no-sort" style="width: 5%">#</th>
                            <th><?= 'Nome' ?></th>
                            <th style="width: 15%" class="text-center"><?= $this->lang->line('actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($provinces as $key => $province): ?>
                            <tr class="text-nowrap">
                                <td class="text-center"><?= $key + 1 ?></td>
                                <td class="text-left"><?= $province->name ?></td>
                                <td class="text-center">
                                    <a title="Show subsidy"
                                       class="btn btn-sm btn-outline-secondary btn-province"
                                       onclick="get_districts(<?= $province->id ?>,'<?= $province->name ?>')">
                                        <i class="feather icon-map-pin text-danger mr-2">&nbsp;</i><?= "Distritos" ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="card-title mb-0">Distritos</h6>
            </div>
            <div class="card-body">
                <div class="inputBox no-icon">
                    <input type="text" id="input-province" readonly>
                    <label for="input-province" class="bg-white">Província</label>
                </div>
                <div class="scroll p-0" style="overflow-y: auto" id="card-body-districts">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0" id="table-districts">
                            <thead>
                            <tr>
                                <th class="text-center no-sort" style="width: 5%">#</th>
                                <th><?= 'Nome' ?></th>
                                <th style="width: 15%" class="text-center"><?= $this->lang->line('actions') ?></th>
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
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="card-title mb-0">Zonas/Bairros</h6>
            </div>
            <div class="card-body">
                <div class="inputBox no-icon">
                    <input type="text" id="input-district" readonly>
                    <label for="input-district" class="bg-white">Distrito</label>
                </div>
                <div class="scroll p-0" style="overflow-y: auto" id="card-body-zones">
                    <div class="table-responsive">
                        <table class="table data-table table-hover table-bordered" id="table-zones">
                            <thead>
                            <tr>
                                <th class="text-center no-sort" style="width: 5%">#</th>
                                <th><?= 'Nome' ?></th>
                                <th style="width: 15%" class="text-center"><?= $this->lang->line('actions') ?></th>
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
</div>
<script>
    $(document).ready(function () {
        setFullHeight('#card-body-districts', -35);
        setFullHeight('#card-body-zones', -35);

        $('.btn-province:first').trigger('click');
        $(document).on('submit', '#form-zone', function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('local/save_zone') ?>",
                type: 'POST',
                dataType: "JSON",
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status.toString() === 'success') {
                        show_toast_success(data.message);
                        $("#modal-small").modal('toggle');
                        var district_id = data.district_id;
                        var district_name = data.district_name;
                        get_zones(district_id, district_name);
                        
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

    function get_districts(id, province) {
        console.log(id)
        $.ajax({
            url: "<?=base_url('local/get_districts')?>",
            type: 'POST',
            data: {id: id},
            success: function (data) {
                $('#table-districts tbody').html(data);
            },
        });
        $('#input-province').val(province)
    }

    function get_zones(id,district) {
        $.ajax({
            url: "<?=base_url('local/get_zones')?>",
            type: 'POST',
            data: {id: id},
            success: function (data) {
                $('#table-zones tbody').html(data)
            },
        });
        $('#input-district').val(district)
    }
</script>
<?php $this->load->view('layout/footer') ?>
