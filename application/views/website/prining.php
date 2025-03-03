<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Bigbazar Software</title>
	<?php $this->load->view('website/templates/head') ?>
</head>

<body>

<!-- ======= Header ======= -->
<?php $this->load->view('website/templates/header') ?>
<!-- End Header -->
<!-- <section class="breadcrumbs">
  <div class="container">

	<ol>
	  <li><a href="index.html">Inicio</a></li>
	  <li><a href="./contacts.html">Preços</a></li>
	</ol>
	<h2>Preços</h2>

  </div>
</section> -->
<!-- End Breadcrumbs -->

<section id="hero" class="hero-pricing d-flex align-items-end">

	<div class="container">
		<div class="row">
			<div class="d-flex flex-column justify-content-center text-center">
				<h1 data-aos="fade-up">Preços</h1>
				<p class ="mt-2" data-aos="fade-up" data-aos-delay="400">Veja a nossa tabela dos nossos produtos (Modulos)
				</p>
				<div data-aos="fade-up" data-aos-delay="600">
				</div>
			</div>
		</div>
	</div>

</section>
<!-- End Hero -->

<!-- ======= Pricing Section ======= -->
<section id="pricing" class="pricing">

	<div class="container" data-aos="fade-up">

		<div class="row gy-4" data-aos="fade-left">

			<div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
				<div class="box">
					<h3 style="color: #07d5c0;">Plano Livre</h3>
					<div class="price">0 <sup>MT</sup><span> / mes</span></div>
					<img src="<?=base_url('')?>public/img/website/pricing-free.png" class="img-fluid" alt="">
					<ul>
						<li>Aida dere</li>
						<li>Nec feugiat nisl</li>
						<li>Nulla at volutpat dola</li>
						<li class="na">Pharetra massa</li>
						<li class="na">Massa ultricies mi</li>
					</ul>
					<a href="#" class="btn-buy">Aderir</a>
				</div>
			</div>

			<div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
				<div class="box">
					<span class="featured">Destaque</span>
					<h3 style="color: #65c600;">Plano Inicial</h3>
					<div class="price">19 <sup>MT</sup><span> / mo</span></div>
					<img src="<?=base_url('')?>public/img/website/pricing-starter.png" class="img-fluid" alt="">
					<ul>
						<li>Aida dere</li>
						<li>Nec feugiat nisl</li>
						<li>Nulla at volutpat dola</li>
						<li>Pharetra massa</li>
						<li class="na">Massa ultricies mi</li>
					</ul>
					<a href="#" class="btn-buy">Aderir</a>
				</div>
			</div>

			<div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
				<div class="box">
					<h3 style="color: #ff901c;">Plano Negócios</h3>
					<div class="price">29 <sup>MT</sup><span> / mo</span></div>
					<img src="<?=base_url('')?>public/img/website/pricing-business.png" class="img-fluid" alt="">
					<ul>
						<li>Aida dere</li>
						<li>Nec feugiat nisl</li>
						<li>Nulla at volutpat dola</li>
						<li>Pharetra massa</li>
						<li>Massa ultricies mi</li>
					</ul>
					<a href="#" class="btn-buy">Aderir</a>
				</div>
			</div>

			<div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
				<div class="box">
					<h3 style="color: #ff0071;">Plano Completo</h3>
					<div class="price">49 <sup>MT</sup><span> / mo</span></div>
					<img src="<?=base_url('')?>public/img/website/pricing-ultimate.png" class="img-fluid" alt="">
					<ul>
						<li>Aida dere</li>
						<li>Nec feugiat nisl</li>
						<li>Nulla at volutpat dola</li>
						<li>Pharetra massa</li>
						<li>Massa ultricies mi</li>
					</ul>
					<a href="#" class="btn-buy">Aderir</a>
				</div>
			</div>

		</div>

	</div>

</section><!-- End Pricing Section -->
<!-- ======= Footer ======= -->
<?php $this->load->view('website/templates/footer') ?>
<!-- End Footer -->
<script>
	$('#nav-link-pricing').addClass('active')
</script>
</body>

</html>
