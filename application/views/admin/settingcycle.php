 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des cycles</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalCycle">Ajouter</button>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Abreviation</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>


                    
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;foreach ($fetch_cycle as $cycle) : ?>
                  <tr>
                        <td><?= $i ?></td>
                        <td><?= $cycle->nom_cycle ?></td>
                        <td><?= $cycle->abreviation_cycle ?></td>
                        
                          <td class="text-center"><button class="btn btn-info" data-toggle="modal" data-target="#modal-edit-student"><i class="fa fa-edit"></i></button></td>
                    <td class="text-center"><button class="btn btn-danger delete_cycle" ><i class="fa fa-trash"></i></button></td>
                         <!-- <span class="fa fa-edit btn btn-success"> </span>
                          <span class="fa fa-trash btn btn-danger"> </span>-->
                        

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
<div class="modal" id="myModalCycle">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ajouter un CYCLE</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
                        <label>Nom_Cycle:</label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                        <label>abreviation:</label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                      </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="ajouter_cycle">Ajouter</button>
      </div>

    </div>
  </div>
</div>