<header id="header" class="header fixed-top">
	<div class="container-fluid container-xl d-flex align-items-center justify-content-between">
		<a href="<?= base_url() ?>" class="logo d-flex align-items-center">
			<img src="<?= base_url() ?>public/img/logo/invoice_logo.png" alt="logo">
		</a>

		<nav id="navbar" class="navbar">
			<ul>
				<li><a class="nav-link scrollto" id="nav-link-home" href="<?= base_url('') ?>"><?= $this->lang->line('start') ?></a></li>
				<!-- <li><a class="nav-link scrollto" href="#about">About</a></li> -->
				<li><a class="nav-link scrollto" id="nav-link-pricing" href="<?= base_url('pricing') ?>"><?= $this->lang->line('prices') ?></a></li>
				<!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
				  <ul>
					<li><a href="#">Drop Down 1</a></li>
					<li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
					  <ul>
						<li><a href="#">Deep Drop Down 1</a></li>
						<li><a href="#">Deep Drop Down 2</a></li>
						<li><a href="#">Deep Drop Down 3</a></li>
						<li><a href="#">Deep Drop Down 4</a></li>
						<li><a href="#">Deep Drop Down 5</a></li>
					  </ul>
					</li>
					<li><a href="#">Drop Down 2</a></li>
					<li><a href="#">Drop Down 3</a></li>
					<li><a href="#">Drop Down 4</a></li>
				  </ul>
				</li> -->
				<li><a class="nav-link scrollto" id="nav-link-contacts" href="<?= base_url('contacts') ?>"><?= $this->lang->line('contacts') ?></a></li>
				<li><a class="getstarted scrollto" id="nav-link-auth" href="<?= base_url('auth') ?>"><?= $this->lang->line('get_demo') ?></a></li>
				<li>
					<?php if ($this->session->userdata('site_lang') == 'english') : ?>
						<a href="#" onclick="window.location.href='<?php echo base_url(); ?>LanguageSwitcher/index/portuguese';" class="mr-3" data-toggle="dropdown">
							<img src="<?= base_url(); ?>public/img/flag-mz.png" alt="" class="mr-2">
							<span class="pl-3 f-s-10">&nbsp;PT</span>
						</a>
					<?php else : ?>
						<a href="#" onclick="window.location.href='<?php echo base_url(); ?>LanguageSwitcher/index/english';" data-toggle="dropdown">
							<span class="mr-3">
								<img src="<?= base_url(); ?>public/img/flag-gb.png" alt="" class="mr-2">
							</span>
							<span class="pl-3 f-s-10">&nbsp;EN</span>
						</a>
					<?php endif; ?>
				</li>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		</nav>
	</div>
</header>