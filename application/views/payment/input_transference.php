<div class="row">
	<div class="form-group col-md-6">
		<label for="check_bank"><?= $this->lang->line('bank_name') ?> <span class="text-danger">&nbsp;*</span></label>
		<input type="text" class="form-control" id="check_bank" required list="bankList">
	</div>

	<div class="form-group col-md-6">
		<label for="check_holder"><?= $this->lang->line('owner') ?><span class="text-danger">&nbsp;*</span></label>
		<input type="text" class="form-control" id="check_holder" required>
	</div>
</div>
<input type="hidden" class="form-control" id="check_number" value="null">

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label for="check_account"><?= $this->lang->line('Account_number') ?> <span
					class="text-danger">&nbsp;*</span></label>
			<input type="number" class="form-control" id="check_account">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="check_nib">NIB<span
					class="text-danger">&nbsp;*</span></label>
			<input type="number" class="form-control" id="check_nib">
		</div>
	</div>
</div>


