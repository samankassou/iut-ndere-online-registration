<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IUT Concours | <?= $title ?></title>
  <!-- logo -->
  <link rel="shortcut icon" href="<?= img_url('logos/logo_iut.jpg')?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/admin.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/template/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Flag-icons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/template/plugins/flag-icon-css/css/flag-icon.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/template/dist/css/adminlte.min.css">
  <!-- Sweet-alert -->
  <link rel="stylesheet" href="<?= base_url() ?>vendor/sweetalert/css/sweetalert.css">
  <style>
    #loading
    {
       text-align:center; 
       background: url('<?php echo base_url(); ?>assets/loader.gif') no-repeat center; 
       height: 150px;
   }
</style>

</head>
<body class="hold-transition sidebar-mini text-sm">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="flag-icon flag-icon-fr"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right p-0" style="left: inherit; right: 0px;">
            <a href="#" class="dropdown-item active">
              <i class="flag-icon flag-icon-fr mr-2"></i> Français
            </a>
            <a href="#" class="dropdown-item">
              <i class="flag-icon flag-icon-us mr-2"></i> English
            </a>
          </div>
        </li>
        <li class="nav-item">
          <?php if (!empty($this->session->email)): ?>

           <a class="nav-link" href="<?= site_url('login/logout') ?>">
            <i class="fa fa-user"></i>
            Déconnexion
          </a>
        </li>
      <?php endif; ?>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url('admin/index') ?>" class="brand-link">
      <img src="<?= img_url('logos/logo_iut.jpg')?>" alt="IUT Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">IUT Concours</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= img_url('avatars/default.png')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $this->session->firstname ?> <?= $this->session->lastname ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Rechercher" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="<?= site_url('admin/index') ?>" class="nav-link <?php if(($this->uri->segment(1) == 'admin') and ($this->uri->segment(2) == 'index')): echo 'active'; endif; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <div style="display: none;" name="session_id" id="<?= $this->session->id_user ?>"></div>
          <li class="nav-header">CANDIDATS</li>
          <li class="nav-item has-treeview <?= ($this->uri->segment(1) === 'candidates')?'menu-open':'' ?>">
            <a href="#" class="nav-link <?= ($this->uri->segment(1) === 'candidates')?'active':'' ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Liste des candidats
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('candidates/index/en_attente') ?>" class="nav-link <?= ($this->uri->segment(3) == 'en_attente')?'active':'' ?>">
                  <i class="far fa-hourglass nav-icon"></i>
                  <p>En attente</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('candidates/index/valide') ?>" class="nav-link <?= ($this->uri->segment(3) == 'valide')?'active':'' ?>">
                  <i class="far fa-thumbs-up nav-icon"></i>
                  <p>Validés</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">STATISTIQUES</li>
          <li class="nav-item has-treeview <?php if($this->uri->segment(1) == 'statistiques'): echo 'menu-open';
          endif; ?>">
          <a href="#" class="nav-link <?php if($this->uri->segment(1) == 'statistiques'): echo 'active';
          endif; ?>">
          <i class="nav-icon fas fa-chart-pie"></i>
          <p>
            Stats candidats
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?= site_url('statistiques/globales') ?>" class="nav-link <?php if($this->uri->segment(2) == 'globales'): echo 'active';
            endif; ?>">
            <i class="far fa-chart-bar nav-icon"></i>
            <p>Globales</p>
          </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('statistiques/par_cycle') ?>" class="nav-link <?php if($this->uri->segment(2) == 'par_cycle'): echo 'active';
            endif; ?>">
            <i class="far fa-chart-bar nav-icon"></i>
            <p>Par Cycle</p>
          </a>
        </li>
    </ul>
  </li>
  <li class="nav-header">GESTIONNAIRES</li>
  <li class="nav-item">
    <a href="<?= base_url('file_browser/index/assets/documents') ?>" class="nav-link <?php if($this->uri->segment(1) == 'file_browser'): echo 'active';
    endif; ?>">
    <i class="nav-icon fas fa-folder"></i>
    <p>
      Explorateur
    </p>
  </a>
</li>
<li class="nav-header">PARAMETRES</li>
<li class="nav-item">
  <a href="<?= site_url('accounts/index') ?>" class="nav-link <?php if($this->uri->segment(1) == 'accounts'): echo 'active';
  endif; ?>">
  <i class="nav-icon fas fa-users"></i>
  <p>
    Comptes
  </p>
</a>
</li>
</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?php if(($this->uri->segment(1) == 'admin') and ($this->uri->segment(2) == '')): echo 'Dashboard';
       elseif ($this->uri->segment(1) == 'statistiques'):
        echo "<i class='fas fa-chart-pie'></i> Satistiques";
      elseif ($this->uri->segment(1) == 'file_browser'):
        echo "<i class='fas fa-folder'></i> Explorateur";
      elseif ($this->uri->segment(1) == 'accounts'):
        echo "<i class='fas fa-users'></i> Comptes administrateurs";
      endif; ?>
      <?php if($this->uri->segment(3) == 'en_attente'): echo '<i class="far fa-hourglass nav-icon"></i> Candidats en attente';
      elseif ($this->uri->segment(3) == 'valide'):
       echo '<i class="far fa-thumbs-up nav-icon"></i> Candidats validés';
     elseif ($this->uri->segment(2) == 'globales'):
       echo "globales";
     endif; ?>
   </h1>
 </div>
 <div class="col-sm-6">
  <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= site_url('admin/index') ?>">Dashboard</a></li>
      <?php if($this->uri->segment(3) == 'en_attente'): ?>
        <li class="breadcrumb-item"><a href="<?= current_url() ?>">Candidats en attente</a></li>
        <?php elseif($this->uri->segment(3) == 'valide'): ?>
          <li class="breadcrumb-item"><a href="<?= current_url() ?>">Candidats Validés</a></li>
        <?php elseif($this->uri->segment(1) == 'statistiques'): ?>
          <li class="breadcrumb-item"><a href="<?= current_url() ?>">Statistiques</a></li>
          <?php if($this->uri->segment(2) == 'globales'): ?>
            <li class="breadcrumb-item"><a href="<?= current_url() ?>">Globales</a></li>
            <?php endif; ?>
            <?php elseif($this->uri->segment(1) == 'file_browser'): ?>
              <li class="breadcrumb-item"><a href="<?= current_url() ?>">Explorateur</a></li>
              <?php elseif($this->uri->segment(1) == 'accounts'): ?>
                <li class="breadcrumb-item"><a href="<?= current_url() ?>">Comptes</a></li>
              <?php endif; ?>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

				<!-- Main content -->
				<section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"><?php echo $virtual_root.'/'.$path_in_url ?></h3>
									</div>
									<!-- /.card-header -->
									<div class="card-body">
										<?php
										$prefix = $controller.'/'.$method.'/'.$path_in_url;
										if (!empty($dirs)) foreach( $dirs as $dir )
											echo '/'.anchor($prefix.$dir['name'], $dir['name']).'<br>';

										if (!empty($files)) foreach( $files as $file )
											echo anchor($prefix.$file['name'], $file['name']).'<br>';
										?>
										<!-- /.card -->
									</div>
									<!-- /.col -->
								</div>
								<!-- /.row -->
							</div>
							<!-- /.container-fluid -->
						</section>
						<!-- /.content -->
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
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
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

  var chartCentreExamDut = new CanvasJS.Chart("chart_centre_exam_dut", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats DUT sur un effectif de " + <?= $total_candidats ?> + " candidats"
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
  chartCentreExamDut.render();

  var chartCentreExamBts = new CanvasJS.Chart("chart_centre_exam_bts", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats BTS sur un effectif de " + <?= $total_candidats ?> + " candidats"
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
  chartCentreExamBts.render();

  var chartCentreExamLitech = new CanvasJS.Chart("chart_centre_exam_litech", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats LITECH sur un effectif de " + <?= $total_candidats ?> + " candidats"
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
  chartCentreExamLitech.render();


   var chartLieuDepotDut = new CanvasJS.Chart("chart_lieu_depot_dut", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats DUT sur un effectif de " + <?= $total_candidats ?> + " candidats"
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
  chartLieuDepotDut.render();

  var chartLieuDepotBts = new CanvasJS.Chart("chart_lieu_depot_bts", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats BTS sur un effectif de " + <?= $total_candidats ?> + " candidats"
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
  chartLieuDepotBts.render();

  var chartLieuDepotLitech = new CanvasJS.Chart("chart_lieu_depot_litech", {
    zoomEnabled: true,
    theme: 'light2',
    animationEnabled: true,
    title: {
      text: "Candidats LITECH sur un effectif de " + <?= $total_candidats ?> + " candidats"
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
  chartLieuDepotLitech.render();
});

</script>
</body>
</html>
