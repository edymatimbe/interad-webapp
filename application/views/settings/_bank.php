<div class="card-header py-0 px-0">
	<div class="row">
		<div class="col-4 pl-4 pt-3">
			<h6 class="pl-3">
				<i class="feather icon-credit-card">&nbsp;</i>
				<?= $this->lang->line('bank_accounts') ?>
			</h6>
		</div>
		<div class="col-8">
			<nav>
				<div class="nav nav-tabs bg-gray-400 pt-2 px-2 rounded-top" id="nav-tab" role="tablist">
					<a class="nav-item nav-link active" id="nav-bank-tab" data-toggle="tab" href="#nav-bank"
					   role="tab"
					   aria-controls="nav-bank" aria-selected="true">Nome de bancos</a>
					<a class="nav-item nav-link" id="nav-bank-account-tab" data-toggle="tab" href="#nav-bank-account"
					   role="tab"
					   aria-controls="nav-error" aria-selected="false">Contas bancarias</a>
				</div>
			</nav>
		</div>
	</div>
</div>

<div class="card-body pb-0">
	<div class="tab-content pb-0 pt-2" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-bank" role="tabpanel" aria-labelledby="nav-bank-tab">
			<div class="row">
				<div class="col-md-6">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
							<tr>
								<th style="width: 60%"><?= $this->lang->line('name') ?></th>
								<th style="width: 20%"></th>
							</tr>
							</thead>
							<tbody>
							<?php $counter = 1 ?>
							<?php foreach ($this->core_model->get_all_order('bank') as $bank): ?>
								<tr>
									<td><?= $bank->name ?></td>
									<td class="text-center">
										<a href="#!"><i
												class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a>
										<a href="#!"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
									</td>
								</tr>
								<?php $counter += 1 ?>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card shadow-none border">
						<div class="card-header">
							<h6 class="card-title mb-0">
								<i class="feather icon-plus">&nbsp;</i>
								<?= $this->lang->line('new') . ' banco' ?>
							</h6>
						</div>
						<div class="card-body pb-0">
							<div class="row">
								<div class="col-md-12 form-group">
									<label for="bank_name"><?= $this->lang->line('name') ?> <span
											class="text-danger">&nbsp;*</span></label>
									<input type="text" id="bank_name" name="name" class="form-control f-s-13" required>
								</div>
							</div>

							<div class="row d-none">
								<div class="col-md-12 form-group">
									<label for="abbreviation"><?= $this->lang->line('abbreviation') ?><span
											class="text-danger">&nbsp;*</span></label>
									<input type="text" id="abbreviation" name="abbreviation"
										   class="form-control f-s-13">
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-sm btn-outline-success float-right">
								<i class="feather icon-save mr-2"></i>
								<?= $this->lang->line('save') ?>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="nav-bank-account" role="tabpanel" aria-labelledby="nav-bank-account-tab">
			<div class="row">
				<div class="col-md-6">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
							<tr>
								<th style="width: 50%">Banco</th>
								<th style="width: 20%">Numero</th>
								<th style="width: 20%">Mostrar na factura</th>
								<th style="width: 10%"></th>
							</tr>
							</thead>
							<tbody>
							<?php $counter = 1 ?>
							<?php foreach ($this->core_model->get_all('bank_account') as $bank_account): ?>
								<?php $bank = $this->core_model->get_by_id('bank', array('id' => $bank_account->bank_id)) ?>
								<tr>
									<td><?= $bank->name ?></td>
									<td><?= $bank_account->number ?></td>
									<td class="text-center">
										<a href="#!"><i
												class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a>
										<a href="#!"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
									</td>
								</tr>
								<?php $counter += 1 ?>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card shadow-none border">
						<div class="card-header">
							<h6 class="card-title mb-0">
								<i class="feather icon-plus">&nbsp;</i>
								<?= $this->lang->line('newa') . ' Conta bancaria' ?>
							</h6>
						</div>
						<div class="card-body pb-0">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="bank_account_name"><?= $this->lang->line('name') ?> <span
												class="text-danger">&nbsp;*</span></label>
										<select name="name" id="bank_account_name" class="select2-no-search"
										style="width: 100%;">
											<?php foreach ($this->core_model->get_all_order('bank') as $bank): ?>
												<option value="<?=$bank->id?>"><?=$bank->name?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="bank_account_number">Numero<span
												class="text-danger">&nbsp;*</span></label>
										<input type="text" id="bank_account_number" name="bank_account_number"
											   class="form-control f-s-13">
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-sm btn-outline-success float-right">
								<i class="feather icon-save mr-2"></i>
								<?= $this->lang->line('save') ?>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
