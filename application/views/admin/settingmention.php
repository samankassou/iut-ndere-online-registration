 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des mentions</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalMention">Ajouter</button>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Sigle</th>
                 <th></th>

                    
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;foreach ($fetch_mention as $mention) : ?>
                  <tr>
                        <td><?= $i ?></td>
                        <td><?= $mention->nom_mention ?></td>
                        <td><?= $mention->sigle_mention ?></td>
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
<div class="modal" id="myModalMention">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ajouter une MENTION</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
                        <label>Nom_Mention:</label>
                        <input type="text" name="n_mention" class="form-control" placeholder="Enter ...">
                        <label>sigle_Mention:</label>
                        <input type="text"  name="s_mention" class="form-control" placeholder="Enter ...">
                         <label>Cycle:</label>
                        <select id="cyc" name="cycle" class="form-control">
                                    <option value="" disabled="disabled" selected="selected">Choissisez un cycle</option>

                                    <?php foreach ($cycle as $value) : ?>
                                      <option value="<?= $value->id_cycle; ?>"><?= $value->abreviation_cycle; ?></option>
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

                    
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;foreach ($fetch_mention as $mention) : ?>
                  <tr>
                        <td><?= $i ?></td>
                        <td><?= $mention->nom_mention ?></td>
                        <td><?= $mention->sigle_mention ?></td>
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ajouter une Mention</h4>
      </div>
      <form method="post" id="user_form">
        
      <div class="modal-body">
       
       <div class="form-group" m>
           <label>Nom_Cycle:</label>
            <input type="text" class="form-control" placeholder="Enter ...">
             <label>abreviation:</label>
              <input type="text" class="form-control" placeholder="Enter ...">
        </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-default" >Ajouter</button>
        
      </div>
      </form>
    </div>

  </div>
</div>