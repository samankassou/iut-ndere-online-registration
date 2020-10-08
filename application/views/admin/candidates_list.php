    <!-- Main content -->
    <input type="hidden" id="statut" value="<?= $this->uri->segment(3) ?>">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des candidats</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                    <div class="col-sm-12 col-md-6"></div>
                    <div class="col-sm-12 col-md-6"></div>
                  </div>
                  <form action="" id="filters" method="POST">
                  <div class="row">
                    <div class="col-sm-12">
                      <table id="liste_candidats" class="table table-striped table-bordered" style="width:100%; font-size: 14px;">
                       <?php if ($this->uri->segment(3) != 'en_attente') : ?>
                        <div class="row">
                          <div class="col-12 col-md-3">
                            <div class="form-group">
                              <span>Cycle:</span>
                              <select id="cyc" name="cycle" class="form-control">
                                <option value="" disabled="disabled" selected="selected">Choisissez un cycle</option>

                                <?php foreach ($cycle as $value) : ?>
                                  <option value="<?= $value->id_cycle; ?>"><?= $value->abreviation_cycle; ?></option>
                                <?php endforeach; ?>
                                <option value="">Tous</option>

                              </select>

                            </div>
                          </div>
                          <div class="col-12 col-md-3">
                            <div class="form-group">
                              <span>Pays d'origine :</span>
                              <select id="pays" name="pays" class="form-control">
                                <option value="" disabled="disabled" selected="selected">Choisissez un pays d'origine</option>
                                <?php foreach ($pays as $value) : ?>
                                  <option value="<?= $value->id_pays; ?>"><?= $value->nom_pays; ?></option>
                                <?php endforeach; ?>
                                <option value="">Tous</option>
                              </select>


                            </div>
                          </div>
                          <div class="col-12 col-md-3">
                            <div class="form-group">
                              <span>Region d'origine :</span>
                              <select id="region" name="region" class="form-control">
                                <option value="" disabled="disabled" selected="selected">Choisissez une region d'origine</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-12 col-md-3">
                            <div class="form-group">
                              <span>Sexe :</span>
                              <select id="sexe" name="sexe" class="form-control">
                                <option value="" disabled="disabled" selected="selected">Choisissez un sexe</option>
                                <option value="m">Masculin</option>
                                <option value="f">Feminin</option>
                                <option value="">Tous</option>
                              </select>

                            </div>
                          </div>
                          <div class="col-12 col-md-3">
                            <div class="form-group">
                              <span>Mention :</span>
                              <select id="mnt" name="mention" class="form-control">
                                <option value="" disabled="disabled" selected="selected">Choisissez une mention</option>

                                <?php foreach ($mention as $value) : ?>
                                  <option value="<?= $value->id_mention; ?>"><?= $value->nom_mention; ?></option>
                                <?php endforeach; ?>
                                <option value="">Tous</option>
                              </select>



                            </div>
                          </div>
                          <div class="col-12 col-md-3">
                            <div class="form-group">
                              <span>lieu dépot :</span>
                              <select id="lieu_depot" name="lieu_depot" class="form-control" style="font-size: 0.8em;">
                                <option value="" disabled="disabled" selected="selected">Choisissez un lieu de depot</option>
                                <?php foreach ($lieux as $value) : ?>
                                  <option value="<?= $value->id_lieu_depot; ?>"><?= $value->nom_lieu_depot; ?></option>
                                <?php endforeach; ?>
                                <option value="">Tous</option>

                              </select>
                            </div>
                          </div>
                          <div class="col-12 col-md-3">
                            <div class="form-group">
                              <span>Centre d'examen :</span>
                              <select id="centre_examen" name="centre_examen" class="form-control">
                                <option value="" disabled="disabled" selected="selected">Choisissez un centre d'examen</option>
                                <option value="">Tous</option>



                              </select>
                            </div>
                          </div>
                          <div class="col-12 col-md-3">
                            <div class="form-group">
                             <span>Langue de composition :</span>
                             <select id="langue" name="langue" class="form-control">
                              <option value="" disabled="disabled" selected="selected">Choisissez une langue</option>

                              <option value="Français">Français</option>
                              <option value="Anglais">Anglais</option>
                              <option value="">Tous</option>

                            </select>



                          </div>
                        </div>
                        <div class="col-12 col-md-3">
                          <div class="form-group">
                           <span> Parcours :</span>
                           <select id="parcours" name="parcours" class="form-control">
                            <option value="" disabled="disabled" selected="selected">Choisissez un parcours</option>
                          </select>
                        </div>
                      </div>

                    </div>
                  </div>
                </form>

                <div class="row">
                  <div class="col-md-6">
                    <button id="export-pdf" class="btn btn-block btn-primary btn-flat" target='_blank'>Imprimer PDF</button>
                  </div>
                  <div class="col-md-6">
                    <a id="export-excel" class="btn btn-block btn-primary btn-flat" href="<?= base_url() ?>Phpexcel/test" target='_blank'> Exporter en EXCEL</a>
                  </div>
                </div>
              <?php endif; ?>
            </div>
            <br>
            <thead>
              <th>#</th><?php if($this->uri->segment(3) === 'en_attente'): ?>
              <th class="text-center"><button style="font-size: 14px" type="button" name="valid_all" class="btn btn-success valid_all">Valider</button>
              </th>
              <?php else: ?>
                <th class="text-center"><button style="font-size: 14px" type="button" name="invalid_all" class="btn btn-danger invalid_all">Invalider</button>
                </th>
              <?php endif; ?>
              <th>Paiement</th>
              <th>Nom(s)</th>
              <th>Prénom(s)</th>
              <th>Sexe</th>
              <th>Date de naissance</th>
              <th>Mention</th>
              <th>Centre d'examen</th>
              <th>Lieu de dépôt</th>
            </thead>
            <tbody class="liste_candidats filter_data">
              
              </tbody>
              <tfoot>
                <th>#</th><?php if($this->uri->segment(3) === 'en_attente'): ?>
                <th class="text-center"><button style="font-size: 14px" type="button" name="valid_all" class="btn btn-success valid_all">Valider</button>
                </th>
                <?php else: ?>
                  <th class="text-center"><button style="font-size: 14px" type="button" name="invalid_all" class="btn btn-danger invalid_all">Invalider</button>
                  </th>
                <?php endif; ?>
                <th>Paiement</th>
                <th>Nom(s)</th>
                <th>Prénom(s)</th>
                <th>Sexe</th>
                <th>Date de naissance</th>
                <th>Mention</th>
                <th>Centre d'examen</th>
                <th>Lieu de dépôt</th>
              </tfoot>
            </table>
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