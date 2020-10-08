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
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/datatables/css/dataTables.bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/datatables/css/jquery.dataTables.min.css') ?>">
	<!-- main css -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/main.css">
	<title>IUT Concours | <?= $title ?></title>
</head>
<!-- Page header -->
<div class="header">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="<?= base_url() ?>">IUT <span class="navbar-concours">CONCOURS</span></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="<?= base_url() ?>"><i class="fa fa-home"></i> Accueil <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('registration') ?>"><i class="fa fa-user"></i> S'inscrire</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#"><i class="fa fa-phone"></i> Contacts</a>
				</li>
			</ul>
		</div>
	</nav>
</div>
<!-- /Page header -->
<div class="container">
	<div class="jumbotron">
		<h3><?= $title ?></h3>
	</div>

	<div class="container">
		<div class="table-responsive">
			<table id="table_candidat" class="table table-bordered table-hover" style="width: 100%;">
				<thead>
					<th>Nom(s)</th>
					<th>Prénom(s)</th>
					<th>Date de naissance</th>
					<th>Mode admission</th>
					<th>Sexe</th>
					<th>Cycle</th>
					<th>Région</th>
					<th>Pays</th>
					<th>Fiche en pdf</th>
				</thead>
				<tbody>
					<?php if (!empty($candidats)) {
						foreach ($candidats as $candidat) {?>
							<tr id="<?= $candidat->id_candidat ?>">
								<td><?= $candidat->nom_candidat ?></td>
								<td><?= $candidat->prenom_candidat ?></td>
								<td><?= nice_date($candidat->date_naiss, 'd-m-Y') ?></td>
								<td><?= $candidat->mode_admission ?></td>
								<td><?= ($candidat->sexe === 'm')? 'Masculin':'Féminin' ?></td>
								<td><?= $candidat->abreviation_cycle ?></td>
								<td><?= $candidat->nom_reg_or ?></td>
								<td><?= $candidat->nom_pays ?></td>
								<td><button class="btn btn-xs btn-warning btn-print"><i class="fa fa-print"></i></button></td>
							</tr>
					<?php	}
					}?>
				</tbody>
				<thead>
					<th>Nom(s)</th>
					<th>Prénom(s)</th>
					<th>Date de naissance</th>
					<th>Mode admission</th>
					<th>Sexe</th>
					<th>Cycle</th>
					<th>Région</th>
					<th>Pays</th>
					<th></th>
				</thead>
			</table>
		</div>
	</div>
</div>

<!-- footer -->
<div class="container-fluid footer">
	<div class="container text-center">
		<div class="row ">
			<div class="col-md-4">
				<span class="h3 text-center">FORMATIONS</span>
				<ul>
					<li>DUT</li>
					<li>BTS</li>
					<li>Licence Tecnologique</li>
				</ul>
			</div>
			<div class="col-md-4">
				<span class="h3 text-center">SERVICES</span>
				<ul>
					<li>Concours 1</li>
					<li>Concours 1</li>
					<li>Concours 1</li>
				</ul>
			</div>
			<div class="col-md-4">
				<span class="h3 text-center">CONTACTS</span>
				<ul>
					<li>Concours 1</li>
					<li>Concours 1</li>
					<li>Concours 1</li>
				</ul>
			</div>
		</div>
		<div class="text-center mt-5"><span>&copy; <a href="#">IUT de Ngaoundéré 2020</a></span></div>
	</div>
</div>
<!-- javascript files -->
<script src="<?= base_url('assets/vendor/jquery/jquery-3.5.1.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/jquery/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/jquery/jquery.steps.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/js/dataTables.bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/alertifyjs/alertify.min.js') ?>"></script>
<script src="<?= empty($js)?'':$js ?>"></script>
<script>
	var base_url = "<?= base_url() ?>";
	$(function () {
		$('#table_candidat').dataTable({
			stateSave: true
		});

		$('.btn-print').on('click', function(){
			var id = $(this).parents('tr').attr('id');

			window.location.href = base_url + 'generation/generer/'+id;
		});
	});
</script>
</body>
</html>