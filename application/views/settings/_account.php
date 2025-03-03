<form action="" id="form-company">
	<div class="card-header py-3">
		<h6 class="card-title mb-0">
			<i class="feather icon-settings">&nbsp;</i><?= $this->lang->line('account') ?>
		</h6>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-3 d-flex flex-column justify-content-center">
				<div>
					<input type="hidden" id="image_data_company" name="image">
					<input type="file" id="file_image_company" class="d-none" accept="image/x-png,image/gif,image/jpeg">
					<p class="text-center">
						<?php if ($company->image) : ?>
							<?php if (is_file(FCPATH . $company->image)) : ?>
								<img class="shadow-sm img-to-upload" style="border-radius: .35rem;" width="175" src="<?= base_url($company->image) ?>" alt="image" id="image_company">
							<?php else : ?>
								<img class="shadow-sm img-to-upload" width="175" style="border-radius: .35rem;" src="<?= base_url('public/img/camera.png') ?>" alt="image" id="image_company">
							<?php endif; ?>
						<?php else : ?>
							<img class="shadow-sm img-to-upload" width="175" style="border-radius: .35rem;" src="<?= base_url('public/img/camera.png') ?>" alt="image" id="image_company">
						<?php endif; ?>
					</p>
					<br>
					<p class="text-center">
						<button type="button" id="btn-change-image" class="btn btn-sm btn-secondary"><?= $this->lang->line('change_image') ?></button>
					</p>
				</div>
			</div>

			<div class="col-md-9">
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<label for="name">
								<?= $this->lang->line('name') ?><span class="text-danger">&nbsp;*</span>
							</label>
							<input type="text" id="name" name="name" class="form-control" value="<?= $company->name ?>" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="nuit">NUIT</label>
							<input type="text" id="nuit" name="nuit" class="form-control" value="<?= $company->nuit ?>" required>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="phone"><?= $this->lang->line('phone') ?></label>
							<input type="text" id="phone" name="phone" class="form-control" value="<?= $company->phone ?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="phone2"><?= $this->lang->line('phone_alternative') ?></label>
							<input type="text" id="phone2" name="phone2" class="form-control" value="<?= $company->phone2 ?>">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="telephone"><?= $this->lang->line('telephone') ?></label>
							<input type="text" id="telephone" name="telephone" class="form-control" value="<?= $company->telephone ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" id="email" name="email" class="form-control" value="<?= $company->email ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="city"><?= $this->lang->line('city') ?></label>
							<input type="text" id="city" name="city" class="form-control" value="<?= $company->city ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="address"><?= $this->lang->line('address') ?></label>
							<input type="text" id="address" name="address" class="form-control" value="<?= $company->address ?>">
						</div>
					</div>

					<div class="col-md-6 d-none">
						<div class="form-group">
							<label for="state_region"><?= $this->lang->line('region') ?></label>
							<select name="state_region" id="state_region" class="form-control">
								<option value="Sul"><?= $this->lang->line('South') ?></option>
								<option value="Centro"><?= $this->lang->line('Center') ?></option>
								<option value="Norte"><?= $this->lang->line('North') ?></option>
							</select>
						</div>
					</div>
					<input type="hidden" name="id" value="<?= $company->id ?>">
					<input type="hidden" name="action" value="update">
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<div class="d-flex justify-content-end">
			<button type="submit" class="btn btn-sm btn-success"><i class="feather icon-save">&nbsp;</i>
				<?= $this->lang->line('save') ?>
			</button>
		</div>
	</div>
</form>
