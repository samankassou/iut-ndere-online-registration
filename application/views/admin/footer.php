 </div>
 <footer class="main-footer text-sm">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 1.0
  </div>
  <strong>Copyright &copy; <?= (date('Y')=='2020')?date('Y'):'2020-'.date('Y') ?> <a href="http://iut.univ-ndere.cm">IUT de Ngaoundéré</a>.</strong> Touts droits réservés.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- Canvas -->
<script src="<?= base_url('assets/js/variables.js') ?>"></script>
<script src="<?= base_url() ?>assets/vendor/canvasjs-2.3.2/Charts/canvasjs.min.js"></script>
<!-- jQuery -->
<script src="<?= base_url() ?>assets/template/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url() ?>assets/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Sweet-alert -->
<script src="<?= base_url() ?>assets/vendor/sweetalert/dist/sweetalert2.all.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>assets/template/dist/js/demo.js"></script>
<script src="<?= empty($js)?'':$js ?>"></script>
<script>

 $(function(){
  $('.global-pie').click(function(){
    var chartGlobal = new CanvasJS.Chart("chartGlobal", {
      zoomEnabled: true,
      theme: 'light2',
      animationEnabled: true,
      title: {
        text: "Statistiques en % globales des candidats sur un effectif de " + <?= $total_candidats ?> + " candidats"
      },

      data: [{
        type: "pie",
        name: "Garçons",
        dataPoints: 
        <?= json_encode($candidats_par_region, JSON_NUMERIC_CHECK) ?>

      }]
    });
    chartGlobal.render();
  });
  $('.global-bar').click(function(){

    var chartGlobal = new CanvasJS.Chart("chartGlobal", {
      zoomEnabled: true,
      theme: 'light2',
      animationEnabled: true,
      title: {
        text: "Statistiques globales des candidats sur un effectif de " + <?= $total_candidats ?> + " candidats"
      },

      data: [{
        type: "column",
        name: "Garçons",
        showInLegend: true,
        dataPoints: 
        <?= json_encode($candidats_masculin, JSON_NUMERIC_CHECK) ?>

      },
      {
        type: "column",
        name: "Filles",
        showInLegend: true,
        dataPoints: 
        <?= json_encode($candidats_feminin, JSON_NUMERIC_CHECK) ?>
      }
      ]
    });
    chartGlobal.render();

  });
//Pour le bouton qui permet de changer de diagramme(dut)
$('.cycle_dut-pie').click(function(){
  var chartCycleDut = new CanvasJS.Chart("chart_cycle_dut", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Statistiques en % des candidats DUT par region d'origine sur un effectif de " + <?= $total_candidats_dut ?> + " candidats"
    },

    data: [{
      type: "pie",
      name: "Garçons",
      dataPoints: 
      <?= json_encode($candidats_dut_par_region, JSON_NUMERIC_CHECK) ?>

    }]
  });
  chartCycleDut.render();
});

$('.cycle_dut-bar').click(function(){
  var chartCycleDut = new CanvasJS.Chart("chart_cycle_dut", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats DUT par region d'origine sur un effectif de " + <?= $total_candidats_dut ?> + " candidats"
    },

    data: [{
      type: "column",
      name: "Garçons",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_masculin_dut, JSON_NUMERIC_CHECK) ?>

    },
    {
      type: "column",
      name: "Filles",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_feminin_dut, JSON_NUMERIC_CHECK) ?>
    }
    ]
  });
  chartCycleDut.render();
});
//Pour le bouton qui permet de changer de diagramme(bts)
$('.cycle_bts-pie').click(function(){
  var chartCycleBts = new CanvasJS.Chart("chart_cycle_bts", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Statistiques en % des candidats BTS par region d'origine sur un effectif de " + <?= $total_candidats_bts ?> + " candidats"
    },

    data: [{
      type: "pie",
      name: "Garçons",
      dataPoints: 
      <?= json_encode($candidats_bts_par_region, JSON_NUMERIC_CHECK) ?>

    }]
  });
  chartCycleBts.render();
});

$('.cycle_bts-bar').click(function(){
  var chartCycleBts = new CanvasJS.Chart("chart_cycle_bts", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats BTS par region d'origine sur un effectif de " + <?= $total_candidats_bts ?> + " candidats"
    },

    data: [{
      type: "column",
      name: "Garçons",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_masculin_bts, JSON_NUMERIC_CHECK) ?>

    },
    {
      type: "column",
      name: "Filles",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_feminin_bts, JSON_NUMERIC_CHECK) ?>
    }
    ]
  });
  chartCycleBts.render();
});

  //Pour le bouton qui permet de changer de diagramme(litech)
  $('.cycle_litech-pie').click(function(){
    var chartCycleLitech = new CanvasJS.Chart("chart_cycle_litech", {
      zoomEnabled: true,
      theme: 'light2',
      animationEnabled: true,
      title: {
        text: "Statistiques en % des candidats LITECH par region d'origine sur un effectif de " + <?= $total_candidats_litech ?> + " candidats"
      },

      data: [{
        type: "pie",
        name: "Garçons",
        dataPoints: 
        <?= json_encode($candidats_litech_par_region, JSON_NUMERIC_CHECK) ?>

      }]
    });
    chartCycleLitech.render();
  });

  $('.cycle_litech-bar').click(function(){
    var chartCycleLitech = new CanvasJS.Chart("chart_cycle_litech", {
      zoomEnabled: true,
      theme: 'light2',
      animationEnabled: true,
      title: {
        text: "Candidats LITECH par region d'origine sur un effectif de " + <?= $total_candidats_litech ?> + " candidats"
      },

      data: [{
        type: "column",
        name: "Garçons",
        showInLegend: true,
        dataPoints: 
        <?= json_encode($candidats_masculin_litech, JSON_NUMERIC_CHECK) ?>

      },
      {
        type: "column",
        name: "Filles",
        showInLegend: true,
        dataPoints: 
        <?= json_encode($candidats_feminin_litech, JSON_NUMERIC_CHECK) ?>
      }
      ]
    });
    chartCycleLitech.render();
  });




  var chartGlobal = new CanvasJS.Chart("chartGlobal", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Statistiques globales des candidats par region d'origine sur un effectif de " + <?= $total_candidats ?> + " candidats"
    },

    data: [{
      type: "column",
      name: "Garçons",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_masculin, JSON_NUMERIC_CHECK) ?>

    },
    {
      type: "column",
      name: "Filles",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_feminin, JSON_NUMERIC_CHECK) ?>
    }
    ]
  });
  chartGlobal.render();

  var chartCentreExamDut = new CanvasJS.Chart("chart_centre_exam_dut", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats DUT par centre d'examen sur un effectif de " + <?= $total_candidats_dut ?> + " candidats"
    },

    data: [{
      type: "column",
      name: "Garçons",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_masculin_dut_centre_exam, JSON_NUMERIC_CHECK) ?>

    },
    {
      type: "column",
      name: "Filles",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_feminin_dut_centre_exam, JSON_NUMERIC_CHECK) ?>
    }
    ]
  });
  chartCentreExamDut.render();

  var chartCentreExamBts = new CanvasJS.Chart("chart_centre_exam_bts", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats BTS par centre d'examen sur un effectif de " + <?= $total_candidats_bts ?> + " candidats"
    },

    data: [{
      type: "column",
      name: "Garçons",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_masculin_bts_centre_exam, JSON_NUMERIC_CHECK) ?>

    },
    {
      type: "column",
      name: "Filles",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_feminin_bts_centre_exam, JSON_NUMERIC_CHECK) ?>
    }
    ]
  });
  chartCentreExamBts.render();

  var chartLangDut = new CanvasJS.Chart("chart_lang_dut", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats DUT par langue de composition sur un effectif de " + <?= $total_candidats_dut ?> + " candidats"
    },

    data: [{
      type: "column",
      name: "Français",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_fr_dut, JSON_NUMERIC_CHECK) ?>

    },
    {
      type: "column",
      name: "Anglais",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_en_dut, JSON_NUMERIC_CHECK) ?>
    }
    ]
  });
  chartLangDut.render();

  var chartLangBts = new CanvasJS.Chart("chart_lang_bts", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats BTS par langue de composition sur un effectif de " + <?= $total_candidats_bts ?> + " candidats"
    },

    data: [{
      type: "column",
      name: "Français",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_fr_bts, JSON_NUMERIC_CHECK) ?>

    },
    {
      type: "column",
      name: "Anglais",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_en_bts, JSON_NUMERIC_CHECK) ?>
    }
    ]
  });
  chartLangBts.render();

  var chartCycleDut = new CanvasJS.Chart("chart_cycle_dut", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats DUT par region d'origine sur un effectif de " + <?= $total_candidats_dut ?> + " candidats"
    },

    data: [{
      type: "column",
      name: "Garçons",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_masculin_dut, JSON_NUMERIC_CHECK) ?>

    },
    {
      type: "column",
      name: "Filles",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_feminin_dut, JSON_NUMERIC_CHECK) ?>
    }
    ]
  });
  chartCycleDut.render();

  var chartCycleBts = new CanvasJS.Chart("chart_cycle_bts", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats BTS par region d'origine sur un effectif de " + <?= $total_candidats_bts ?> + " candidats"
    },

    data: [{
      type: "column",
      name: "Garçons",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_masculin_bts, JSON_NUMERIC_CHECK) ?>

    },
    {
      type: "column",
      name: "Filles",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_feminin_bts, JSON_NUMERIC_CHECK) ?>
    }
    ]
  });
  chartCycleBts.render();

  var chartCyclelitech = new CanvasJS.Chart("chart_cycle_litech", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats LITECH par region d'origine sur un effectif de " + <?= $total_candidats_litech ?> + " candidats"
    },

    data: [{
      type: "column",
      name: "Garçons",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_masculin_litech, JSON_NUMERIC_CHECK) ?>

    },
    {
      type: "column",
      name: "Filles",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_feminin_litech, JSON_NUMERIC_CHECK) ?>
    }
    ]
  });
  chartCyclelitech.render();

  var chartLieuDepotDut = new CanvasJS.Chart("chart_lieu_depot_dut", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats DUT par lieu de depot sur un effectif de " + <?= $total_candidats_dut ?> + " candidats"
    },

    data: [{
      type: "column",
      name: "Garçons",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_masculin_dut_lieu, JSON_NUMERIC_CHECK) ?>

    },
    {
      type: "column",
      name: "Filles",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_feminin_dut_lieu, JSON_NUMERIC_CHECK) ?>
    }
    ]
  });
  chartLieuDepotDut.render();

  var chartLieuDepotBts = new CanvasJS.Chart("chart_lieu_depot_bts", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats BTS par lieu de depot sur un effectif de " + <?= $total_candidats_bts ?> + " candidats"
    },

    data: [{
      type: "column",
      name: "Garçons",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_masculin_bts_lieu, JSON_NUMERIC_CHECK) ?>

    },
    {
      type: "column",
      name: "Filles",
      showInLegend: true,
      dataPoints: 
      <?= json_encode($candidats_feminin_bts_lieu, JSON_NUMERIC_CHECK) ?>
    }
    ]
  });
  chartLieuDepotBts.render();
});

</script>
</body>
</html>
