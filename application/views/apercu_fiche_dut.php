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


    </tr>
    <tr>
        <td><b>Nationalité: <h5><?= $nationalite ?> </h5></b> </td>
        <td><b>Région d'origine:<h5>  <?= $region_or ?></h5> </b> </td>

    </tr>
    <tr>
        <td><b>Sexe: <h5><?= $sexe ?></h5></b></td>
    </tr>
  
     <tr>
        <td><b>Téléphone: <h5> <?= $phone ?> </h5></b></td>
        <td><b>E-mail: <h5> <?= $email ?> </h5> </b></td>
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
        <td><b>Centre d'obtention: <h5><?= $centre_obtention ?></h5></b> </td>
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
        <td><b>Cycle: <h5><?= 'DUT' ?></h5> </b></td>
        <td><b>Mention choisie :<h5> <?= $mention ?> ( <?= $sigle_mention ?> ) </h5> </b> </td>
    </tr>
	<tr>
         <td><b>Mode d'Admission: <h5><?= $mode_admission ?></h5> </b> </td>
         <td><b>Langue de composition: <h5><?= $lang_comp ?></h5> </b> </td>
    </tr>
    </tbody>
</table>
<br>
<h3 >Cursus Académique</h3>
<hr>
<table class="borderedBlack" style="width: 300px">
    <thead>
    <tr>
        <th style="width: 12%">Année</th>
        <th style="width: 18%">Classe</th>
        <th style="width: 18%">Diplome</th>
        <th style="width: 50px">Etablissement</th>
        <th style="width: 18%">Note</th>
        <th style="width: 16%">Mention</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td<?= $annee1 ?>td>
        <td style="width: 50px"><?= $ets1 ?></td>
        <td><?= $cls1 ?></td>
        <td ><?= $exm1 ?></td>
        <td><?= $res1 ?></td>
        <td><?= $mention1 ?></td>



    </tr>
    <tr>
        <td<?= $annee2 ?>td>
        <td style="width: 50px"><?= $ets2 ?></td>
        <td><?= $cls2 ?></td>
        <td ><?= $exm2 ?></td>
        <td><?= $res2 ?></td>
        <td><?= $mention2 ?></td>



    </tr>
    <tr>
        <td<?= $annee3 ?>td>
        <td style="width: 50px"><?= $ets3 ?></td>
        <td><?= $cls3 ?></td>
        <td ><?= $exm3 ?></td>
        <td><?= $res3 ?></td>
        <td><?= $mention3 ?></td>



    </tr>
    <tr>
        <td<?= $annee4 ?>td>
        <td style="width: 50px"><?= $ets4 ?></td>
        <td><?= $cls4 ?></td>
        <td ><?= $exm4 ?></td>
        <td><?= $res4 ?></td>
        <td><?= $mention4 ?></td>



    </tr>
    <tr>
        <td<?= $annee5 ?>td>
        <td style="width: 50px"><?= $ets5 ?></td>
        <td><?= $cls5 ?></td>
        <td ><?= $exm5 ?></td>
        <td><?= $res5 ?></td>
        <td><?= $mention5 ?></td>
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
        <td><b>Centre d'examen: <h5><?= $centre_exam ?></h5></b> </td>
    </tr>
    <tr>
        <td colspan="2"><b> Tentative au Concours:  <h5> <?= $tentative ?> </h5></b></td>
    </tr>
    </tbody>
</table>
</div>
