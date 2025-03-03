<div class="col-12">
	<div class="main-body">
		<div class="row gutters-sm">
			<div class="col-md-4 mb-3">
				<div class="card">
					<div class="card-body">
						<div class="d-flex flex-column align-items-center text-center">
							<img src="<?= base_url('public/img/profile_male.svg') ?>"
								 class="rounded-circle shadow-sm"
								 width="150" alt="">
							<div class="mt-3">
								<h4><?= $user->first_name . ' ' . $user->last_name ?></h4>
								<p class="text-secondary mb-1 f-s-13"><?= ($user->position) ? $user->position : ($this->ion_auth->is_admin($user->id) ? 'Administrator' : 'Seller') ?></p>
								<hr>
								<button class="btn btn-sm btn-secondary"
										onclick="edit_user(<?= $user->id ?>,'profile')"><i
										class="fa fa-edit">&nbsp;</i> <?= $this->lang->line('edit')?>
									<span class="text-lowercase"><?= $this->lang->line('profile')?></span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="card mt-3 d-none">
					<ul class="list-group list-group-flush">
						<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
							<h6 class="mb-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
									 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
									 stroke-linejoin="round"
									 class="feather feather-twitter mr-2 icon-inline text-info">
									<path
										d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
								</svg>
								Twitter
							</h6>
							<span class="text-secondary">@<?= $user->first_name ?></span>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
							<h6 class="mb-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
									 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
									 stroke-linejoin="round"
									 class="feather feather-instagram mr-2 icon-inline text-danger">
									<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
									<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
									<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
								</svg>
								Instagram
							</h6>
							<span class="text-secondary"><?= $user->first_name ?></span>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
							<h6 class="mb-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
									 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
									 stroke-linejoin="round"
									 class="feather feather-facebook mr-2 icon-inline text-agata">
									<path
										d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
								</svg>
								Facebook
							</h6>
							<span class="text-secondary"><?= $user->first_name ?></span>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card mb-3">
					<div class="card-body">
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0 f-w-600"><?= $this->lang->line('full_name') ?></h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user->first_name . ' ' . $user->last_name ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0 f-w-600">NUIT</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user->nuit ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0 f-w-600">Email</h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user->email ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0 f-w-600"><?= $this->lang->line('phone') ?></h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user->phone ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0 f-w-600"><?= $this->lang->line('phone_alternative') ?></h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user->phone2 ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0 f-w-600"><?= $this->lang->line('address') ?></h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user->address ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0 f-w-600"><?= $this->lang->line('city') ?></h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user->city ?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-3">
								<h6 class="mb-0 text-capitalize f-w-600"><?= $this->lang->line('note') ?></h6>
							</div>
							<div class="col-sm-9 text-secondary">
								<?= $user->note ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
