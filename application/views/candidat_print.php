<style>
	@page { margin-bottom: 0 !important }
    table {
        width: 100%;
        font-size: 14px;
        font-family: helvetica;
        border-collapse: collapse;
    }
    
    tr {
        margin-top: 8px;
    }

    
    table.bordered td {
        border: 1px solid white;
        padding: 1mm 1mm;
    }

    
    td.bBlack {
        border: 1px solid black;
        padding: 2mm 3mm;
    }

    td{
        padding-left: 3mm;
    }
    
    table.borderedBlack td {
        border: 1px solid black;
    }
	
	#main td, #curriculum td{
		font-size: 13px;
	}
</style>

<table style="margin-top: -40px">
	<tr>
		<td class='text-center' style="width:15%; padding: 0px">
			<img src="<?php echo FCPATH . 'assets/images/logo_ens.png' ?>" alt="Logo" width="80"/>
		</td>
		<td class='text-center'>
			<h5 style="color : black ; text-align:center; font-size: 15px">
				FICHE DE CANDIDATURE AU CONCOURS D’ENTREE
				A L’ENS DE BERTOUA – CYCLE I
				<br/>
				<em>CANDIDATE’S FORM FOR THE ENTRANCE EXAMINATION
					INTO HTTC BERTOUA - FIRST CYCLE</em>
			</h5>
			</td> 
		<td class='text-center bBlack' style="width:20%; padding: .5px">
			<p style="text-align: center; font-size: 10px">Timbre fiscal de 1000 FCFA <br>
				<em>(Fiscal stamp)</em></p>
		</td>
	</tr>
</table>
<p style=" font-size: 13px"><b>Année académique : 2019/2020</b> <br>
    <em>Academic year</em></p>
<p style=" font-size: 12px"><b>N° <?= castNumberId($infocandidat['numero_dossier'], 5) ?></b></p>

<h3 style="text-align: center" >ETAT CIVIL <br><em>PERSONAL DATA</em></h3>
<hr>
<table class="bordered" style="margin-bottom: -10px">
    <tbody id="main">
    <tr>
        <td colspan="2"><b>Nom: </b> <?php echo mb_strtoupper($individu['nom']) ?><br><em>Name</em> </td>
    </tr>
    <tr>
        <td colspan="2"><b>Prénom:</b> <?php echo mb_strtoupper($individu['prenom']) ?><br><em>First Name</em> </td>
    </tr>
    <tr>
        <td><b>Né(e) le:</b> <?php echo $individu['date_naiss']  ?><br><em>Date of birth </em> </td>
        <td><b>À:</b> <?php echo $individu['lieu_naiss'] ?><br><em>At</em></td>
    </tr>
    <tr>
        <td><b>Genre:</b> <?php echo (intval($individu['sexe']) ==1)? "Masculin" : "F&eacute;minin" ?><br><em>Gender</em> </td>
        <td><b>Pays d'origine:</b> <?php echo $individu['nationalite'] ?><br><em>Native country</em></td>
    </tr>
    <tr>
        <td><b>Région d'origine:</b> <?php echo $individu['region_origFR']?><br><em>Region of origin</em></td>
        <td><b>Email:</b>  <?php echo $individu['email'] ?><br><em>email</em></td>
    </tr>
    <tr>
        <td><b>Téléphone:</b> <?php echo $individu['tel'] ?><br><em>Phone</em></td>
    </tr>
    <tr>
        <td><b>Nom et prénoms du père:</b> <?php echo mb_strtoupper($individu['nom_pere']) ?><br><em>Name and surname of father</em></td>
    </tr>
    <tr>
        <td><b>Région d’origine du père:</b> <?php echo $individu['reg_pere']  ?><br><em>Region of origin of father</em></td>
        <td><b>Adresse:</b> <?php echo $individu['ville_parent'] ?> <br><em>Address of father</em></td>
    </tr>
	<tr>
        <td><b>Nom et prénoms de la mère:</b> <?php echo mb_strtoupper($individu['nom_mere']) ?><br><em>Name and surname of mother</em></td>
    </tr>
    <tr>
        <td><b>Région d’origine de la mère:</b> <?php echo $individu['reg_mere'] ?><br><em>Region of origin of mother</em></td>
        <td><b>Adresse:</b> <?php echo $individu['ville_parent'] ?> <br><em>Address of mother</em></td>
    </tr>
    <tr>
        <td><b>Centre d’examen choisi :</b> <?php echo $centrexam; ?><br><em>Examination centre</em></td>
    </tr>
    <tr>
        <td><b>Année d’obtention du BAC :</b> <?php echo $infodiplome['annee'] ?><br><em>Year of obtaining the GCE/AL</em></td>
        <td><b>Série :</b> <?php  echo isset($diplome) ?  $diplome : ''; ?><br><em>Specialization</em></td>
    </tr>
    <tr>
        <td><b>Pays :</b> <?php echo $infodiplome['pays'] ?><br><em>Country</em></td>
        <td><b>Centre :</b> <?php echo $infodiplome['ville'] ?><br><em>Centre</em></td>
    </tr>
    <tr>
        <td><b>Langue de composition :</b>  <?php echo $infocandidat['langue_compo'] ?><br><em>Examination langage</em></td>
    </tr>
    </tbody>
</table>
<h5>Cursus des cinq (5) dernières années précédant le concours. <br><em>Fill the last five (5) years preceding this entrance examination.</em></h5>
<table class="borderedBlack" style="text-align: center">
    <thead>
    <tr>
        <td style="width: 80px; font-size: 12px">Année académique<br><em>Academic year</em></td>
        <td style="width: 150px; font-size: 12px">Etablissement fréquenté<br><em>School in which you studied</em></td>
        <td style="width: 100px; font-size: 12px">Classe suivie <br> <em>Class attended</em></td>
        <td style="width: 130px; font-size: 12px">Examen préparé <br><em>Examination prepared</em></td>
        <td style="width: 80px; font-size: 12px">Résultat <br><em>Results</em></td>
        <td style="width: 80px; font-size: 12px">Mention <br><em>Rank</em></td>
    </tr>
    </thead>
    <tbody id="curriculum">
	    <?php  foreach($cursus as $cs){  $cs1=(array)$cs; ?>
        <tr>
            <td><?php echo ($cs1['annee']-1).'/'.$cs1['annee'] ?></td>
            <td><?php echo $cs1['etablissement'] ?></td>
            <td><?php echo $cs1['classe'] ?></td>
            <td><?php echo $cs1['diplome'] ?></td>
            <td><?php echo $cs1['note'] ?></td>
            <td><?php echo $cs1['mention'] ?></td>
        </tr>
		<?php
    	} ?>
    </tbody>
</table>
<h3 style="text-align: center" >CHOIX DE LA FILIERE <br><em>SPECIALITY CHOICE</em></h3>
<hr>
<table>
    <tr><td><b>Filière choisie: </b>  <?php echo $mention ?><br><em>Chosen speciality</em></td></tr>
</table>
<table style="width: 700px;">
    <tr>
        <td class='text-center' style="width:60%">
            <h6 style="color : black ; ">Fait a : <br><em>Done at</em> </h6>
            <h6 style="color : black ; ">le : <?php echo moment()->format('d F Y') ?><br><em>the</em> </h6>
            <h6 style="color : black ; ">Nom et signature du candidat
                <br><em>Name and Signature</em> </h6>
        </td>
		<td class='text-center' style="width:20%"></td>
        <td class='text-center bBlack' style="width:20%">
            <h5 style="color : black ; text-align:center;">Coller Votre photo<br>(<em>Photograph</em>) </h5>
        </td>
    </tr>
</table>
<h4 style="text-align: center">COMPOSITION DU DOSSIER DE CANDIDATURE <br><em>COMPOSITION OF THE FILE</em></h4>
<p>Le dossier de candidature comprend les pièces suivantes :</p>
<ol style="text-align: justify; font-size: 14px">
    <li>Une fiche de candidature (présent model) dument remplie et timbrée à 1000 FCFA ;</li>
    <li>Une demande d’inscription au concours disponible à l’E.N.S., dans les centres d’examen, sur le site Internet de l’ENS de Bertoua http://www.unregistration.univ-ndere.cm  ou www.ensbertoua.uninet.cm;</li>
    <li>Une photocopie certifiée conforme de l’acte de naissance datant de moins de trois (03) mois ;</li>
    <li>Les photocopies certifiées des relevés de notes du probatoire ou du GCE/OL (results slip), du Baccalauréat ou du GCE/AL (results slip) ;</li>
    <li>Une copie certifiée conforme du Baccalauréat ou du GCE/AL, ou du diplôme reconnu équivalent par le Ministre de l‘Enseignement Supérieur, datant de moins de trois (03) mois, ou une photocopie certifiée conforme de l’Attestation de réussite du Baccalauréat ou du GCE/AL.</li>
    <li>Un extrait de casier judiciaire (bulletin n°3) datant de moins de trois (03) mois;</li>
    <li>Un certificat médical délivré par un médecin de l’Administration, attestant que le candidat est physiquement et médicalement apte à l’exercice de la fonction d’enseignant. Notamment qu’il est indemne de carences physiologiques notoires au niveau de l’élocution, de l’audition, de la vue ou de la motricité conformément à la réglementation en vigueur ;</li>
    <li>Un reçu de paiement de vingt mille francs (20 000) FCFA de frais de concours, délivré par la <b>SOCIETE GENERALE CAMEROUN compte  N° CM21 10003 00900 22090784104 86. </b> <u>Aucun autre mode de paiement ne sera accepté</u> ;</li>
    <li>Une enveloppe de format A4 timbrée (<b>timbre composté</b>) au tarif en vigueur, et portant l’adresse du candidat ;</li>
    <li>Deux photos (4x4) d’identité ;</li>
    <li>Une autorisation du Ministre de l‘Éducation de base, du Ministre des Enseignements secondaires ou du Ministre de l’Enseignement Supérieur, selon le cas, pour les candidats fonctionnaires en poste dans ces départements ministériels.</li>
</ol>
<p>Les dossiers complets seront déposés au plus tard le <b style="color: red">18 octobre 2019</b>, <b> délai de rigueur</b>, aux lieux ci-après :</p>
<ul>
    <li>la Direction de l’École Normale Supérieure (ENS) de Bertoua</li>
    <li>les Délégation Régionales du Ministère des Enseignements Secondaires </li>
</ul>
<p>Les épreuves écrites du concours se dérouleront le <b style="color: red">19 octobre 2019</b></p>
