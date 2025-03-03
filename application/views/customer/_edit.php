<form id="form-customer" autocomplete="off" class="h-100">
	<input type="hidden" name="action" value="update">
	<input type="hidden" name="id" value="<?=$customer->id?>">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title text-agata"><i
						class="feather icon-edit">&nbsp;</i><?= $this->lang->line('edit') . ' ' . $this->lang->line('customer') ?>
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
										<input type="text" class="form-control" id="name" name="name"  value="<?=$customer->name?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="phone"><?= $this->lang->line('phone') ?><span class="text-danger">&nbsp;*</span></label>
										<input type="text" class="form-control" id="phone" name="phone"  value="<?=$customer->phone?>">
										<?php echo form_error('phone', ' <small class="form-text text-danger">', '</small>') ?>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="phone2"><?= $this->lang->line('phone_alternative') ?> </label>
										<input type="text" class="form-control" id="phone2" name="phone2" value="<?=$customer->phone2?>">
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

							<?php if ($customer->image): ?>
								<?php if (is_file(FCPATH . $customer->image)): ?>
									<img class="shadow-sm img-to-upload"
										 src="<?= base_url($customer->image) ?>" alt="image"
										 title="Click to change image" id="image_customer"
									>
								<?php else: ?>
									<img class="shadow-sm img-to-upload"
										 src="<?= base_url('public/img/camera.png') ?>" alt="image"
										 title="Click to change image" id="image_customer">
								<?php endif; ?>
							<?php else: ?>
								<img class="shadow-sm img-to-upload" width="100%"
									 src="<?= base_url('public/img/camera.png') ?>" alt="image"
									 title="Click to change image" id="image_customer">
							<?php endif;?>
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
										<input type="text" class="form-control" id="nuit" name="nuit"  value="<?=$customer->nuit?>">
										<?php echo form_error('nuit', ' <small class="form-text text-danger">', '</small>') ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="email">Email</label>
										<input type="text" class="form-control" id="email" name="email" value="<?=$customer->email?>">
										<?php echo form_error('email', ' <small class="form-text text-danger">', '</small>') ?>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="city"><?= $this->lang->line('city') ?></label>
										<input type="text" class="form-control" id="city" name="city" value="<?=$customer->city?>">
										<?php echo form_error('city', ' <small class="form-text text-danger">', '</small>') ?>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="address"><?= $this->lang->line('address') ?></label>
										<input type="text" class="form-control" id="address" name="address" value="<?=$customer->address?>">
										<?php echo form_error('address', ' <small class="form-text text-danger">', '</small>') ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="group_id"
											   class="text-capitalize"><?= $this->lang->line('group') ?></label>
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
										<option value="empresa"  <?=$customer->type=='empresa'?'selected':''?>><?= $this->lang->line('company') ?></option>
										<option value="pessoa"  <?=$customer->type=='pessoa'?'selected':''?>><?= $this->lang->line('Singular') ?></option>
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
											<label for="registration_number"><?= $this->lang->line('Charter')  ?></label>
											<input type="text" class="form-control" id="registration_number"
												   name="registration_number" value="<?=$customer->registration_number?>">
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="responsible_name"><?= $this->lang->line('name') ?></label>
											<input type="text" class="form-control" id="responsible_name"
												   name="responsible_name" value="<?=$customer->responsible_name?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="responsible_office"><?= $this->lang->line('position') ?>
												</label>
											<input type="text" class="form-control" id="responsible_office"
												   name="responsible_office" value="<?=$customer->responsible_office?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="responsible_id"><?= $this->lang->line('number').' '.$this->lang->line('of').' '.$this->lang->line('id') ?></label>
											<input type="text" class="form-control" id="responsible_id"
												   name="responsible_id" value="<?=$customer->responsible_id?>">
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
									<option value="0" <?=$customer->credit==0?'selected':''?>><?= $this->lang->line('no') ?></option>
									<option value="1" <?=$customer->credit==1?'selected':''?>><?= $this->lang->line('yes') ?></option>
								</select>
							</div>
							<div class="form-group">
								<label for="period_pay">
									<?= $this->lang->line('Payment_period') ?>
								</label>
								<input type="number" class="form-control bg-light input-credit" readonly
									   id="period_pay" name="period_pay" value="<?=$customer->period_pay?>">
							</div>
							<div class="form-group">
								<label for="max_credit"><?= $this->lang->line('maximum_credit') ?></label>
								<input type="number" class="form-control bg-light input-credit" id="max_credit" name="max_credit" readonly value="<?=$customer->max_credit?>">
							</div>

							<hr>
							<div class="form-group">
								<label for="note" class="text-capitalize"><?= $this->lang->line('note') ?></label>
								<textarea class="form-control" name="note" id="note" rows="5" style="resize: none"><?=$customer->note?></textarea>
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
	$(document).ready(function () {
		$('.credit').val($('.credit').val()).trigger('change')
		$('.type_id').val($('.type_id').val()).trigger('change')
	})
	$(document).on('change', '.type_id', function () {
		const value = $(this).val().toString();
		hideDiv(value,1)
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
