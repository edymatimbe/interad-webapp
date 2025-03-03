<form id="form-user" autocomplete="off" class="h-100">
	<input type="hidden" name="action" value="update">
	<input type="hidden" name="id" value="<?= $user->id ?>">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title text-agata"><i
						class="feather icon-plus">&nbsp;</i><?= $this->lang->line('edit') . ' ' . $profile_or_user ?>
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
											   required  value="<?= $user->first_name ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="last_name"><?= $this->lang->line('last_name') ?><span
													class="text-danger">&nbsp;*</span></label>
										<input type="text" class="form-control" id="last_name" name="last_name"
											   required  value="<?= $user->last_name ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="phone"><?= $this->lang->line('phone') ?></label>
										<input type="text" class="form-control" id="phone" name="phone"  value="<?= $user->phone ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="phone2"><?= $this->lang->line('phone_alternative') ?></label>
										<input type="text" class="form-control" id="phone2" name="phone2"  value="<?= $user->phone2 ?>">
									</div>
								</div>

							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="email">Email<span class="text-danger">&nbsp;*</span></label>
										<input type="email" class="form-control" id="email" name="email" required  value="<?= $user->email ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="nuit">NUIT</label>
										<input type="text" class="form-control" id="nuit" name="nuit"  value="<?= $user->nuit ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="address"><?= $this->lang->line('address') ?></label>
									<input type="text" class="form-control" id="address" name="address"  value="<?= $user->address ?>">
								</div>
								<div class="col-md-6 form-group">
									<label for="city"><?= $this->lang->line('city') ?></label>
									<input type="text" class="form-control" id="city" name="city"  value="<?= $user->city ?>">
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="position"><?= $this->lang->line('occupation') ?></label>
										<input type="text" class="form-control" id="position" name="position" value="<?= $user->position ?>">
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
							<?php if ($user->image): ?>
								<?php if (is_file(FCPATH . $user->image)): ?>
									<img class="shadow-sm img-to-upload"
										 src="<?= base_url($user->image) ?>" alt="image"
										 title="Click to change image" id="image_user"
									>
								<?php else: ?>
									<img class="shadow-sm img-to-upload"
										 src="<?= base_url('public/img/camera.png') ?>" alt="image"
										 title="Click to change image" id="image_user">
								<?php endif; ?>
							<?php else: ?>
								<img class="shadow-sm img-to-upload" width="100%"
									 src="<?= base_url('public/img/camera.png') ?>" alt="image"
									 title="Click to change image" id="image_user">
							<?php endif;?>
						</div>
					</div>

					<div class="card mb-4">
						<div class="card-header">
							<h6 class="card-text">
								<i class="feather icon-lock">&nbsp;</i><?= $this->lang->line('access') ?>
							</h6>
						</div>
						<div class="card-body pb-1">
							<?php if($this->ion_auth->is_admin($user->id)):?>
								<div class="form-group">
									<label for="profile"><?= $this->lang->line('profile') ?></label>
									<select name="profile" id="profile" class="form-control">
										<?php foreach ($this->core_model->get_all_order('groups') as $group): ?>
											<?php if ($group->name != 'super admin'): ?>
												<?php if ($this->ion_auth->get_users_groups($user->id)->row()->id == $group->id) : ?>
													<option selected
															value="<?= $group->id ?>"><?= $group->description ?></option>
												<?php else: ?>
													<option value="<?= $group->id ?>"><?= $group->description ?></option>
												<?php endif; ?>
											<?php endif; ?>
										<?php endforeach; ?>
									</select>
								</div>
							<?php endif;?>
							<div class="form-group">
								<label for="username"><?= $this->lang->line('username') ?></label>
								<input type="text" class="form-control" id="username" name="username" value="<?= $user->username ?>">
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
					<i class="feather icon-save">&nbsp;</i><?= $this->lang->line('update') ?>
				</button>
			</div>
		</div>
	</div>
</form>
