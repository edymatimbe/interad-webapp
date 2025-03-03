<div class="card-header py-3">
    <h6 class="card-title mb-0 text-capitalize">
        <i class="feather icon-flag">&nbsp;</i>
        <?= 'Variavel multiplicador da campanha' ?>
    </h6>
</div>
<?php $setting = $this->core_model->get_setting() ?>

<div class="card-body">
    <div class="row">
        <div class="col-md-9">
            <div class="form-group inputBox no-icon">
                <input type="number" class="form-control" id="multiplier" name="multiplier" value="<?= $setting->multiplier ?>" autofocus>
                <label for="price_card"><?= 'Valor do multiplicador' ?> <span class="text-danger">&nbsp;*</span></label>
            </div>
        </div>
        <div class="col-md-3">
            <button class="btn btn-success float-right br-2 text-nowrap has-ripple  btn-sm col-md-12" onclick="multiplier()">
                <i class=" feather icon-refresh-cw">&nbsp;</i>Actualizar <span class="ripple ripple-animate"></span>
            </button>
        </div>
    </div>
</div>



<script>
    function multiplier() {
        $.ajax({
            url: '<?= base_url('settings/save_multiplier') ?>',
            type: 'POST',
            dataType:"JSON",
            data: {
                multiplier: $('#multiplier').val()
            },
            success: function(data) {
                console.log(data)
                if(data.status == 1){
                    show_toast_success("Variavel multiploicadora actualizada com sucesso");
                }else{
                    show_toast_error("Error, variavel multiplicadora não actualizada");
                }
            }
        });
    }


    $(document).ready(function() {
        $('#select-language').select2({
            width: "100%",
            templateSelection: formatIcon,
            templateResult: formatIcon,
            minimumResultsForSearch: -1,
        }).addClass('pl-0').on('change', function() {
            $.ajax({
                url: '<?= base_url('settings/updateColumn') ?>',
                type: 'POST',
                data: {
                    column: 'language',
                    value: $(this).val()
                },
                success: function(data) {
                    console.log(data)
                }
            });
        })
    });



    function formatIcon(icon) {
        const baseURLL = '<?= base_url() ?>';
        return $('<span class="border-right pr-2 mr-2"><img alt="" src="' + baseURLL + $(icon.element).data('icon') + '"/></span><span>' + icon.text + '</span>');
    }
</script>