<div class="card shadow mb-4">
	<div class="card-body">
		<div class="row mb-lg-2 d-flex justify-content-between">
			<div class="col-md-4">
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text border-right-0 bg-white rounded-left"><i class="fa fa-search"></i>
						</div>
					</div>
					<input type="text" class="form-control border-left-0" id="my-search" autocomplete="off"
						   placeholder="<?= $this->lang->line('search') ?>">
				</div>
			</div>
			<div class="col-md-2">
				<?php if ($this->core_model->is_granted('user_create')): ?>
					<button class="btn btn-dark float-right br-2 text-nowrap" type="button" onclick="add_user()">
						<i class="feather icon-plus">&nbsp;</i><?= $this->lang->line('add') . ' ' . $this->lang->line('user') ?>
					</button>
				<?php endif; ?>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered" id="table-user">
				<thead>
				<tr>
					<th class="text-center no-sort" style="width: 5%">#</th>
					<th style="width: 20%"><?= $this->lang->line('first_name') ?></th>
					<th style="width: 20%"><?= $this->lang->line('last_name') ?></th>
					<th class="text-capitalize" style="width: 15%">Email</th>
					<th style="width: 10%" class="text-left text-capitalize"><?= $this->lang->line('profile') ?></th>

					<?php if ($this->core_model->is_granted('user_update')): ?>
						<th style="width: 15%"
							class="text-capitalize text-center"><?= $this->lang->line('status') ?></th>
					<?php endif; ?>
					<th style="width: 15%"
						class="text-center no-sort text-capitalize"><?= $this->lang->line('actions') ?></th>
				</tr>
				</thead>

				<tbody>
				<?php $counter = 1; ?>
				<?php foreach ($users as $user): ?>
					<tr class="text-nowrap">
						<td class="text-center pl-4"><?= $counter++ ?></td>
						<td><?= $user->first_name ?></td>
						<td><?= $user->last_name ?></td>
						<td><?= $user->email ?></td>
						<?php $user_groups = $this->ion_auth->get_users_groups($user->id)->row(); ?>
						<td><?= $user_groups ? $user_groups->description : '' ?></td>
						<td class="text-center">
							<?php if ($user->active == 1): ?>
								<input checked class="toggle-switch" type="checkbox" value="0"
									   data-id="<?= $user->id ?>" data-table="users">
							<?php else: ?>
								<input class="toggle-switch" value="1" type="checkbox" data-id="<?= $user->id ?>"
									   data-table="users">
							<?php endif ?>
						</td>
						<td class="text-center px-2">
							<a onclick="show_user(<?= $user->id ?>)" title="Show user"
							   class="btn btn-sm btn-outline-primary mr-2"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;<?= $this->lang->line('show') ?>
							</a>
							<a onclick="edit_user(<?= $user->id ?>,'index')" title="Edit user"
							   class="btn btn-sm btn-outline-secondary px-2">
								<i class="fa fa-edit" aria-hidden="true"></i>&nbsp;<?= $this->lang->line('edit') ?>
							</a>
							<button data-toggle="modal" data-target="#modal-delete" title="Delete"
									onclick="delete_user('<?= base_url('user/delete/' . $user->id) ?>')"
									class="btn btn-sm btn-outline-danger d-none"><i
										class="fa fa-user-times"></i>&nbsp;<?= $this->lang->line('remove') ?>
							</button>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script !src="">
	$(document).ready(function () {
		initDataTable('table-user')
	})
</script>
