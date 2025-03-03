<form id="form-company" method="post" autocomplete="off" class="h-100">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title text-agata">
				<i class="feather icon-plus">&nbsp;</i><?= $this->lang->line('edit') . ' ' . $this->lang->line('company') ?>
			</h5>
		</div>
		<div class="modal-body bg-gray-200">
			<div class="row">
				<div class="col-lg-9 mb-3">
					<div class="card mb-4">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 form-group">
									<label for="name"><?= $this->lang->line('name') ?> <span class="text-danger">&nbsp;*</span></label>
									<input type="text" id="name" name="name" class="form-control" value="<?= $company->name ?>" required>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="site_url"><?= $this->lang->line('website_url') ?></label>
									<input type="text" id="site_url" name="site_url" class="form-control" value="<?= $company->site_url ?>">
								</div>

								<div class="col-md-6 form-group">
									<label for="nuit">NUIT</label>
									<input type="text" id="nuit" name="nuit" class="form-control" value="<?= $company->nuit ?>">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="phone"><?= $this->lang->line('phone') ?></label>
									<input type="text" id="phone" name="phone" class="form-control" value="<?= $company->phone ?>">
								</div>
								<div class="col-md-6 form-group">
									<label for="phone2"><?= $this->lang->line('phone_alternative') ?></label>
									<input type="text" id="phone2" name="phone2" class="form-control" value="<?= $company->phone2 ?>">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="email">Email</label>
									<input type="text" id="email" name="email" class="form-control" value="<?= $company->email ?>">
								</div>
								<div class="col-md-6 form-group">
									<label for="address"><?= $this->lang->line('address') ?></label>
									<input type="text" id="address" name="address" class="form-control" value="<?= $company->address ?>">
								</div>
							</div>

							<div class="row">
								<div class="col-md-6 form-group">
									<label for="city"><?= $this->lang->line('city') ?></label>
									<input type="text" id="city" name="city" class="form-control" value="<?= $company->city ?>">
								</div>

								<div class="col-md-6 form-group">
									<label for="state_region"><?= $this->lang->line('region') ?></label>
									<select name="state_region" id="state_region" class="form-control">
										<option value="Sul"><?= $this->lang->line('South') ?></option>
										<option value="Centro"><?= $this->lang->line('Center') ?></option>
										<option value="Norte"><?= $this->lang->line('North') ?></option>
										<option value="Este"><?= $this->lang->line('East') ?></option>
										<option value="Oeste"><?= $this->lang->line('West') ?></option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="password">Password</label>
									<input type="password" id="password" name="password" class="form-control" value="<?= $company->password ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 mb-lg-0">
					<?php if ($this->ion_auth->in_group(array('super admin'))) : ?>
						<div class="form-group d-none">
							<label for="company_id"><?= $this->lang->line('company') ?></label>
							<select name="" id=""></select>
							<input value="1" type="text" id="company_id" name="company_id" class="form-control">
						</div>
					<?php else : ?>
						<input value="1" type="hidden" id="company_id" name="company_id" class="form-control">
					<?php endif; ?>
					<div class="card mb-4">
						<div class="card-body pb-5 pt-lg-5">
							<input type="hidden" id="image_data_company" name="image">
							<input type="file" id="file_image_company" class="d-none" accept="image/x-png,image/gif,image/jpeg">
							<div class="d-flex justify-content-center">
								<img class="shadow-sm img-to-upload" src="<?= base_url('public/img/logo.png') ?>" title="Click to change image" id="image_company" alt="image">
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="action" value="update">
			<input type="hidden" name="id" value="<?= $company->id ?>">
		</div>
		<div class="modal-footer">
			<div class="d-flex justify-content-between w-100">
				<button type="button" class="btn btn-sm btn-secondary">
					<?= $this->lang->line('cancel') ?>
				</button>
				<button type="submit" class="btn btn-sm btn-success">
					<i class="feather icon-save">&nbsp;</i><?= $this->lang->line('update') ?>
				</button>
			</div>
		</div>
	</div>

</form>