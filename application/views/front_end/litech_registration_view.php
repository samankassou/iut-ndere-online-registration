<div class="container-fluid" style="min-height: 100%">
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6"><div class="text-center alert alert-success"><h2>Formulaire d'inscription cycle Licence</h2></div></div>
		<div class="col-sm-3"></div>
		<div class="col-sm-2"></div>
		<div class="col-sm-8 m-auto bg-warning rounded">
			<div id="wizard">
				<form id="form_wizard" class="form" method="post" action="<?= base_url('registration/litech_save_folder') ?>">
					<!-- SECTION 1 -->
					<h4></h4>
					<section>
						<input type="hidden" name="cycle" class="form-control" value="LITECH">
                        	<div class="form-row">
						 		<input type="text" name="nom_candidat" class="form-control" placeholder="Nom(s)*">
                         		<span  id="errornom_candidat" class="errors text-danger"></span>
						    </div>
						    <div class="form-row"> 
						    	<input type="text" name="prenom_candidat" class="form-control" placeholder="Prénom(s)"> 
                         		<span  id="errorprenom_candidat" class="errors text-danger"></span>
							</div>		
							<div class="form-row">
								<select class="form-control" id="nationalite" name="nationalite">
								<option selected value="">--Nationalité--</option>
								<?php foreach( $pays as $pay): ?>
									<option value="<?= $pay->id_pays ?>">
										<?= $pay->nom_pays ?>
									</option>
								<?php endforeach; ?>
								</select>
								<span  id="errornationalite" class="errors text-danger"></span>
							</div>

							<div class="form-row">
								<select class="form-control" id="region" name="region_or">
									<option selected value="">--Région--</option>
								</select>
								<span class="help-block"></span>
								<span  id="erroregion_or" class="errors text-danger"></span>
							</div>
							
							<div class="form-row">
								<select class="form-control" name="sexe">
									<option selected value="">--Sexe--</option>
									<option value="m">Masculin</option>
									<option value="f">Féminin</option>
								</select>
								<span  id="errorsexe" class="errors text-danger"></span>
							</div>
							<div class="form-row">
						 		<input type="text" name="nom_mere" class="form-control" placeholder="Nom(s) de la Mère*">
                         		<span  id="errornom_mere" class="errors text-danger"></span>
						    </div>
						    <div class="form-row"> 
						    	<input type="text" name="nom_pere" class="form-control" placeholder="Nom(s) du Père"> 
                         		<span  id="errornom_pere" class="errors text-danger"></span>
							</div>
							
					</section> 
					<!-- /SECTION 1 -->
					<!-- SECTION 2 -->
					<h4></h4>
					<section>
							<div class="form-row">
								<label>Date de naissance: </label>
								<input type="date" name="date_naiss" class="form-control datepicker">
								<span  id="errordate_naiss" class="errors text-danger"></span>
							</div>
							<div class="form-row">
								<input type="text" name="lieu_naiss" class="form-control"  placeholder="Lieu de Naissance*"> 
								<span  id="errorlieu_naiss" class="errors text-danger"></span>
							</div>

							<div class="form-row">
								<input type="text" name="adress_perso" class="form-control" placeholder="Adresse personnelle*">
                         		
						 	</div>
							<div class="form-row">
								<input type="text" name="phone" class="form-control" placeholder="Numéro de Téléphone*">              
                         		<span  id="errorphone" class="errors text-danger"></span>
							</div>
							<div class="form-row"> 
								<input type="email" name="email" class="form-control" placeholder="Email*"> 
                         		<span  id="erroremail" class="errors text-danger"></span>
							</div>	
							<div class="form-row">
							<label>Exercez vous un emploi permanant ?: </label>
							<select class="form-control" name="emploi" id="emploi">
								<option value="">--veuillez sélectionner--</option>
								<option value="Oui">Oui</option>
								<option value="Non">Non</option>
							</select>
							<span  id="erroremploi" class="errors text-danger"></span>
						</div>

						<div class="form-row" id="employeur">
							
						</div>
						<div class="form-row" id="poste">
							
						</div>

					</section>
					<!-- /SECTION 2 -->
					<!-- SECTION 3 -->
					<h4></h4>
					<section>
						<div class="form-row">
							<label>Mention: </label>
							<select class="form-control" name="mention" id="mention">
								<option value="">--sélectionnez une mention--</option>
								<?php foreach($mentions as $mention): ?>
									<option value="<?= $mention->id_mention ?>">
										<?= $mention->nom_mention ?>(<?= $mention->sigle_mention ?>)
									</option>
								<?php endforeach; ?>
							</select>
							<span  id="errormention" class="errors text-danger"></span>
						</div>
						<div class="form-group" id="parcours">
							
						</div>
						<div class="form-row"> 
							<select class="form-control" name="diplome" id="diplome">
								<option value="id_diplome">--Diplôme--</option>
								<?php foreach($diplomes as $diplome): ?>
									<option value="<?= $diplome->id_diplome ?>">
										<?= $diplome->intitule_diplome ?>
									</option>
								<?php endforeach; ?>
							</select>
							<span  id="errordiplome" class="errors text-danger"></span>
						</div>
						<div class="form-row">
							<select class="form-control" name="annee_obt">
								<option value="">--Année d'obtention--</option>
								<?php $i = date('Y'); while($i > 2000): ?>
								<option value="<?= $i ?>">
									<?= $i ?>
									<?php $i--; endwhile; ?>
								</option>
							</select>
							<span  id="errorannee_obt" class="errors text-danger"></span>
						</div>
						<div class="form-row">
							<select class="form-control" name="pays_obt">
								<option value="">--Pays d'obtention--</option>
								<?php foreach($pays as $pay): ?>
									<option value="<?= $pay->id_pays ?>">
										<?= $pay->nom_pays ?>
									</option>
								<?php endforeach; ?>
							</select>
							<span  id="errorpays_obt" class="errors text-danger"></span>
						</div>
						<div class="form-row"> 
							<input type="text" name="centre_obtention" class="form-control" placeholder="Etablissement d'obtention*"> 
                        	<span  id="errorcentre_obtention" class="errors text-danger"></span>
						</div>
					</section> 
					<!-- /SECTION 3 -->

					<!-- SECTION 4 -->
					<h4></h4>
					<section>
						<div class="form-row">
							<select class="form-control" name="lieu_depot">
								<option class="option" value="">--Lieu dépôt de dossier--</option>
								<?php foreach($lieux_depot as $lieu_depot): ?>
									<option value="<?= $lieu_depot->id_lieu_depot ?>">
										<?= $lieu_depot->nom_lieu_depot ?>
									</option>
								<?php endforeach; ?>
							</select>
							<span  id="errorlieu_depot" class="errors text-danger"></span>
						</div>
						<div class="form-row">
							<label>Combien de fois avez vous présenté ce concours? </label>
							<select class="form-control" name="tentative">
								<option value="">--veuillez sélectionner--</option>
								<?php for($i = 0; $i < 11; $i++): ?>
									<option value="<?= $i ?>"><?= $i ?></option>
								<?php endfor; ?>
							</select>
							<span  id="errortentative" class="errors text-danger"></span>
						</div>
						<div class="form-row">
							<label>Mode d'admission: </label>
							<select class="form-control" name="admission" id="admission">
								<option value="">--veuillez sélectionner--</option>
								<option value="Etude de dossier">Etude de dossier</option>
							</select>
							<span  id="erroradmission" class="errors text-danger"></span>
						</div>

						<div class="form-row" id="lang_comp">
							
						</div>
						
					</section> 
					<!-- /SECTION 4 -->

					<!-- SECTION 5 : CURSUS SCOLAIRE -->

					<h4></h4>
					<section>
						<div class="row">
							<div class="col-sm-12">
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<td>Diplome</td>
												<td>Specialité</td>
												<td>Année</td>
												<td>Mention</td>
												<td>Etablissement</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th><input type="text" name="exm1" value="Baccalauréat ou GCE/AL" readonly></th>

												<td><input type="text" name="cls1" class="form-control"></td>
												<span  id="errorcls1" class="errors text-danger"></span>

												<td><input type="year" name="annee1" value=""></td>

												<td><input type="text" name="mention1" class="form-control"></td>
												<span  id="errormention1" class="errors text-danger"></span>
												
												
												<td><input type="text" name="ets1" class="form-control"></td>
												<span  id="errorets1" class="errors text-danger"></span>

											</tr>
											<tr>
												<th><input type="text" name="exm2" value="DUT/DEUG/BTS/HND" readonly></th>

												<td><input type="text" name="cls2" class="form-control"></td>
												<span  id="errorcls2" class="errors text-danger"></span>

												<td><input type="year" name="annee2" value=""></td>

												<td><input type="text" name="mention2" class="form-control"></td>
												<span  id="errormention2" class="errors text-danger"></span>
												
												
												<td><input type="text" name="ets2" class="form-control"></td>

												<span  id="errorets2" class="errors text-danger"></span>
											</tr>
											<tr>
												<th><input type="text" name="exm3" value="Autre Diplome Universitaire" readonly></th>

												<td><input type="text" name="cls3" class="form-control" value="//"></td>

												<td><input type="year" name="annee3" value=""></td>

												<td><input type="text" name="mention3" class="form-control"></td>
												
												
												<td><input type="text" name="ets3" class="form-control"></td>
											</tr>
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</section>
					<!-- /SECTION 5 -->

					<!-- SECTION 6 -->
					<h4></h4>
					<section>
						<div class="form-row">
							<select class="form-control" name="banque">
								<option value="">--Banque--</option>
								<?php foreach($banques as $banque): ?>
									<option value="<?= $banque->id_mode_paiement ?>">
										<?= $banque->nom_banque ?>
									</option>
								<?php endforeach; ?>
							</select>
							<span  id="errorbanque" class="errors text-danger"></span>
						</div>
						<div class="form-row">
							<input type="text" name="nom_agence" class="form-control" placeholder="Nom de l'agence">
						<span  id="errornom_agence" class="errors text-danger"></span>
						</div>
						<div class="form-row">
							<input type="text" name="num_bordereau" class="form-control" placeholder="Numéro de bordereau">
						<span  id="errornum_bordereau" class="errors text-danger"></span>
						</div>
						<div class="form-row">
							<input type="text" name="num_trans" class="form-control" placeholder="Numéro de la transaction">
						<span  id="errornum_trans" class="errors text-danger"></span>
						</div>
					</section>
					<!-- /SECTION 6 -->

					<!-- SECTION 7 -->
					<h4></h4>
					<section style="overflow-y: scroll; height: 350px;">
						
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
							<circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
							<polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
						</svg>
						<p class="success">Votre fiche est prête à être imprimer.<br><br>
							<button type="button" class="btn btn-info" id="btn-apercu"><i class="fa fa-eye"></i> Aperçu</button>
						</p>
						<div id="apercu">

						</div>
						
						
					</section>
					<!-- /SECTION 7 -->
				</form>
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>

<!-- /page container -->
