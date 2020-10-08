<style>
  @page{
    margin-top: 5mm;
    margin-right: 6.2mm;
    margin-left: 6.5mm;
    margin-bottom: 10mm;
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
    float: right;
  }
  .img-pdf{
    height: 80px;
  }

  table {
    width: 100%;
    font-size: 9pt;
    line-height: 6mm;
    letter-spacing: 5mm;
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

<page orientation="P">
  <table style='vertical-align: top; line-height: 4mm;' class="col-pk-10">
    <tr class="col-pk-10">
      <td class='text-center col-pk-5'>
        REPUBLIQUE DU CAMEROUN <br>
        ********** <br>
        Paix - Travail - Patrie <br>
        ********** <br>
        MINISTERE DE L'ENSEIGNEMENT SUPERIEUR <br>
        ********** <br>
        UNIVERSITE DE NGAOUNDERE <br>
        ********** 
      </td>
      
      <td class='text-center col-pk-5'>
        REPUBLIC OF CAMEROON <br>
        ********** <br>
        Peace - Word - Fatherland <br>
        ********** <br>
        MINISTRY OF HIGHER EDUCATION <br>
        ********** <br>
        THE UNIVERSITY OF NGAOUNDERE <br>
        ********** 
      </td>
    </tr>
  </table>
  <br><br>
  <table class="col-pk-10" style="vertical-align: top;">
    <tr>

      <td class='text-center col-pk-2' style="border-bottom: 1px solid black;">
        <img src="<?php echo img_url("logos/logo_iut.png")?>" style="width: 90px;">
      </td>
      
      <td align="center" class='text-center col-pk-8' style="border-top: 1px solid black;border-bottom: 1px solid black; margin-bottom: 0; padding-bottom: 0;">
        <br>
        
        <h3 style="margin-top: 0; padding-top: 0;">INSTITUT UNIVERSITAIRE DE TECHNOLOGIE DE<br>
          <em>THE UNIVERSITY INSTITUTE OF TECHNOLOGY</em><br>
        NGAOUNDERE</h3>
        
      </td>
    </tr>
    <tr>

      <td colspan="2" align="center" class='text-center col-pk-8' style="border-top: 1px solid black;border-bottom: 1px solid black; margin-bottom: 0; padding-bottom: 0;">
        <br>
        
        <h3 style="margin-top: 0; padding-top: 0;">STATISTIQUES DES INSCRIPTIONS AUX CONCOURS DE L'IUT DE NGAOUNDERE</h3>
        <?php if (!empty($filtre)) {  ?>
          <h4>Statistiques par: <?= $filtre ?></h4>
       <?php } ?>
        <?php if (!empty($cycle)) {  ?>
          <h4>Cycle: <?= $cycle ?></h4>
       <?php } ?>
        <h4>Effectif total: <?= $total_candidats ?></h4>

      </td>
    </tr>
  </table>
  <br>
  <table  class="col-pk-10 borderedBlack" style="vertical-align: top; margin: auto; width: 100%">
    <tr style=" background-color: #ccc">
      <td colspan="7" style="text-align: center;">
        <b>INSCRITS</b>
      </td>
    </tr>
    <tr style=" background-color: #ccc">
      <td><b><?php if(!empty($filtre) && ($filtre == 'Centre d\'examen')): echo 'CENTRE';
      elseif(!empty($filtre) && ($filtre == 'Lieux de depot')): echo 'LIEUX DEPOT';
      else: echo "REGIONS"; endif; ?></b></td>
      <td><b>TOTAL</b></td>
      <td><b>%</b></td>
      <td><b><?= (!empty($filtre) && ($filtre == 'Langue de composition'))?'Anglais':'FILLES' ?></b></td>
      <td><b>%</b></td>
      <td><b><?= (!empty($filtre) && ($filtre == 'Langue de composition'))?'Français':'GARCONS' ?></b></td>
      <td><b>%</b></td>
    </tr>
    <?php foreach($cdts as $key => $value): ?>
      <tr>
        <td><b><?= $key ?></b></td>
        <td><?= $value['total'] ?></td>
        <td><b><?= ($value['total'] == 0)?0:castNumberId($value['total']/$total_candidats*100, 2, 2) ?></b></td>
        <td><?= $value['total_f'] ?></td>
        <td><b><?= ($value['total_f'] == 0)?0:castNumberId($value['total_f']/$total_feminin*100, 2, 2) ?></b></td>
        <td><?= $value['total_m'] ?></td>
        <td><b><?= ($value['total_m'] == 0)?0:castNumberId($value['total_m']/$total_masculin*100, 2, 2) ?></b></td>
      </tr>
    <?php endforeach; ?>
    <tr>
      <td><b>TOTAL</b></td>
      <td><?= $total_candidats ?></td>
      <td><b>100</b></td>
      <td><?= $total_feminin ?></td>
      <td><b>100</b></td>
      <td><?= $total_masculin ?></td>
      <td><b>100</b></td>
    </tr>
  </table>
</page>