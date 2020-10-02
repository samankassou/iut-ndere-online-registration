<?php
ob_start();
?>
<style>

    table {

        width: 100%;
        font-size: 9pt;
        font-family: helvetica;
        line-height: 6mm;

        border-collapse: collapse;

    }
    table.bordered th{
        border: 1px solid white;
        padding: 1mm 1mm;
        background-color: white;
        color: white;
    }

    table.bordered td {
        border: 1px solid white;
        padding: 2mm 3mm;
    }
    table.borderedBlack th{
        border: 1px solid black;
        padding: 1mm 1mm;
        background-color: white;
        color: black;
    }

    table.borderedBlack td {
        border: 1px solid black;
        padding: 2mm 3mm;
    }



</style>
<div class="container-fluid">
<br><br><br>
    <table>
        <tr>
            <td class='text-center' style='width: 100%;'>
                <h3 style="color : mediumslateblue ; font-family: Helvetica; text-align:center; margin-top: -60px">RECAPITULATIF DE VOTRE CANDIDATURE<br> AU CONCOURS D'ENTREE A L'<b>IUT</b><br>  </h3>
            </td>
        </tr>

    </table>



<br>
<h3 >Infomations Personnelles</h3>
<hr>
<table class="bordered">

    <tbody>
    <tr>
        <td><b>Nom: <h5><?= $nom_candidat ?></h5></b></td>
        <td><b>Prénom: <h5><?= $prenom_candidat ?></h5></b> </td>
    </tr>
    <tr>
        <td><b>Date de naissance: <h5><?= $date_naiss ?></h5></b> </td>
        <td><b>Lieu de naissance:<h5> <?= $lieu_naiss ?></h5></b> </td>
        <td><b>Sexe: <h5><?= $sexe ?></h5></b></td>

    </tr>
    <tr>
        <td><b>Nationalité: <h5><?= $nationalite ?> </h5></b> </td>
        <td><b>Région d'origine:<h5>  <?= $region_or ?></h5> </b> </td>
    </tr>
     <tr>
        <td><b>Nom de la Mère: <h5><?= $nom_mere ?></h5></b></td>
        <td><b>Nom du Père: <h5><?= $nom_pere ?></h5></b> </td>
    </tr>
     <tr>
        <td><b>Téléphone: <h5> <?= $phone ?> </h5></b></td>
        <td><b>E-mail: <h5> <?= $email ?> </h5> </b></td>
    </tr>

     <tr>
        <td><b> Emploi Permanent: <h5> <?= $emploi ?> </h5></b></td>
        <td><b> Nom de l’Employeur: <h5> <?= $employeur ?> </h5> </b></td>
        <td><b> Responsabilité/Fonction occupée : <h5> <?= $fonction ?> </h5> </b></td>

    </tr>
    </tbody>
</table>

<h3>Informations sur le diplome d'entrée</h3>
<hr>
<table class="bordered">

    <tbody>
    <tr>
        <td><b>Diplome d'admission: <h5><?= $diplome ?></h5></b> </td>
        <td><b>Année d'obtention: <h5><?= $annee_obt ?></h5></b> </td>
    <tr>
        <td><b> Etablissement: <h5><?= $centre_obtention ?></h5></b> </td>
        <td><b>Pays d'obtention: <h5><?= $pays_obt ?></h5></b></td>
    </tr>
    </tbody>
</table>
<br>
<h3 >Formation choisie</h3>
<hr>
<table class="bordered">

    <tbody>
    <tr>
        <td><b>Cycle: <h5><?= $cycle ?></h5> </b></td>
        <td><b>Mention choisie :<h5> <?= $mention ?> ( <?= $sigle_mention ?> ) </h5> </b> </td>
    </tr>
      <tr>
        <td><b> Parcours choisis </b></td>
    </tr>
     <tr>
        <td><b> 1er choix: <h5><?= $parcours1 ?></h5> </b></td>
        <td><b> 2e choix :<h5><?= $parcours2 ?></h5> </b> </td>
    </tr>
    </tbody>
</table>
<br>
<h3 >Cursus Académique</h3>
<hr>
<table class="borderedBlack" style="width: 300px">
    <thead>
    <tr>
        <th style="width: 12%">Diplome</th>
        <th style="width: 18%">Specialité</th>
        <th style="width: 18%">Année</th>
        <th style="width: 50px">Mention</th>
        <th style="width: 18%">Etablissement</th>
        
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Baccalauréat ou GCE/AL</td>
        <td style="width: 50px"><?= $cls1 ?></td>
        <td><?= $annee1 ?></td>
        <td ><?= $mention1 ?></td>
        <td><?= $ets1 ?></td>

    </tr>
    <tr>
        <td>DUT/DEUG/BTS/HND</td>
        <td style="width: 50px"><?= $cls2 ?></td>
        <td><?= $annee2 ?></td>
        <td ><?= $mention2 ?></td>
        <td><?= $ets2 ?></td>
    </tr>
    <tr>
        <td>Autre Diplôme Universitaire</td>
        <td style="width: 50px"><?= $cls3 ?></td>
        <td><?= $annee3 ?></td>
        <td ><?= $mention3 ?></td>
        <td><?= $ets3 ?></td>
    </tr>
    
    </tbody>
</table>

<h3 >Informations sur le paiement</h3>
<hr>
<table class="bordered">

    <tbody>
    <tr>
        <td colspan="2"><b>Banque:  <h5> <?= $banque ?> </h5></b> </td>
    </tr>
	<tr>
        <td colspan="2"><b>Agence:  <h5> <?= $agence ?> </h5></b></td>
    </tr>
    <tr>
	    <td><b>Numero de bordereau:  <h5> <?= $num_bordereau ?> </h5></b></td>
        <td><b>Numero de transaction: <h5> <?= $num_trans ?> </h5></b></td>
    </tr>
    </tbody>
</table>



<h3 >Informations sur le  Dossier </h3>
<hr>
<table class="bordered">

    <tbody>
        <tr>
        <td><b>Lieu de dépôt:<h5><?= $lieu_depot ?></h5> </b></td>
    </tr>
    </tbody>
</table>
</div>
