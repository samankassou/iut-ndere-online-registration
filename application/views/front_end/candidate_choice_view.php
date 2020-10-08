
<!-- page container -->
<div class="container-fluid choice-zone" style="min-height: 100vh;">
	<!-- Bienvenue -->
		<div class="container-fluid welcome-zone jumbotron" >
			<h3 class="text-light text-center">Choix du Cycle</h3>
		</div>
	<div class="row">
		<div class="col-md-4">
			<div class="row rounded border text-light" style="height: 100%;">
				<div class="col-md-12 effet_box_boutton"><br>
					<h3  class="text-center">
						<img src="<?= base_url() ?>assets/img/avatars/tech.svg" width="70" height="70">
						<span>DUT</span></h3>
					
					<p class="text-center"><a class="btn btn-outline-light" href="<?= base_url('registration/dut_registration') ?>">Postuler</a></p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="row rounded border text-light" style="height: 100%;">
				<div class="col-md-12 effet_box_boutton"><br>
					<h3  class="text-center">
						<img src="<?= base_url() ?>assets/img/avatars/tech.svg" width="70" height="70">
						<span> BTS</span>
					</h3>
					
					<p class="text-center"><a class="btn btn-outline-light" href="<?= base_url('registration/bts_registration') ?>">Postuler</a></p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="row rounded border text-light" >
				<div class="col-md-12 effet_box_boutton"><br>
					<h3  class="text-center">
						<img src="<?= base_url() ?>assets/img/avatars/ingenieur1.svg" width="70" height="70"> 
						<span> LiTech</span>
					</h3>
					
					<p class="text-center"><a class="btn btn-outline-light" href="<?= base_url('registration/litech_registration') ?>">Postuler</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page container -->