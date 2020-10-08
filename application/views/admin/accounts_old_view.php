    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des comptes administrateurs</h3>
                <button style="float: right;" class="btn btn-success add_admin_btn" data-toggle="modal" data-target="#admin_modal"><i class="fa fa-plus"></i> Ajouter</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <div class="row">
                    <div class="col-sm-12 col-md-6"></div>
                    <div class="col-sm-12 col-md-6"></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <table id="liste_comptes" class="table table-striped table-bordered" style="width:100%; font-size: 14px;">
                        <thead>
                          <th>#</th>
                          <th>Noms</th>
                          <th>Email</th>
                          <th>Options</th>
                        </thead>
                        <tbody>

                          <?php $i = 1; foreach($comptes as $compte): ?>
                          <tr id="<?= $compte->id_admin ?>">
                            <td><?= $i ?></td>
                            <td><?= $compte->nom_admin ?></td>
                            <td><?= $compte->email_admin ?></td>
                            <td><button class="btn btn-primary edit_admin_btn"  data-toggle="modal" data-target="#admin_modal"><i class="fa fa-edit"></i></button>  <button class="btn btn-danger delete_admin_btn"><i class="fa fa-trash"></i></button></td>
                          </tr>
                        <?php $i++; endforeach; ?>
                      </tbody>
                      <tfoot>
                        <th>#</th>
                        <th>Noms</th>
                        <th>Email</th>
                        <th>Options</th>
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

        <!-- The Modal -->
        <div class="modal fade" id="admin_modal">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form id="admin_form" action="<?= base_url() ?>accounts/add_admin">
                  <div class="form-group">
                    <label class="control-label">Nom(s)*:</label>
                    <input type="text" name="name" class="form-control">
                    <?= error_tag("name") ?>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Email*:</label>
                    <input type="text" name="email" class="form-control">
                    <?= error_tag("email") ?>
                  </div>
                  <div id="psw_zone">
                    <div class="form-group">
                    <label class="control-label">Mot de passe*:</label>
                    <input type="password" name="psw" class="form-control">
                    <?= error_tag("psw") ?>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Confirmez le mot de passe:</label>
                    <input type="password" name="psw_conf" class="form-control">
                    <?= error_tag("psw_conf") ?>
                  </div>
                  </div>
                </form>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-success add_admin_submit_btn">Enregistrer</button>
              </div>

            </div>
          </div>
        </div>