


<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title text-agata"><?= $this->lang->line('show') . ' ' . $this->lang->line('user') ?>
		</h5>
	</div>
	<div class="modal-body bg-gray-200">
		<div class="profile-header  px-0">
			<!-- BEGIN profile-header-cover -->
			<div class="profile-header-cover bg-dark"></div>
			<div class="profile-header-content">
				<div class="profile-header-img shadow-sm">
					<?php if ($user->image): ?>
						<?php if (is_file(FCPATH . $user->image)): ?>
							<img class="my-border-radius" width="110"
								 src="<?= base_url($user->image) ?>" alt="image">
						<?php else: ?>
							<img class="" width="110"
								 src="<?= base_url('public/img/camera.png') ?>" alt="image">
						<?php endif; ?>
					<?php else: ?>
						<img src="<?=base_url('public/img/profile_male.svg')?>" width="110" alt="">

					<?php endif; ?>
				</div>
				<div class="profile-header-info">
					<h4 class="text-white"><?= $user->first_name . ' ' . $user->last_name ?></h4>
					<p class="text-white mb-1 f-s-13"><?=($user->position)?:($this->ion_auth->is_admin($user->id) ? 'Administrator' : 'Seller') ?></p>

					<button onclick="edit_user(<?= $user->id ?>,'index')" class="btn btn-sm btn-light width-100 float-right">
						<i class="fa fa-edit">&nbsp;</i> <?= $this->lang->line('edit') ?></button>
				</div>
			</div>
			<ul class="profile-header-tab nav nav-tabs">
				<li class="nav-item"><a href="#profile-post" class="nav-link active text-uppercase"
										data-toggle="tab"><?= $this->lang->line('about') ?> </a></li>
				<li class="nav-item"><a href="#profile-friends" class="nav-link text-uppercase"
										data-toggle="tab"><?= $this->lang->line('registered_products') ?></a></li>
			</ul>
		</div>
		<div class="profile-container mt-3">
			<div class="row row-space-20">
				<div class="col-xl-12">
					<div class="tab-content p-0">
						<div class="tab-pane fade show active" id="profile-post">
							<div class="card  border-0 shadow-sm">
								<div class="card-body border-0">

								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0"><?= $this->lang->line('full_name') ?></h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?= $user->first_name . ' ' . $user->last_name ?>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0">NUIT</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?= $user->nuit ?>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0">Email</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?= $user->email ?>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0"><?= $this->lang->line('phone') ?></h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?= $user->phone ?>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0"><?= $this->lang->line('phone_alternative') ?></h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?= $user->phone2 ?>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0"><?= $this->lang->line('address') ?></h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?= $user->address ?>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0"><?= $this->lang->line('city') ?></h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?= $user->city ?>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0 text-capitalize"><?= $this->lang->line('note') ?></h6>
									</div>
									<div class="col-sm-9 text-secondary">
										<?= $user->note ?>
									</div>
								</div>

							</div>
							</div>
						</div>
						<div class="tab-pane fade transition right" id="profile-friends">
							<div class="card">
								<div class="card-header">
									<h6 class="card-text text-capitalize">
										<i class="fa fa-tags">&nbsp;</i><?= $this->lang->line('products') ?>
									</h6>
								</div>
								<div class="card-body">
									<table class="table table-bordered" id="table-user-products">
										<thead>
										<tr>
											<th><?= $this->lang->line('description') ?></th>
											<th class="text-capitalize"><?= $this->lang->line('category') ?></th>
											<th class="text-capitalize"><?= $this->lang->line('date') ?></th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($products as $product): ?>
											<tr>
												<td><?= $product->name ?></td>
												<td><?= $this->core_model->get_by_id('category',array('id'=>$product->category_id))->name ?></td>
												<td><?= date_format(date_create($product->created_at),'d/m/Y') ?></td>
											</tr>
										<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
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
		</div>
	</div>
</div>
