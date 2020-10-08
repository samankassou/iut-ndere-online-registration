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
	<!-- main css -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/main.css">
	<title>IUT Concours | <?= $title ?></title>
</head>
<body>
	<!-- Page header -->
	<div class="header header_area navbar_fixed">
		<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
			<a class="navbar-brand" href="<?= base_url() ?>">
				<img src="<?= base_url('assets/img/logos/iut2.png') ?>" width="250" height="45" alt="iut ngaoundere"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item active ">
						<a class="nav-link" href="<?= base_url() ?>"><i class="fa fa-home"></i> Accueil <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#procedure"><i class="fa fa-clipboard"></i> Procédure</a>
					</li>
					<li class="nav-item">
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
	<div class="container-fluid">
		<!-- Bienvenue -->
		<div class="container-fluid welcome-zone jumbotron" >
			<h4 class="text-light text-center">Bienvenue sur la plateforme d'inscription en ligne aux concours de l'IUT de Ngaoundéré</h4>
		</div>
		<!-- /Bienvenue -->
		<!-- box des arrétés -->
		<div class="container-fluid mt-2">
			<div class="row">
				<div class="col-md-4 box-document img-zoom-hover">
					<div class="box-content ">
						<h2 class="text-center">Cycle DUT</h2>
						<div class="text-center img-zoom"><img src="<?= base_url() ?>assets/img/avatars/tech.svg" width="100" height="130"></div>
					</div>
					<!-- test -->
					<div class="col-md-12"><br>
					   <h5  class="text-center">
					   	   <span>Arrêtés Concours</span>
					   	</h5>
					
					    <p class="text-center">
						   <button class="btn btn-sm btn-dut-fr btn-pdf">
						  	 <img src="<?= base_url() ?>assets/img/svg/pdf-2.svg" width="30" height="30">
						     	 <br>
						  	          Fr
						   </button>
                           <button class="btn btn-sm btn-dut-en btn-pdf ">
                           	  <img src="<?= base_url() ?>assets/img/svg/pdf-2.svg" width="30" height="30">
                             	<br>
                                     En
                           </button>
				        </p>
				</div>
				<!-- test -->
				</div>
				<div class="col-md-4 box-document img-zoom-hover">
					<div class="box-content">
						 <h2 class="text-center">Cycle BTS</h2>
						     <div class="text-center img-zoom">
						     	 <img src="<?= base_url() ?>assets/img/avatars/tech.svg" width="100" height="130">
						     </div>
					</div>
				    <div class="col-md-12"><br>
					   <h5  class="text-center">
					  	    <span>Arrêtés Concours</span>
					   </h5>
					
					   <p class="text-center">
						   <button class="btn btn-sm btn-bts-fr btn-pdf ">
						 	   <img src="<?= base_url() ?>assets/img/svg/pdf-2.svg" width="30" height="30">
						 	   <br>
						 	       Fr
						   </button>
                           <button class="btn btn-sm btn-bts-en btn-pdf ">
                         	    <img src="<?= base_url() ?>assets/img/svg/pdf-2.svg" width="30" height="30">
                         	    <br>
                                    En
                            </button>
				      </p>
				    </div>
				</div>
				<div class="col-md-4 box-document img-zoom-hover">
					<div class="box-content">
						<h2 class="text-center">Cycle Licence</h2>
						<div class="text-center img-zoom" style="min-height: 100px;"><img src="<?= base_url() ?>assets/img/avatars/ingenieur1.svg" width="100" height="130"></div>
					</div>
					<div class="col-md-12"><br>
					    <h5  class="text-center"><span>Arrêtés Concours</span></h5>
					
					    <p class="text-center">
						   <button class="btn btn-sm btn-litech-fr btn-pdf">
						   	    <img src="<?= base_url() ?>assets/img/svg/pdf-2.svg" width="30" height="30">
						   	    <br>
						   	       Fr
						   	</button>
                           <button class="btn btn-sm btn-litech-en btn-pdf">
                           	   <img src="<?= base_url() ?>assets/img/svg/pdf-2.svg" width="30" height="30">
                           	   <br>
                           	       En
                            </button>
				        </p>
				    </div>
				</div>

			</div>
		</div>
		<!-- /box des arrétés -->
		<div class="container-fluid mt-4">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						<a href="<?= base_url('registration') ?>" class="btn btn-pos"><h3>Postuler</h3></a>
					</div>
				</div>
			</div>
		</div>
		<!-- instructions -->
		<div class="container box-instructions mt-4">
			<h2 class="text-danger text-center" style="margin-top: 10px;"><u>IMPORTANT!</u></h2>
			<h2 class="text-center" id="procedure">ÉTAPES A SUIVRE <u><span class="text-danger ">SCRUPULEUSEMENT</span></u> POUR SOUMETTRE UN DOSSIER DE CANDIDATURE</h2>
			<div class="border-radius border p-4">
				<div class="box-item">
					<div class="row">
						<div class="col-md-12">
							<div class="box_etapes img-zoom-hover">
								<div class="text-center img-zoom">
									<img src="<?= base_url() ?>assets/img/svg/1.svg" width="70" height="100">
                           	    </div>
                           	    <br>
								<h3 class="ml-4"><i class="fa fa-credit-card"></i> Paiement des droits de concours
								</h3>
								<p class="text-justify p-3"><i class="fa fa-check"></i> Payer les droits de concours auprès des structures mentionnées dans l'Arrêté ministériel d'ouverture du concours.
								</p>
							</div>
						</div>
					</div>
				</div>
			<div class="box-item">
						<div class="row">
							<div class="col-md-12">
								<div class="box_etapes img-zoom-hover">
									<div class="text-center img-zoom">
										<img src="<?= base_url() ?>assets/img/svg/2.svg" width="70" height="100">
                           	    	</div>
									<h3 class="ml-4"><i class="fa fa-user"></i> Inscription sur la plateforme</h3>
									<p class="text-justify p-3"><i class="fa fa-check"></i> S'inscrire sur la plateforme avec votre reçu de paiement.</p>
								</div>
							</div>
						</div>
			</div>
			<div class="box-item">
						<div class="row">
							<div class="col-md-12">
								    <div class="box_etapes img-zoom-hover">
										<div class="text-center img-zoom">
											<img src="<?= base_url() ?>assets/img/svg/3.svg" width="70" height="100">
                           	    		</div>
										<h3 class="ml-4"><i class="fa fa-download"></i> Impression de la fiche</h3>
										<p class="text-justify p-3"><i class="fa fa-check"></i> Télécharger et imprimer la fiche obtenue et l'imprimer.</p>
									</div>
							</div>
						</div>
			</div>
			<div class="box-item">
						<div class="row">
							<div class="col-md-12">
								<div class="box_etapes img-zoom-hover">
									<div class="text-center img-zoom">
										<img src="<?= base_url() ?>assets/img/svg/4.svg" width="70" height="100">
                           	    	</div>
									<h3 class="ml-4"><i class="fa fa-book"></i> Constitution du dossier physique</h3>
									<p class="text-justify p-3"><i class="fa fa-check"></i>complétez la fiche avec toutes les autres pièces indiquées dans l'Arrété ministériel et déposez le dossier physique dans le lieu indiqué lors du remplissage du formulaire.</p>
								</div>
							</div>
						</div>
			</div>
			
		</div>
	</div>
						<!-- /instructions -->

</div>
					<!-- /Page container -->

					<!-- footer -->
					<div class="container-fluid footer">
						<div class="container text-center ">
							<div class="row ">
								<div class="col-md-4">
									<span class="h3 text-center text-light">FORMATIONS</span>
									<ul>
										<li class="text-light">Cycle DUT</li>
										<li class="text-light">Cycle BTS</li>
										<li class="text-light">Cycle Licence de Technologies</li>
									</ul>
								</div>
								<div class="col-md-4">
									<span class="h3 text-center text-light">SERVICES</span>
									<ul>
										<li class="text-light">Division des Stages</li>
										<li class="text-light">Division de la formation initiale</li>
										<li class="text-light">Scolarité</li>
									</ul>
								</div>
								<div class="col-md-4"  id="contact">
									<span class="h3 text-center text-light">CONTACTS</span>
									<ul>
										<li class="text-light">Direction Tél.: 6 97 51 88 51 </li>
										<li class="text-light">Service de la scolarité Tél.: 6 97 51 88 51 </li>
										<li class="text-light">Email: iut@ndere.cm</li>
									</ul>
								</div>
							</div>
							<div class="text-center text-light mt-5"><span>&copy; <a href="http://iut.univ-ndere.cm/">IUT de Ngaoundéré 2020</a></span></div>
						</div>
					</div>

					<!-- The Modal -->
					<div class="modal fade" id="myModal">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">

								<!-- Modal Header -->
								<div class="modal-header">
									<h4 class="modal-title">Modal Heading</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<!-- Modal body -->
								<div class="modal-body">
									Modal body..
								</div>

								<!-- Modal footer -->
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
								</div>

							</div>
						</div>
					</div>
					<!-- javascript files -->
					<script src="<?= base_url('assets/vendor/jquery/jquery-3.5.1.min.js') ?>"></script>
					<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
					<script src="<?= base_url('assets/vendor/jquery/popper.min.js') ?>"></script>
					<script>
                              // Boutons DUT 
						$('.btn-dut-fr').on('click', function() {
							$('.modal-title').text('Arrété Ministériel du DUT');
							$('.modal-body').html("<iframe src=<?= base_url().'assets/documents/arretes/Arrété_DUT_fr.pdf' ?> height=\"800px\" width=\"100%\" frameborder=\"1\"></iframe>")
							$('.modal').modal('show');
						});

						$('.btn-dut-en').on('click', function() {
							$('.modal-title').text('Arrété Ministériel du DUT');
							$('.modal-body').html("<iframe src=<?= base_url().'assets/documents/arretes/Arrété_DUT_en.pdf' ?> height=\"800px\" width=\"100%\" frameborder=\"1\"></iframe>")
							$('.modal').modal('show');
						});
                                // Boutons BTS
						$('.btn-bts-fr').on('click', function() {
							$('.modal-title').text('Arrété Ministériel du BTS');
							$('.modal-body').html("<iframe src=<?= base_url().'assets/documents/arretes/Arreté_BTS_fr.pdf' ?> height=\"800px\" width=\"100%\" frameborder=\"1\"></iframe>")
							$('.modal').modal('show');
						});

						$('.btn-bts-en').on('click', function() {
							$('.modal-title').text('Arrété Ministériel du BTS');
							$('.modal-body').html("<iframe src=<?= base_url().'assets/documents/arretes/Arrété_BTS_en.pdf' ?> height=\"800px\" width=\"100%\" frameborder=\"1\"></iframe>")
							$('.modal').modal('show');
						});
                                //  Boutons LITECH
						$('.btn-litech-fr').on('click', function() {
							$('.modal-title').text('Arrété Ministériel de la Licence Tecnologique');
							$('.modal-body').html("<iframe src=<?= base_url().'assets/documents/arretes/Arrété_LITECH_fr.pdf' ?> height=\"800px\" width=\"100%\" frameborder=\"1\"></iframe>")
							$('.modal').modal('show');
						});
						$('.btn-litech-en').on('click', function() {
							$('.modal-title').text('Arrété Ministériel de la Licence Tecnologique');
							$('.modal-body').html("<iframe src=<?= base_url().'assets/documents/arretes/Arrété_LITECH_en.pdf' ?> height=\"800px\" width=\"100%\" frameborder=\"1\"></iframe>")
							$('.modal').modal('show');
						});
					</script>
				</body>
				</html>
