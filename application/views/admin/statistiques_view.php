<!-- Main content -->
<section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card <?= empty($stat_class)?'':$stat_class ?>">
                <div class="card-header">
                  <h3 class="card-title" style="height: 50px"></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div style="float: left;">
                       <button class="btn btn-info global-pie"><i class="fa fa-chart-pie"></i> Pie</button>
                       <button class="btn btn-info global-bar"><i class="fa fa-chart-bar"></i> Bar</button>
                     </div>
                     <div style="float: right;" >
                       <a href="<?= site_url('statistiques/print_stat/globales') ?>" class="btn btn-info"><i class="fa fa-file-pdf"></i> Pdf</a>
                       <a href="<?= site_url('statistiques/print_excel/globales') ?>" class="btn btn-info"><i class="fa fa-file-excel"></i> Excel</a>
                     </div>
                     <div style="clear: right;"></div>
                     <div id="chartGlobal" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>  <br><br>
                   </div>
                   <div class="col-md-12">
                    <h2 class="mb-2 text-center">Statistiques par cycle</h2>
                    <div class="row">
                     <div class="col-md-6">
                       <!-- AREA CHART -->
                       <div class="card card-secondary">
                        <div class="card-header">
                          <h3 class="card-title">Stats</h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body">
                          <div style="float: left;">
                            <button class="btn btn-secondary cycle_dut-pie"><i class="fa fa-chart-pie"></i> Pie</button>
                            <button class="btn btn-secondary cycle_dut-bar"><i class="fa fa-chart-bar"></i> Bar</button>
                          </div>
                          <div style="float: right;">
                           <a href="<?= site_url('statistiques/print_stat/cycle/dut') ?>" class="btn btn-secondary"><i class="fa fa-file-pdf"></i> Pdf</a>
                           <a href="<?= site_url('statistiques/print_excel/cycle/dut') ?>" class="btn btn-secondary"><i class="fa fa-file-excel"></i> Excel</a>
                         </div><br><br>
                         <div id="chart_cycle_dut" style="height: 250px; max-width: 100%; margin: 0px auto;"></div>
                       </div>
                       <!-- /.card-body -->
                     </div>
                     <!-- /.card -->
                   </div>

                   <div class="col-md-6">
                     <!-- AREA CHART -->
                     <div class="card card-secondary">
                      <div class="card-header">
                        <h3 class="card-title">Stats</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div style="float: left;">
                          <button class="btn btn-secondary cycle_bts-pie"><i class="fa fa-chart-pie"></i> Pie</button>
                          <button class="btn btn-secondary cycle_bts-bar"><i class="fa fa-chart-bar"></i> Bar</button>
                        </div>
                        <div style="float: right;">
                         <a href="<?= site_url('statistiques/print_stat/cycle/bts') ?>" class="btn btn-secondary"><i class="fa fa-file-pdf"></i> Pdf</a>
                         <a href="<?= site_url('statistiques/print_excel/cycle/bts') ?>" class="btn btn-secondary"><i class="fa fa-file-excel"></i> Excel</a>
                       </div><br><br>
                       <div id="chart_cycle_bts" style="height: 250px; max-width: 100%; margin: 0px auto;"></div>
                     </div>
                     <!-- /.card-body -->
                   </div>
                   <!-- /.card -->
                 </div>

                 <div class="col-md-12">
                   <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Stats</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div style="float: left;">
                        <button class="btn btn-secondary cycle_litech-pie"><i class="fa fa-chart-pie"></i> Pie</button>
                        <button class="btn btn-secondary cycle_litech-bar"><i class="fa fa-chart-bar"></i> Bar</button>
                      </div>
                      <div style="float: right;">
                       <a href="<?= site_url('statistiques/print_stat/cycle/litech') ?>" class="btn btn-secondary"><i class="fa fa-file-pdf"></i> Pdf</a>
                       <a href="<?= site_url('statistiques/print_excel/cycle/litech') ?>" class="btn btn-secondary"><i class="fa fa-file-excel"></i> Excel</a>
                     </div><br><br>
                     <div id="chart_cycle_litech"style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                   </div>
                   <!-- /.card-body -->
                 </div>
                 <!-- /.card -->
               </div>
             </div>
           </div>
           <div class="col-md-12">
            <h2 class="mb-2 text-center">Statistiques par langue de composition</h2>
            <div class="row">
             <div class="col-md-6">
               <!-- AREA CHART -->
               <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Stats</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div style="float: right;">
                   <a href="<?= site_url('statistiques/print_stat/lang/dut') ?>" class="btn btn-secondary"><i class="fa fa-file-pdf"></i> Pdf</a>
                   <a href="<?= site_url('statistiques/print_excel/lang/dut') ?>" class="btn btn-secondary"><i class="fa fa-file-excel"></i> Excel</a>
                 </div><br><br>
                 <div id="chart_lang_dut" style="height: 250px; max-width: 100%; margin: 0px auto;"></div>
               </div>
               <!-- /.card-body -->
             </div>
             <!-- /.card -->
           </div>
           <div class="col-md-6">
             <!-- AREA CHART -->
             <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Stats</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div style="float: right;">
                 <a href="<?= site_url('statistiques/print_stat/lang/bts') ?>" class="btn btn-secondary"><i class="fa fa-file-pdf"></i> Pdf</a>
                 <a href="<?= site_url('statistiques/print_excel/lang/bts') ?>" class="btn btn-secondary"><i class="fa fa-file-excel"></i> Excel</a>
               </div><br><br>
               <div id="chart_lang_bts" style="height: 250px; max-width: 100%; margin: 0px auto;"></div>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>
       </div>
     </div>
     <div class="col-md-6">
      <h2 class="mb-2 text-center">Statistiques par centre d'examen</h2>
      <!-- AREA CHART -->
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Stats</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div style="float: right;">
           <a href="<?= site_url('statistiques/print_stat/centre_exam/dut') ?>" class="btn btn-secondary"><i class="fa fa-file-pdf"></i> Pdf</a>
           <a href="<?= site_url('statistiques/print_excel/centre_exam/dut') ?>" class="btn btn-secondary"><i class="fa fa-file-excel"></i> Excel</a>
         </div><br><br>
         <div id="chart_centre_exam_dut" style="height: 250px; max-width: 100%; margin: 0px auto;"></div>
       </div>
       <!-- /.card-body -->
     </div>
     <!-- /.card -->
     <!-- DONUT CHART -->
     <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">Stats</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div style="float: right;">
         <a href="<?= site_url('statistiques/print_stat/centre_exam/bts') ?>" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Pdf</a>
         <a href="<?= site_url('statistiques/print_excel/centre_exam/bts') ?>" class="btn btn-danger"><i class="fa fa-file-excel"></i> Excel</a>
       </div><br><br>
       <div id="chart_centre_exam_bts" style="height: 250px; max-width: 100%; margin: 0px auto;"></div>
     </div>
     <!-- /.card-body -->
   </div>
   <!-- /.card -->
  </div>
  <div class="col-md-6">
    <h2 class="mb-2 text-center">Statistiques par Lieux de dépôt</h2>
    <!-- LINE CHART -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Stats</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
       <div style="float: right;">
         <a href="<?= site_url('statistiques/print_stat/lieu_depot/dut') ?>" class="btn btn-primary"><i class="fa fa-file-pdf"></i> Pdf</a>
         <a href="<?= site_url('statistiques/print_excel/lieu_depot/dut') ?>" class="btn btn-primary"><i class="fa fa-file-excel"></i> Excel</a>
       </div><br><br>
       <div id="chart_lieu_depot_dut" style="height: 250px; max-width: 100%; margin: 0px auto;"></div>
     </div>
     <!-- /.card-body -->
   </div>
   <!-- /.card -->
   <!-- BAR CHART -->
   <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Stats</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
     <div style="float: right;">
       <a href="<?= site_url('statistiques/print_stat/lieu_depot/bts') ?>" class="btn btn-success"><i class="fa fa-file-pdf"></i> Pdf</a>
       <a href="<?= site_url('statistiques/print_excel/lieu_depot/bts') ?>" class="btn btn-success"><i class="fa fa-file-excel"></i> Excel</a>
     </div><br><br>
     <div id="chart_lieu_depot_bts" style="height: 250px; max-width: 100%; margin: 0px auto;"></div>
   </div>
   <!-- /.card-body -->
  </div>
  <!-- /.card -->
  </div>
  </div>
  </div>
  <!-- /.card-body -->
  </div>
  <!-- /.card -->
  </div>
  <!-- /.col -->
  </div>
  <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
        <!-- /.content -->