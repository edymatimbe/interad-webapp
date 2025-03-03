<!--<form id="form-customer" autocomplete="off" class="h-100">-->
<!--	<input type="hidden" name="action" value="create">-->
<!--	<div class="modal-content">-->
<!--		<div class="modal-header">-->
<!--			<h5 class="modal-title text-agata"><i-->
<!--					class="feather icon-plus">&nbsp;</i>--><?//= $this->lang->line('add') . ' ' . $this->lang->line('customer') ?>
<!--			</h5>-->
<!--		</div>-->
<!--		<div class="modal-body bg-gray-200">-->
<!--			<div class="row">-->
<!--				<div class="col-lg-8">-->
<!--					<div class="card shadow-sm mb-4">-->
<!--						<div class="card-header pb-0">-->
<!--							<h6 class="card-title">--><?//= $this->lang->line('customer_type') ?><!--</h6>-->
<!--						</div>-->
<!--						<div class="card-body pb-s">-->
<!--							<div class="row funkyradio">-->
<!--								<div class="col-md-6">-->
<!--									<div class="funkyradio-info">-->
<!--										<input type="radio" value="empresa" name="type" class="type_id"-->
<!--											   id="radio-empresa" checked/>-->
<!--										<label for="radio-empresa">--><?//= $this->lang->line('company') ?><!-- </label>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="col-md-6">-->
<!--									<div class="funkyradio-info">-->
<!--										<input type="radio" value="pessoa" name="type" class="type_id"-->
<!--											   id="radio-pessoa"/>-->
<!--										<label for="radio-pessoa"> --><?//= $this->lang->line('Singular') ?><!--</label>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="card shadow-sm mb-4">-->
<!--						<div class="card-body">-->
<!--							<div class="row">-->
<!--								<div class="col-md-4">-->
<!--									<div class="form-group">-->
<!--										<label for="name">--><?//= $this->lang->line('name') ?><!--<span class="text-danger">&nbsp;*</span></label>-->
<!--										<input type="text" class="form-control" id="name" name="name" required>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="col-md-4">-->
<!--									<div class="form-group">-->
<!--										<label for="credit">Tipo de cliente<span class="text-danger">&nbsp;*</span></label>-->
<!--										<select name="credit" id="" class="form-control">-->
<!--											<option value="0">Cliente Normal</option>-->
<!--											<option value="1">Cliente a credito</option>-->
<!--										</select>-->
<!--										--><?php //echo form_error('company', ' <small class="form-text text-danger">', '</small>') ?>
<!--									</div>-->
<!--								</div>-->
<!--								<div class="col-md-4">-->
<!--									<div class="form-group">-->
<!--										<label for="period_pay">Periodo de pagamento<span class="text-danger">&nbsp;*</span></label>-->
<!--										<input type="text" class="form-control" id="period_pay" name="period_pay" required>-->
<!--										--><?php //echo form_error('company', ' <small class="form-text text-danger">', '</small>') ?>
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--							<div class="row">-->
<!--								<div class="col-md-2">-->
<!--									<div class="form-group">-->
<!--										<label for="nuit">Nuit<span class="text-danger">&nbsp;*</span></label>-->
<!--										<input type="text" class="form-control" id="nuit" name="nuit" required>-->
<!--										--><?php //echo form_error('company', ' <small class="form-text text-danger">', '</small>') ?>
<!--									</div>-->
<!--								</div>-->
<!--								<div class="col-md-3">-->
<!--									<div class="form-group">-->
<!--										<label for="phone">--><?//= $this->lang->line('phone') ?><!--<span class="text-danger">&nbsp;*</span></label>-->
<!--										<input type="text" class="form-control" id="phone" name="phone" required>-->
<!--										--><?php //echo form_error('phone', ' <small class="form-text text-danger">', '</small>') ?>
<!--									</div>-->
<!--								</div>-->
<!--								<div class="col-md-3">-->
<!--									<div class="form-group">-->
<!--										<label for="phone2">--><?//= $this->lang->line('phone_alternative') ?><!-- </label>-->
<!--										<input type="text" class="form-control" id="phone2" name="phone2">-->
<!--										--><?php //echo form_error('phone2', ' <small class="form-text text-danger">', '</small>') ?>
<!--									</div>-->
<!--								</div>-->
<!--								<div class="col-md-4">-->
<!--									<div class="form-group">-->
<!--										<label for="email">Email</label>-->
<!--										<input type="text" class="form-control" id="email" name="email">-->
<!--										--><?php //echo form_error('email', ' <small class="form-text text-danger">', '</small>') ?>
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!---->
<!--							<div class="row">-->
<!--								<div class="col-md-6">-->
<!--									<div class="form-group">-->
<!--										<label for="address">--><?//= $this->lang->line('address') ?><!--</label>-->
<!--										<input type="text" class="form-control" id="address" name="address">-->
<!--										--><?php //echo form_error('address', ' <small class="form-text text-danger">', '</small>') ?>
<!--									</div>-->
<!--								</div>-->
<!--								<div class="col-md-6">-->
<!--									<div class="form-group">-->
<!--										<label for="city">--><?//= $this->lang->line('city') ?><!--</label>-->
<!--										<input type="text" class="form-control" id="city" name="city">-->
<!--										--><?php //echo form_error('city', ' <small class="form-text text-danger">', '</small>') ?>
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!---->
<!--							<div class="row" id="div-group">-->
<!--								<div class="col-md-6">-->
<!--									<div class="form-group">-->
<!--										<label for="group_id">Grupo de clientes</label>-->
<!--										<select name="group_id" id="group_id" class="form-control">-->
<!--											<option value="">--><?//= $this->lang->line('select') ?><!--</option>-->
<!--											--><?php //foreach ($this->core_model->get_all_order('customer_group') as $item): ?>
<!--												<option value="--><?//= $item->id ?><!--">--><?//= $item->name ?><!--</option>-->
<!--											--><?php //endforeach; ?>
<!--										</select>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="col-md-6">-->
<!--									<div class="form-group">-->
<!--										<label for="registration_number">Alvara</label>-->
<!--										<input type="text" class="form-control" id="registration_number"-->
<!--											   name="registration_number">-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!---->
<!--					<div class="card shadow-sm" id="div-responsible">-->
<!--						<div class="card-header pb-0">-->
<!--							<h6 class="card-title"><i-->
<!--									class="fa fa-user-tie">&nbsp;</i>--><?//= $this->lang->line('responsible') ?><!--</h6>-->
<!--						</div>-->
<!--						<div class="card-body">-->
<!--							<div class="row">-->
<!--								<div class="col-md-4">-->
<!--									<div class="form-group">-->
<!--										<label for="responsible_name">--><?//= $this->lang->line('name') ?><!--<span-->
<!--												class="text-danger">&nbsp;*</span></label>-->
<!--										<input type="text" class="form-control" id="responsible_name"-->
<!--											   name="responsible_name">-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="col-md-4">-->
<!--									<div class="form-group">-->
<!--										<label for="responsible_office">--><?//= $this->lang->line('position') ?><!--<span-->
<!--												class="text-danger">&nbsp;*</span></label>-->
<!--										<input type="text" class="form-control" id="responsible_office"-->
<!--											   name="responsible_office">-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="col-md-4">-->
<!--									<div class="form-group">-->
<!--										<label for="responsible_id">Numero de BI<span-->
<!--												class="text-danger">&nbsp;*</span></label>-->
<!--										<input type="text" class="form-control" id="responsible_id"-->
<!--											   name="responsible_id">-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="col-lg-4 pl-xl-2">-->
<!--					<div class="card shadow-sm">-->
<!--						<div class="card-body">-->
<!--							<div class="form-group">-->
<!--								<label for="note" class="text-capitalize">--><?//= $this->lang->line('note') ?><!--</label>-->
<!--								<textarea class="form-control" name="note" id="note" cols="30" rows="6"></textarea>-->
<!--								--><?php //echo form_error('note', ' <small class="form-text text-danger">', '</small>') ?>
<!--							</div>-->
<!--							<div class="d-flex justify-content-center">-->
<!--								<img class="card-img-top shadow-sm"-->
<!--									 src="--><?//= base_url('public/img/camera.png') ?><!--"-->
<!--									 title="Click to change image" id="image-element" alt="image category">-->
<!--							</div>-->
<!--						</div>-->
<!--						<input type="file" class="d-none" id="file-image">-->
<!--						<input type="hidden" id="image" name="image">-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div class="modal-footer">-->
<!--			<div class="d-flex justify-content-between w-100">-->
<!--				<button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal">-->
<!--					<i class="fa fa-arrow-left">&nbsp;</i>--><?//= $this->lang->line('cancel') ?>
<!--				</button>-->
<!--				<button type="submit" class="btn btn-sm btn-success" id="btn-modal-submit">-->
<!--					<i class="feather icon-save">&nbsp;</i>--><?//= $this->lang->line('save') ?>
<!--				</button>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</form>-->
<!---->
<!---->
<!--<script>-->
<!--	$(document).on('change', '.type_id', function () {-->
<!--		const value = $(this).val().toString();-->
<!--		hideDiv(value)-->
<!--	});-->
<!---->
<!--	// function hideDiv(value) {-->
<!--	// 	if (value === 'empresa') {-->
<!--	// 		$('#div-responsible').removeClass('d-none').find('input').prop('required', true)-->
<!--	// 		$('#div-group').removeClass('d-none')-->
<!--	// 	} else {-->
<!--	// 		$('#div-group').addClass('d-none').find('select').val('').trigger('change')-->
<!--	// 		$('#div-responsible').addClass('d-none').find('input').val('').prop('required', false)-->
<!--	// 	}-->
<!--	// }-->
<!--</script>-->
