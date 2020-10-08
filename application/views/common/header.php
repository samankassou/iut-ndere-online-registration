<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Site d'inscription en ligne aux concours de l'IUT de Ngaoundéré">
	<meta name="author" content="Concours">
	<!-- logo -->
	<link rel="shortcut icon" href="<?= img_url('logos/logo_iut.jpg')?>">
	<!-- bootstrap file -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
	<!-- fontawesome -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/fontawesome/css/all.min.css') ?>">
	<!-- alertify -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/alertifyjs/css/alertify.min.css') ?>">
	<!-- main css -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/sweetalert/css/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="<?= empty($styles)?'':$styles ?>">

	
	<title>IUT Concours | <?= $title ?></title>
</head>
<body>
	<!-- Page header -->
	<div class="header header_area navbar-fixed">
		<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
			<a class="navbar-brand" href="<?= base_url() ?>">
				<img src="<?= base_url('assets\img\logos\iut2.png') ?>" width="250" height="45" alt="iut ngaoundere"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url() ?>"><i class="fa fa-home"></i> Accueil <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('#procedure')?>"><i class="fa fa-clipboard"></i> Procedure</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="<?= base_url('registration') ?>"><i class="fa fa-user"></i> S'inscrire</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#contact"><i class="fa fa-phone"></i> Contacts</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
	<!-- /Page header -->
	
	<!-- Page container -->
	
		<!-- /Bienvenue -->