    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des comptes</h3>
                <button style="float: right;" class="btn btn-success" onclick="add_user()" ><i class="fa fa-plus"></i> Ajouter</button>
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
                      <table id="users_table" class="table table-striped table-bordered" style="width:100%; font-size: 14px;">
                        <thead>
                          <th>#</th>
                          <th>Nom(s)</th>
                          <th>Prénom(s)</th>
                          <th>Email</th>
                          <th>Statut</th>
                          <th>Role</th>
                          <th>Photo</th>
                          <th>Créer par</th>
                          <th>Activer/Desactiver</th>
                          <th>Modifier</th>
                          <th>Supprimer</th>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                          <th>#</th>
                          <th>Nom(s)</th>
                          <th>Prénom(s)</th>
                          <th>Email</th>
                          <th>Statut</th>
                          <th>Role</th>
                          <th>Photo</th>
                          <th>Créer par</th>
                          <th>Activer/Desactiver</th>
                          <th>Modifier</th>
                          <th>Supprimer</th>
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
          <div class="modal fade" id="modal_form">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Formulaire</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body form">
                  <form id="form" action="#">
                    <input type="hidden" value="" name="id">
                    <div class="form-group">
                      <label class="control-label">Nom(s)*:</label>
                      <input type="text" name="firstname" class="form-control">
                      <span class="help-block text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Prénom(s)*:</label>
                      <input type="text" name="lastname" class="form-control">
                      <span class="help-block text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Email*:</label>
                      <input type="text" name="email" class="form-control">
                      <span class="help-block text-danger"></span>
                    </div>
                    <div class="form-group">
                      <select name="role" class="form-control">
                        <option value="">--role--</option>
                        <option value="admin">admin</option>
                        <option value="resp_delg">délégation</option>
                      </select>
                      <span class="help-block text-danger"></span>
                    </div>
                    <div class="psw_check">
                      <input type="checkbox" name="change_psw" onclick="psw_zone()" value="yes" /> Modifier le mot de passe</br></br></br>
                    </div>
                    <div id="password-zone">
                      <div class="form-group">
                        <label class="control-label">Mot de passe*:</label>
                        <input name="password" placeholder="Mot de passe*" class="form-control" type="password">
                        <span class="help-block text-danger"></span>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Confirmez le mot de passe:</label>
                        <input name="password_conf" placeholder="Confirmez le Mot de passe" class="form-control" type="password">
                        <span class="help-block text-danger"></span>
                      </div>
                    </div>
                    <div class="form-group row" id="photo-preview">
                      <label class="control-label col-md-3">Photo</label>
                      <div class="col-md-9">
                        (Pas de photo)
                        <span class="help-block"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3" id="label-photo">Ajouter Photo </label>
                      <div class="col-md-9">
                        <input name="photo" type="file">
                        <span class="help-block"></span>
                      </div>
                    </div>
                  </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                  <button type="button" id="btnSave" onclick="save()" class="btn btn-success">Enregistrer</button>
                </div>

              </div>
            </div>
          </div>