<!DOCTYPE html>
<html lang="en">
<head>
<title><?= (isset($title) ? '41 BUSNESS CENTER | ' . $title : '41 BUSNESS CENTER') ?></title>
	<link rel="icon" href="<?= base_url(); ?>public\41\src.png">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	

	<link href="<?= base_url(); ?>public/css/style.css" rel="stylesheet">
	<link href="<?= base_url(); ?>public/assets/auth/auth.css" rel="stylesheet">
	<link href="<?= base_url(); ?>public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>public/vendor/fontawesome-free/css/v4-shims.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>public/vendor/feather-icon/feather.css" rel="stylesheet" type="text/css">
	<script src="<?= base_url(); ?>public/js/jquery.min.js"></script>

	<?php if (isset($styles)): ?>
		<?php foreach ($styles as $style): ?>
			<link href="<?= base_url() ?>public/<?= $style ?>" rel="stylesheet">
		<?php endforeach; ?>
	<?php endif ?>
	<?php if (isset($cdns_css)): ?>
		<?php foreach ($cdns_css as $cdn): ?>
			<link href="<?= $cdn ?>" rel="stylesheet">
		<?php endforeach; ?>
	<?php endif ?>
	<link href="<?php echo base_url(); ?>public/css/custom.css" rel="stylesheet">
</head>
<body class="position-relative bg-none bg-white">
<div class="preloader">
	<svg class="circular" viewBox="25 25 50 50">
		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
	</svg>
</div>

<div class="preloader-2" id="loader-two">
	<svg class="circular" viewBox="25 25 50 50">
		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
	</svg>
</div>

<div class="container-fluid h-100 px-0 overflow-hidden">
