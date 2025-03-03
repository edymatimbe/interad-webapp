<div class="row">
	<div class="col-12">
		<div class="profile-header  px-0">
			<div class="profile-header-cover bg-dark"></div>
			<div class="profile-header-content">
				<div class="profile-header-img shadow-sm d-flex flex-column justify-content-center">
					<img src="<?= base_url('public/img/logo.png') ?>" alt="" width="110" class=""/>
				</div>
				<div class="profile-header-info">
					<h4><?= $company->name ?></h4>
					<p class="pt-2"><?= $company->site_url ?>
						<button onclick="edit_company(<?=$company->id?>)" class="btn btn-sm btn-light width-100 float-right">
							<i class="fa fa-edit">&nbsp;</i> <?= $this->lang->line('edit') ?>
						</button>
					</p>
				</div>
			</div>
			<ul class="profile-header-tab nav nav-tabs">
				<li class="nav-item">
					<a href="#profile-post" class="nav-link active text-uppercase" data-toggle="tab">&nbsp; </a>
				</li>
			</ul>
		</div>
		<div class="profile-container mt-3">
			<div class="row row-space-20">
				<div class="col-xl-8">
					<div class="tab-content p-0">
						<div class="tab-pane fade show active" id="profile-post">
							<div class="card  border-0 shadow-sm">
								<div class="card-body border-0">
									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0 f-w-600">NUIT</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<?= $company->nuit ?>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0 f-w-600"><?= $this->lang->line('phone') ?></h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<?= $company->phone ?>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0 f-w-600"><?= $this->lang->line('phone_alternative') ?></h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<?= $company->phone ?>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0 f-w-600"><?= $this->lang->line('telephone') ?></h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<?= $company->telephone ?>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0 f-w-600">Email</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<?= $company->email ?>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0 f-w-600"><?= $this->lang->line('address') ?></h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<?= $company->address ?>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0 f-w-600"><?= $this->lang->line('city') ?></h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<?= $company->city ?>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<h6 class="mb-0 f-w-600">Site</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<?= $company->site_url ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4">
					<div class="card border-0 shadow-sm">
						<div class="card-header">
							<h6 class="card-text"><i
										class="fa fa-user-tie">&nbsp;</i> <?= $this->lang->line('responsible') ?></h6>
						</div>
						<div class="card-body py-4">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="<?= base_url('public/img/profile_male.svg') ?>"
									 class="rounded-circle shadow-sm"
									 width="150" alt="">
								<div class="mt-5">
									<h4><?= $responsible->first_name . ' ' . $responsible->last_name ?></h4>
									<p class="text-secondary d-none mb-1 f-s-13"><?= ($responsible->position) ? $responsible->position : ($this->ion_auth->is_admin($responsible->id) ? 'Administrator' : 'Seller') ?></p>
									<hr>
									<button class="btn btn-sm btn-outline-secondary d-none"
											onclick=""><i class="fa fa-eye">&nbsp;</i>
										<?= $this->lang->line('show') ?>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
