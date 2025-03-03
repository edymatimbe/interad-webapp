<?php $service = get_by_id('product', ['id' => $process->process_type_id]); ?>


<form id="form-invoicing" method="post" autocomplete="off" class="border-bottom">
    <input type="hidden" name="id" value="<?= $process->id  ?>">
    <input type="hidden" name="product_id" value="<?= $service->id  ?>">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group inputBox no-icon">
                <input type="text" class="form-control change" id="other_price" name="other_price" value="<?= $service->price  ?>">
                <label for="other_price"><?= 'Preço' ?> <span class="text-danger">&nbsp;*</span></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group inputBox no-icon">
                <input type="text" class="form-control change" id="percent" name="percent" value="<?= 17 ?>">
                <label for="percent"><?= 'Taxa (%)' ?> <span class="text-danger">&nbsp;*</span></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group inputBox no-icon">
                <input type="text" class="form-control" id="tax_value" name="tax_value" value="<?= $service->price * 0.16  ?>" readonly>
                <label for="tax_value"><?= 'Taxa(valor)' ?> <span class="text-danger">&nbsp;*</span></label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group inputBox no-icon">
                <input type="text" class="form-control" id="total" name="total" value="<?= $service->price + ($service->price * 0.16) ?>" readonly>
                <label for="total"><?= 'Total' ?> <span class="text-danger">&nbsp;*</span></label>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 mt-1">
            <button class="btn btn-success float-right br-2 text-nowrap has-ripple col-md-12" type="submit">
                <i class=" fa fa-save">&nbsp;</i> <?= $this->lang->line('save') ?> <span class="ripple ripple-animate" style="height: 161.024px; width: 161.024px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -56.4659px; left: -176.093px;"></span>
            </button>
        </div>
    </div>


</form>
<div class="row mt-4 px-2">


    <fieldset class="col-12 border-top">
        <legend class="mx-auto h5"> <strong><?= $service->name . ' numero ' . $process->code ?></strong> </legend>
    </fieldset>
    <div class="col-12">
        <ul class="list-group list-group-flush ">
            <li class="list-group-item px-0 ">Tipo de quota: <label class="font-weight-bold float-right"><strong><?= $process->quota == 'in_quota' ? 'Dentro' : 'Fora' . ' de quota '  ?></strong></label></li>
            <li class="list-group-item px-0 ">Instituição: <label class="font-weight-bold float-right"><strong><?= $process->company  ?></strong></label></li>
            <li class="list-group-item px-0 ">Representante: <label class="font-weight-bold float-right"><strong><?= $process->representative  ?></strong></label></li>
            <li class="list-group-item px-0 ">Beneficiario: <label class="font-weight-bold float-right"><strong><?= get_by_id('customer', ['id' => $process->beneficiary_id])->name ?></strong></label>
            </li>
            <li class="list-group-item px-0 ">Nacionalidade: <label class="font-weight-bold float-right"><strong><?= $process->beneficiary_nationality ?></strong></label>
            </li>
            <li class="list-group-item px-0">Data de registo:
                <label class="float-right font-weight-bold">
                    <strong><?= date_format(date_create($process->created_at), 'd-m-Y') ?></strong>
                </label>
            </li>
            <li class="list-group-item px-0 ">Recebido por: <label class="font-weight-bold float-right"><strong><?= $process->received_by  ?></strong></label></li>
        </ul>
    </div>
    <fieldset class="col-12 border-top">
        <legend class="mx-auto pt-4">
            <button class="btn  waves-effect waves-light btn-primary mb-4 col-md-12 my-border-radius-0" onclick="show_process(<?= $process->id ?> , <?= $process->process_type_id ?>)">
                <i class="feather icon-eye m-0 mr-2"></i>Detalhes gerais
            </button>
        </legend>
    </fieldset>
</div>

<script>
    $(".change").on('input', function() {
        const other_price = parseFloat($('#other_price').val());
        const tax = parseFloat($('#percent').val());
        if (other_price && tax) {
            const tax_value = other_price * (tax / 100);
            const total     = tax_value+ other_price;
            $('#tax_value').val(tax_value.toFixed(2));
            $('#total').val(total.toFixed(2));
            console.log(tax_value.toFixed(2))
        }
    });
</script>