<div class="row">
    <div class="form-group col-md-6">
        <label for="check_bank"><?= $this->lang->line('bank_name') ?> <span class="text-danger">&nbsp;*</span></label>
        <input type="text" class="form-control" id="check_bank" required list="bankList" value="">
    </div>

    <div class="form-group col-md-6">
        <label for="check_holder"><?= $this->lang->line('owner') ?><span class="text-danger">&nbsp;*</span></label>
        <input type="text" class="form-control" id="check_holder" required value="">
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="check_account"><?= $this->lang->line('Account_number') ?> <span
                        class="text-danger">&nbsp;*</span></label>
            <input type="number" class="form-control" id="check_account" value="">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="check_number"><?= 'Número de recibo' ?> <span
                        class="text-danger">&nbsp;*</span></label>
            <input type="text" class="form-control" id="check_number">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="check_nib_picker"><?= "Data de depósito"?> <span
                        class="text-danger">&nbsp;*</span></label>
            <input type="hidden" class="form-control" id="check_nib">
            <input type="text" class="form-control" id="check_nib_picker">
        </div>
    </div>
</div>

<script>
    var check_nib = $('#check_nib_picker');
    check_nib.datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt',
        title: 'Data de depósito',
    }).on('change', function () {
        $('#check_nib').val(formatDateByPicker($(this).val().toString().split('/')));
    });
</script>
