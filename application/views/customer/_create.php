<form id="form-customer" autocomplete="off" class="h-100">
	<input type="hidden" name="action" value="create">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title text-agata"><i
						class="feather icon-plus">&nbsp;</i><?= $this->lang->line('add') . ' ' . $this->lang->line('customer') ?>
			</h5>
		</div>
		<div class="modal-body bg-gray-200">
			<div class="row">
				<div class="col-md-9">
					<div class="card shadow-sm mb-4">
						<div class="card-body pb-0">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="name"><?= $this->lang->line('name') ?><span class="text-danger">&nbsp;*</span></label>
										<input type="text" class="form-control" id="name" name="name" >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="phone"><?= $this->lang->line('phone') ?><span class="text-danger">&nbsp;*</span></label>
										<input type="text" class="form-control" id="phone" name="phone" >
										<?php echo form_error('phone', ' <small class="form-text text-danger">', '</small>') ?>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="phone2"><?= $this->lang->line('phone_alternative') ?> </label>
										<input type="text" class="form-control" id="phone2" name="phone2">
										<?php echo form_error('phone2', ' <small class="form-text text-danger">', '</small>') ?>
									</div>
								</div>
							</div>


						</div>
					</div>

				</div>
				<div class="col-md-3">
					<div class="bg-white rounded">

						<input type="hidden" id="image_data_customer" name="image">
						<input type="file" id="file_image_customer" class="d-none"
							   accept="image/x-png,image/gif,image/jpeg">
						<div class="d-flex justify-content-center py-2">
							<img class="shadow-sm img-to-upload bg-white"
								 src="<?= base_url('public/img/camera.png') ?>"
								 title="Click to change image" id="image_customer" alt="image">
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-9">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="nuit">Nuit<span class="text-danger">&nbsp;*</span></label>
										<input type="text" class="form-control" id="nuit" name="nuit" >
										<?php echo form_error('nuit', ' <small class="form-text text-danger">', '</small>') ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="email">Email</label>
										<input type="text" class="form-control" id="email" name="email">
										<?php echo form_error('email', ' <small class="form-text text-danger">', '</small>') ?>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="city"><?= $this->lang->line('city') ?></label>
										<input type="text" class="form-control" id="city" name="city">
										<?php echo form_error('city', ' <small class="form-text text-danger">', '</small>') ?>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="address"><?= $this->lang->line('address') ?></label>
										<input type="text" class="form-control" id="address" name="address">
										<?php echo form_error('address', ' <small class="form-text text-danger">', '</small>') ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="group_id"
											   class="text-capitalize"><?= $this->lang->line('customer_group') ?></label>
										<select name="group_id" id="group_id" class="form-control select2-no-search">
											<option value=""><?= $this->lang->line('select') ?></option>
											<?php foreach ($this->core_model->get_all_order('customer_group') as $item): ?>
												<option value="<?= $item->id ?>"><?= $item->name ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-6 form-group">
									<label for="type"><?= $this->lang->line('customer_type') ?></label>
									<select name="type" id="type" class="type_id form-control">
										<option value="empresa"><?= $this->lang->line('company') ?></option>
										<option value="pessoa"><?= $this->lang->line('Singular') ?></option>
									</select>
								</div>
							</div>

							<div class="" id="div-responsible">

								<div class="row">
									<div class="col-md-6 pt-5">
										<h6 class="pt-2">
											<i class="fa fa-user-tie">&nbsp;</i><?= $this->lang->line('responsible') . '' ?>
										</h6>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="registration_number"><?= $this->lang->line('Charter')?></label>
											<input type="text" class="form-control"
												   name="registration_number">
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="responsible_name"><?= $this->lang->line('name') ?></label>
											<input type="text" class="form-control " id="responsible_name"
												   name="responsible_name">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="responsible_office"><?= $this->lang->line('position') ?>
												</label>
											<input type="text" class="form-control " id="responsible_office"
												   name="responsible_office">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="responsible_id"><?= $this->lang->line('number').' '.$this->lang->line('of').' '.$this->lang->line('id') ?></label>
											<input type="text" class="form-control " id="responsible_id"
												   name="responsible_id">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label for="credit"><?= $this->lang->line('credit_customer') ?>?<span class="text-danger">&nbsp;*</span></label>
								<select name="credit" id="credit" class="credit form-control">
									<option value="0"><?= $this->lang->line('no') ?></option>
									<option value="1"><?= $this->lang->line('yes') ?></option>
								</select>
							</div>
							<div class="form-group">
								<label for="period_pay">
									<?= $this->lang->line('Payment_period') ?>
								</label>
								<input type="number" class="form-control bg-light input-credit" readonly
									   id="period_pay" name="period_pay">
							</div>
							<div class="form-group">
								<label for="max_credit"><?= $this->lang->line('maximum_credit') ?></label>
								<input type="number" class="form-control bg-light input-credit" id="max_credit" name="max_credit" readonly>
							</div>

							<hr>
							<div class="form-group">
								<label for="note" class="text-capitalize"><?= $this->lang->line('note') ?></label>
								<textarea class="form-control" name="note" id="note" rows="5" style="resize: none"></textarea>
								<?php echo form_error('note', ' <small class="form-text text-danger">', '</small>') ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="modal-footer">
			<div class="d-flex justify-content-between w-100">
				<button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal">
					<i class="fa fa-arrow-left">&nbsp;</i><?= $this->lang->line('cancel') ?>
				</button>
				<button type="submit" class="btn btn-sm btn-success" id="btn-modal-submit">
					<i class="feather icon-save">&nbsp;</i><?= $this->lang->line('save') ?>
				</button>
			</div>
		</div>
	</div>
</form>


<script>
	$(document).on('change', '.type_id', function () {
		const value = $(this).val().toString();
		hideDiv(value)
	});


	$(document).on('change', '.credit', function () {
		const value = $(this).val().toString();
		if (value === '1') {
			$('.input-credit').removeClass('bg-light').removeAttr('readonly').prop('required', true);
		} else {
			$('.input-credit').addClass('bg-light').removeAttr('required').prop('readonly', true);
		}
	});
</script>
