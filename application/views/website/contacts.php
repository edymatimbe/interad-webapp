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
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
	<div class="container">

		<ol>
			<li><a href="<?=base_url('')?>">Inicio</a></li>
			<li><a href="<?=base_url('contacts')?>">Contactos</a></li>
		</ol>
		<h2>Contactos</h2>

	</div>
</section><!-- End Breadcrumbs -->

<div id="map">
	<div class="row">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3587.1621766058856!2d32.58014481557042!3d-25.962721060505647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1ee69b4cc4a838ff%3A0x98f6ab86f7ea6d1b!2sBig%20Bazar%20%7C%20O%20seu%20Mercado%20Online!5e0!3m2!1spt-PT!2smz!4v1624278074793!5m2!1spt-PT!2smz"
				width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
	</div>
</div>
<section id="contact" class="contact">
	<div class="container" data-aos="fade-up">
		<header class="section-header">
			<h2>Contacte</h2>
			<p>Contacte nos</p>
		</header>

		<div class="row gy-4">
			<div class="col-lg-6">
				<div class="row gy-4">
					<div class="col-md-6">
						<div class="info-box">
							<i class="bi bi-geo-alt"></i>
							<h3>Endereço</h3>
							<p>Av. Agostinho Neto, Nr. 1242<br>Moçambique - Maputo</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="info-box">
							<i class="bi bi-telephone"></i>
							<h3>Ligue nos</h3>
							<p>(+258) 86 303 3333<br>(+258) 86 303 3333</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="info-box">
							<i class="bi bi-envelope"></i>
							<h3>Email</h3>
							<p>pos@bigbazar.co.mz<br>pos@bigbazar.co.mz</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="info-box">
							<i class="bi bi-clock"></i>
							<h3>Aberto</h3>
							<p>Segunda à Sexta feira<br>Das 8:00 - 17:00</p>
						</div>
					</div>
				</div>

			</div>

			<div class="col-lg-6">
				<form action="forms/contact.php" method="post" class="php-email-form">
					<div class="row gy-4">

						<div class="col-md-6">
							<input type="text" name="name" class="form-control" placeholder="Seu nome" required>
						</div>

						<div class="col-md-6 ">
							<input type="email" class="form-control" name="email" placeholder="Seu Email" required>
						</div>

						<div class="col-md-12">
							<input type="text" class="form-control" name="subject" placeholder="Assunto" required>
						</div>

						<div class="col-md-12">
							<textarea class="form-control" name="message" rows="6" placeholder="Mensagem"
									  required></textarea>
						</div>

						<div class="col-md-12 text-center">
							<div class="loading">Loading</div>
							<div class="error-message"></div>
							<div class="sent-message">Your message has been sent. Thank you!</div>

							<button type="submit">Enviar Mensagem</button>
						</div>

					</div>
				</form>

			</div>

		</div>

	</div>
</section>

<!-- ======= Footer ======= -->
<?php $this->load->view('website/templates/footer') ?>
<!-- End Footer -->
<script>
	$('#nav-link-contacts').addClass('active')
</script>
</body>
</html>
