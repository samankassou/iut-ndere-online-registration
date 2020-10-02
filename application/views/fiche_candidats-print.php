<!DOCTYPE html>
<html>
<head>
  <style>
    @page{
        margin-top: 5mm;
        margin-right: 6.2mm;
        margin-left: 6.5mm;
        padding: 0;
    }
    body{
        width: 100%;
        margin: 0;
        padding: 0;
        font-size: 10pt;
        line-height: 3.5mm;
    }

    .table th,
    .table td {
        border: 1px solid #000;
        padding: 1mm;
    }
    .thead{
        background-color: #D2D2D2;
    }
    td.thead{
        font-size: 10pt;
    }
    .bordered{
        border: 1px solid #000;
    }
    .col-pk-1{
        width: 10%;
    }
    .col-pk-2{
        width: 20%;
    }
    .col-pk-3{
        width: 30%;
    }
    .col-pk-4{
        width: 40%;
    }
    .col-pk-5{
        width: 50%;
    }
    .col-pk-6{
        width: 60%;
    }
    .col-pk-7{
        width: 70%;
    }
    .col-pk-8{
        width: 80%;
    }
    .col-pk-9 {
        width: 90%;
    }
    .col-pk-10{
        width: 100%;
    }
    .col-pk-11{
        width: 150%;
    }
    .text-bold{
        font-weight: bold;
    }
    .text-letf{
        text-align: left;
    }
    .text-center{
        text-align: center;
    }
    .text-right{
        text-align: right;
    }
    .text-info {
        color: #31708f;
    }
    .text-warning {
        color: #8a6d3b;
    }
    .text-danger {
        color: #a94442;
    }
    .bg-primary {
        color: #fff;
        background-color: #337ab7;
    }
    .bg-success {
        background-color: #dff0d8;
    }
    .bg-info {
        background-color: #d9edf7;
    }
    .bg-warning {
        background-color: #fcf8e3;
    }
    .bg-danger {
        background-color: #f2dede;
    }
    .border-black{
        border: 1px solid #000000;
    }
    .border-warning{
        border: 1px solid #fcf8e3;
    }
    .padding-bottom{
        padding-bottom: 2mm;
    }
    .img{
        height: 5mm;
    }
    .img-circle{
        border-radius: 50%;
    }
    .pull-left {
        float: left;
    }
    .pull-right {
        float: right;.
    }
    .img-pdf{
        height: 80px;
    }

    table {
        width: 100%;
        font-size: 9pt;
        font-family: helvetica;
        line-height: 6mm;
        /*letter-spacing: 0.5mm;*/
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

    .no-border td,
    .no-border th,
    .no-border tfoot{
        border: none;
    }

    hr{
        color: #000;
    }
</style>
<page orientation="P">
 <!-- <title></title><link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">-->


</head>
<body>
 <div>
   <table style='vertical-align: top; margin-left: 4mm;' class="col-pk-10">
        <tr class="col-pk-10">
            <td class='text-center col-pk-4'>
                REPUBLIQUE DU CAMEROUN <br>
                **********<br>
                Paix - Travail - Patrie<br>
                **********<br>
               UNIVERSITE DE NGAOUNDERE<br>
                **********<br>
                B.P: 454
            </td>

            
            <td class="text-center col-pk-2">
                
            </td>  
           
            <td class='text-center col-pk-4'>
                <div>REPUBLIC OF CAMEROON</div>
                <div>**********</div>
                <div>Peace - Word - Fatherland</div>
                <div>**********</div>
                <div>THE UNIVERSITY OF NGAOUNDERE</div>
                <div>**********</div>
                <div>P.0.Box 454</div>
            </td>
        </tr>
    </table>
    <br><br>
    
    <table>
    <tr class="col-pk-11">
      <td class=''>
                <img src="<?php echo base_url("assets/img/logos/aa.png")?>" style="width: 130px; height: 120px;">
            </td>
            <td class='text-center col-pk-10 '>
                <hr>
                INSTITUT UNIVERSITAIRE DE TECHNOLOGIE   <br>
                THE UNIVERSITY INSTITUTE  OF TECHNOLOGY<br>
                PB.P 455 NGAOUNDERE-CAMEROON  Tel.00(237)22 25 40 23  <br>
                 Fax:00(237)22 25 40 23 <br>
                Web site:www.iut-un.net<br>
                Email:iutngaoundere@yahoo.fr <br>
                <!--UNIVERSITE DE NGAOUNDERE <br>-->
                <hr>
            </td>
    </tr>        

</table>
            
    
    <table class="col-pk-4" style="vertical-align: top; width: 100%;" cellpadding="10">
       
               <!--<?php if(isset($ecoles)){
                    foreach ($ecoles as $ecole) {
                        $sigle = $ecole->{'nom' . strtoupper(session_data('lang'))};
                        echo 'DE ' . (is_vowels($sigle) ? "L'" : '') . '<b>' . $sigle . '</b>';
                    }
                } ?>-->
            <!--</td>-->
        <tr>
          <td class="col-pk-11" style="font-size: 14px; text-align: center;" colspan="3"><b><u>LISTE DES CANDIDATS DE L'IUT DE NGAOUNDERE</u></b></td>
        </tr>

          <tr>
            <td style="font-size: 18px; width: 40%">Centre d'examen: <b><?php
                 if (isset($centre_examen)) {
                    $resu=$this->Admin->get_centre($this->input->post('centre_examen'));
                   foreach ($resu as  $value) { echo $value->nom_centre_examen;}
                }
                else{
                    echo "Tous";
                }?></b>
               
            </td>
        
            <td style="font-size: 18px; width: 30%">Cycle: <b>
                <?php  
                if (isset($cyc)) {
                    $resu=$this->Admin->get_cycle($this->input->post('cycle'));
                   foreach ($resu as  $value) { echo $value->abreviation_cycle;}
                }
                else{
                    echo "Tous";
                }?></b>
            </td>
        
            <td style="font-size: 18px; width: 30%">Mention:<b> <?php  
                if (isset($mention)) {
                    $resu=$this->Admin->get_mention($this->input->post('mention'));
                   foreach ($resu as  $value) { echo $value->sigle_mention;}
                }
                else{
                    echo "Tous";
                }?></b>
                
            </td>
        </tr>
    </table>
    <br>
   <table class="table col-pk-10" style="vertical-align: middle; width: 100%; margin: auto">

     <thead>
       <tr class="thead col-pk-10">
        <th class="text-center">N°</th>
       <th>Nom(s) et Prenom(s)</th>
       <th>Sexe</th>
       <th>Date Naissance</th>
       <th>Lieu Naissance</th>
       <th>Pays</th>
       <th>Region</th>
       </tr>
     </thead>
     <tbody>
      <?php $i=1;foreach ($listes as $value) : ?>
       <tr class="col-pk-10">
           <th class="text-center"><?= $i; ?></th>
           <td class="text-bold"><?= mb_strtoupper(trim($value->nom_candidat)).' '. mb_strtoupper(trim($value->prenom_candidat)) ?></td>
           
           <td><?= $value->sexe ;?></td>
           <td><?= $value->date_naiss; ?></td>
           <td><?= $value->lieu_naiss; ?></td>
           <td><?= $value->nom_pays; ?></td>
           <td><?= $value->nom_reg_or ;?></td>
       </tr>
     <?php $i+=1; endforeach; ?>
     </tbody>
   </table>
 </div>
</page>

</body>
</html>