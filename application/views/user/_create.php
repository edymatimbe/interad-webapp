<form id="form-user" autocomplete="off" class="h-100">
	<input type="hidden" name="action" value="create">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title text-agata"><i
						class="feather icon-plus">&nbsp;</i><?= $this->lang->line('add') . ' ' . $this->lang->line('user') ?>
			</h5>
		</div>
		<div class="modal-body bg-gray-200">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<h6 class="card-text">
								<i class="feather icon-user">&nbsp;</i>
								<?= $this->lang->line('personal_data') ?>
							</h6>
						</div>
						<div class="card-body pb-1">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="first_name"><?= $this->lang->line('first_name') ?>
											<span class="text-danger">&nbsp;*</span></label>
										<input type="text" class="form-control" id="first_name" name="first_name"
											   required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="last_name"><?= $this->lang->line('last_name') ?><span
													class="text-danger">&nbsp;*</span></label>
										<input type="text" class="form-control" id="last_name" name="last_name"
											   required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="phone"><?= $this->lang->line('phone') ?></label>
										<input type="text" class="form-control" id="phone" name="phone">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="phone2"><?= $this->lang->line('phone_alternative') ?></label>
										<input type="text" class="form-control" id="phone2" name="phone2">
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="email">Email<span class="text-danger">&nbsp;*</span></label>
										<input type="email" class="form-control" id="email" name="email" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="nuit">NUIT</label>
										<input type="text" class="form-control" id="nuit" name="nuit">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="address"><?= $this->lang->line('address') ?></label>
									<input type="text" class="form-control" id="address" name="address">
								</div>
								<div class="col-md-6 form-group">
									<label for="city"><?= $this->lang->line('city') ?></label>
									<input type="text" class="form-control" id="city" name="city">
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="position"><?= $this->lang->line('occupation') ?></label>
										<input type="text" class="form-control" id="position" name="position">
									</div>
								</div>
							</div>
							<div class="form-group">
									<label for="note" class="text-capitalize"><?= $this->lang->line('note') ?></label>
								<textarea name="note" id="note" cols="30" rows="4" class="form-control" style="resize: none"></textarea>
							</div>

						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="bg-white rounded mb-4">
						<input type="hidden" id="image_data_user" name="image">
						<input type="file" id="file_image_user" class="d-none"
							   accept="image/x-png,image/gif,image/jpeg">
						<div class="d-flex justify-content-center py-3">
							<img class="shadow-sm img-to-upload bg-white"
								 src="<?= base_url('public/img/camera.png') ?>"
								 title="Click to change image" id="image_user" alt="image">
						</div>
					</div>
					
					<div class="card mb-4">
						<div class="card-header">
							<h6 class="card-text">
								<i class="feather icon-lock">&nbsp;</i><?= $this->lang->line('access') ?>
							</h6>
						</div>
						<div class="card-body pb-1">
							<div class="form-group">
								<label for="profile"><?= $this->lang->line('profile') ?></label>
								<select name="profile" id="profile" class="form-control">
									<option value="<?= 2 ?>"><?= $this->lang->line('admin') ?></option>
									<?php foreach ($this->core_model->get_all_order('groups') as $group): ?>
										<?php if ($group->name != 'super admin'): ?>
											<option value="<?= $group->id ?>"><?= $group->description ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label for="username"><?= $this->lang->line('username') ?></label>
								<input type="text" class="form-control" id="username" name="username">
							</div>
							<div class="form-group">
								<label for="password"><?= $this->lang->line('password') ?></label>
								<input type="password" class="form-control" id="password" name="password">
							</div>
							<div class="form-group">
								<label for="password_confirm"><?= $this->lang->line('password_confirm') ?></label>
								<input type="password" class="form-control" id="password_confirm"
									   name="password_confirm">
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
