
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des Parcour</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalParcours">Ajouter</button>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Abreviation</th>
                    <th></th>

                    
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;foreach ($fetch_parcour as $parcour) : ?>
                  <tr>
                        <td><?= $i ?></td>
                        <td><?= $parcour->nom_parcour ?></td>
                        <td><?= $parcour->abreviation_parcour ?></td>
                        <td>
                          <span class="fa fa-edit btn btn-success"> </span>
                          <span class="fa fa-trash btn btn-danger"> </span>
                        </td>

                  </tr>
                <?php $i+=1; endforeach ; ?>
                  
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
<!-- Modal -->
<div class="modal" id="myModalParcours">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ajouter un PARCOUR</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
                        <label>Nom_Parcour:</label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                        <label>abreviation:</label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                        <label>mention:</label>
                          <select id="mention" name="mention" class="form-control">
                                  <option value="" disabled="disabled" selected="selected">Choissisez une mention</option>

                                  <?php foreach ($mention as $value) : ?>
                                  <option value="<?= $value->id_mention; ?>" ><?= $value->nom_mention; ?></option>
                                  <?php endforeach; ?>
                                </select>
                        <label>cycle:</label>
                        <select id="cycle" name="cycle" class="form-control">
                                  <option value="" disabled="disabled" selected="selected">Choissisez un cycle</option>

                                  <?php foreach ($cycle as $value) : ?>
                                  <option value="<?= $value->id_cycle; ?>" ><?= $value->abreviation_cycle; ?></option>
                                  <?php endforeach; ?>
                                  
                                </select></br>
                      </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" data-dismiss="modal">Ajouter</button>
      </div>

    </div>
  </div>
  </div>