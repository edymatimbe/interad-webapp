<footer id="footer" class="footer">

	<div class="footer-newsletter">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-12 text-center">
					<h4><?= $this->lang->line('newsletter') ?></h4>
					<p><?= $this->lang->line('news_bigbsoft') ?></p>
				</div>
				<div class="col-lg-6">
					<form action="" method="post">
						<input type="email" name="email"><input type="submit" value="<?= $this->lang->line('subscribe') ?>">
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-top">
		<div class="container">
			<div class="row gy-4">
				<div class="col-lg-5 col-md-12 footer-info">
					<a href="index.html" class="logo d-flex align-items-center">
						<img src="<?= base_url() ?>public/img/logo/invoice_logo.png" alt="">

					</a>
					<p><?= $this->lang->line('offer_technological') ?></p>
					<div class="social-links mt-3">
						<a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
						<a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
						<a href="#" class="instagram"><i class="bi bi-instagram bx bxl-instagram"></i></a>
						<a href="#" class="linkedin"><i class="bi bi-linkedin bx bxl-linkedin"></i></a>
					</div>
				</div>

				<div class="col-lg-2 col-6 footer-links">
					<h4><?= $this->lang->line('useful_links') ?></h4>
					<ul>
						<li><i class="bi bi-chevron-right"></i> <a href="#"><?= $this->lang->line('start') ?></a></li>
						<li><i class="bi bi-chevron-right"></i> <a href="#"><?= $this->lang->line('services') ?></a></li>
						<li><i class="bi bi-chevron-right"></i> <a href="#"><?= $this->lang->line('prices') ?></a></li>
						<li><i class="bi bi-chevron-right"></i> <a href="#"> <?= $this->lang->line('terms_conditions') ?></a></li>
						<li><i class="bi bi-chevron-right"></i> <a href="#"> <?= $this->lang->line('privacy_policy') ?></a></li>
					</ul>
				</div>

				<div class="col-lg-2 col-6 footer-links">
					<h4><?= $this->lang->line('our_services') ?></h4>
					<ul>
						<li><i class="bi bi-chevron-right"></i> <a href="#"><?= $this->lang->line('point_sale') ?>(POS)</a></li>
						<li><i class="bi bi-chevron-right"></i> <a href="#"> <?= $this->lang->line('human_resources') ?></a></li>
						<li><i class="bi bi-chevron-right"></i> <a href="#"><?= $this->lang->line('accounting') ?></a></li>

					</ul>
				</div>

				<div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
					<h4>Contacte nos</h4>
					<p>
						Av. Agostinho Neto, Nr. 1242<br>
						Moçambique<br>
						Maputo<br><br>
						<strong>Tel:</strong> (+258) 86 303 3333<br>
						<strong>Email:</strong> pos@bigsoft.co.mz<br>
					</p>

				</div>

			</div>
		</div>
	</div>

	<div class="container">
		<div class="copyright">
			&copy; <script>
				document.write(new Date().getFullYear())
			</script> <strong><span>BigB Soft</span></strong>. <?= $this->lang->line('All_rights_are_reserved') ?>
		</div>
		<div class="credits">

		</div>
	</div>
</footer>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<!-- <script src="assets/vendor/aos/aos.js"></script> -->

<script src="<?= base_url() ?>public/js/jquery.min.js"></script>
<script src="<?= base_url() ?>public/vendor/website/php-email-form/validate.js"></script>
<script src="<?= base_url() ?>public/vendor/website/swiper/swiper-bundle.min.js"></script>
<script src="<?= base_url() ?>public/vendor/website/purecounter/purecounter.js"></script>
<script src="<?= base_url() ?>public/vendor/website/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url() ?>public/vendor/website/main.js"></script>

<!-- Template Main JS File -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
	AOS.init();
</script>
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>