var table, table2;

$(function () {

  table = $('#liste_candidats').DataTable({
    initComplete: function () {
      $('.buttons-pdf').html('<span><i class="fa fa-file-pdf" data-toggle="tooltip" title="Exporter en pdf"></i> Pdf<span>');
      $('.buttons-excel').html('<span><i class="fa fa-file-excel" data-toggle="tooltip" title="Exporter en Excel"></i> Excel<span>');
       $('.buttons-filter').html('<span><i class="fa fa-filter" data-toggle="tooltip" title="Filtrer"></i> Filtrer<span>');
    },
    autoWidth: false,
    responsive: true,
    dom: 'Bfrtip',
    stateSave: true,
    buttons: [
    'excel', 'pdf',
    {
      text: 'Filtrer',
      className: "btn-sm btn-success buttons-filter",
      action: function ( e, dt, node, config ) {
        alert( 'En chantier' );
      }
    }
    ],
    language: {
      url: base_url + "assets/vendor/js/French.json"
    },
    columnDefs: [
    { 
      targets: [ 1 ],
      orderable: false,
    },
    { 
      targets: [ 2 ],
      orderable: false,
    },
    { 
      targets: [ 5 ], 
      orderable: false, 
    },
    { 
      targets: [ 6 ],
      orderable: false, 
    },
    { 
      targets: [ 7 ], 
      orderable: false,
    },
    { 
      targets: [ 8 ], 
      orderable: false,
    },
    { 
      targets: [ 9 ], 
      orderable: false,
    }
    ],

  });

  $('#mnt, #cyc').on('change', function() {

    var id_mention = $('#mnt').val();
    var id_cycle = $('#cyc').val();
    if (id_mention != '' && id_cycle != '') {

      $.ajax({
        url: base_url + "admin/fetch_parcours",
        method: "POST",
        data: {
          id_mention: id_mention,
          id_cycle: id_cycle
        },
        success: function(data) {
          console.log('Mention data: ', data);
          $('#parcours').html(data);
        }
      });

    }
  });

  $('#export-pdf').click(function() {
    $('#filters').attr('action', base_url + 'generation/generer_Liste_Candidat/valide');
    $('#filters').submit();
  });

  $('#export-excel').click(function(){
    $('#filters').attr('action', base_url + 'phpexcel/download/valide');
    $('#filters').submit();
  });

  $('#pays').change(function(){
    var id_pays= $('#pays').val();
    if (id_pays !='') 
    {
      $.ajax({
        url: base_url + "admin/fetch_region",
        method:"POST",
        data:{id_pays:id_pays},
        success:function(data)
        {
          $('#region').html(data);
        }
      });
    }
  });

  $('#cyc').change(function(){
    var id_cycle= $(this).val();
    if (id_cycle !='') 
    {
      $.ajax({
        url: base_url + "admin/fetch_centre",
        method:"POST",
        data:{id_cycle:id_cycle},
        success:function(data)
        {
          $('#centre_examen').html(data);
        }
      });
    }
  });

  $('#parcours').change(function(){
    var id_parcours= $('#parcours').val();
    if (id_parcours !='') 
    {
      $.ajax({
        url: base_url + "admin/fetch_cycle",
        method:"POST",
        data:{id_parcours:id_parcours},
        success:function(data)
        {
          $('#cycle').html(data);
        }
      });
    }
  });

   $('#filtre').click(function()
  {
    $('.filter_data').html('<div id="loading" style="" ></div>');
    sexe= $('#sexe').val();
    pays= $('#pays').val();
    region= $('#region').val();
    langue= $('#langue').val();
    lieu_depot= $('#lieu_depot').val();
    centre_examen= $('#centre_examen').val();
    mention= $('#mnt').val();
    parcours= $('#parcours').val();
    mode_admis= $('#mode_admis').val();
    cycle= $('#cyc').val();

        //const post = $('#filters').serialize();
        const post = {sexe:sexe,pays:pays,region:region,langue:langue,lieu_depot:lieu_depot,centre_examen:centre_examen,mention:mention,parcours:parcours,mode_admis:mode_admis,cycle:cycle};
        console.log('POST: ', post);

        //if (sexe!='' && pays!='' && region!='' && langue!='' && lieu_depot!='' && centre_examen!='' && mention!='' && mode_admis!='' && parcours!='' && cycle!='') {
          $.ajax({
            url: base_url + "admin/filtre_candidat",
            method:"POST",
            //data:{sexe:sexe,pays:pays,region:region,langue:langue,lieu_depot:lieu_depot,centre_examen:centre_examen,mention:mention,parcours:parcours,mode_admis:mode_admis,cycle:cycle},
            data: post,
            success: function(data)
            {
              $('.liste_candidats').html(data);
            }
          });
        //}
      });
 





  table2 = $('#liste_comptes').DataTable({
    autoWidth: false,
    responsive: true,
    stateSave: true,
    language: {
      url: base_url + "assets/vendor/js/French.json"
    }

  });

  $('.add_admin_btn').click(function(){
    $('#admin_modal .modal-title').text('Ajout d\'un administrateur');
  });

  $('#admin_modal').on('hidden.bs.modal', function(){
    $('input').removeClass('is-invalid').val('').next().hide().prev().prev().removeClass('text-danger');
  });

  $('input').change(function(){
    $(this).removeClass('is-invalid').next().hide().prev().prev().removeClass('text-danger');
  });

  /*$('.edit_admin_btn').click(function(){
     $('#admin_modal .modal-title').text('Modifier un administrateur');
     $('.add_admin_submit_btn').removeClass('add_admin_submit_btn').addClass('update_admin_submit_btn');
     $('#psw_zone').empty().before('<div class="form-group"><input type="checkbox" id="psw_checkbox"> Modifier le mot de passe</div>');
     //$('#psw_zone').empty();
     var id = $(this).closest('tr').attr('id');
     $.ajax({
      url: base_url + 'admin/ajax_get_admin',
      type: 'post',
      data: {id: id},
      dataType: 'json',
      success: function(data){
        $('#admin_modal [name="name"]').val(data.nom_admin);
        $('#admin_modal [name="email"]').val(data.email_admin);
      },
      error: function(){
        alert('erreur ajax');
      }
     });
  });
  */
  $('.delete_admin_btn').click(function(){
    var id = $(this).closest('tr').attr('id');

    Swal.fire({
      title: 'Etes vous sûr?',
      text: 'Cette action est irréversible!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Oui, supprimer!',
      cancelButtonText: 'Non, Annuler!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: base_url + 'accounts/delete_admin',
          type: 'POST',
          data: {id: id},
          success: function(data){
            Swal.fire(
              'Suppression',
              'Suppression effectué!',
              'success'
              )          },
            error: function(){
              alert('erreur ajax');
            }
          });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire(
          'Suppression',
          'suppression annulée!',
          'error'
          )
      }
    })
  });

  $('.add_admin_submit_btn').click(function(){
    var form = $('#admin_form');
    var data = form.serialize();
    $.ajax({
      url: form.attr('action'),
      type: 'POST',
      data: data,
      success: function(data){
       if (parseInt(data) === parseInt("1")) {
        $('#admin_modal').modal('hide');
        swal.fire('Enregistrement', 'Effectué', 'success');
        window.setTimeout(function(){
          location.reload();
        }, 3000)
      }
      else {
        var errors = JSON.parse(data);
        var err = Object.keys(errors);
        var ln = err.length;
        for (var i = 0; i < ln; i++) {
          $('#error' + err[i]).prev().addClass('is-invalid').prev().addClass('text-danger');
          $('#error' + err[i]).html(errors[err[i]]);
          $('#error' + err[i]).show();
        }
      }
    },
    error: function(){
      alert('erreur ajax');
    }
  });
  });

  $('.valid_checkbox').on('click', function(){
    if ($(this).is(':checked'))
    {
      $(this).closest('tr').addClass('bg-success');
    }
    else
    {
      $(this).closest('tr').removeClass('bg-success');
    }
  });

  $('.valid_all').click(function(){
    var checkbox = $('.valid_checkbox:checked');

    if(checkbox.length > 0)
    {
      var checkbox_value = [];

      $(checkbox).each(function(){
        checkbox_value.push($(this).val());
      });

      $.ajax({
        url: base_url + "admin/multiple_validation",
        type: 'post',
        data: {checkbox_value:checkbox_value},
        success: function(){
          $('tr.bg-success').fadeOut(1500);
          window.setTimeout(function(){
            location.reload();
          }, 3000)
        }
      });
    }
    else
    {
      alert('veuillez sélectionner une ligne');
    }

  });

  $('.invalid_checkbox').on('click', function(){
    if ($(this).is(':checked'))
    {
      $(this).closest('tr').addClass('bg-danger');
    }
    else
    {
      $(this).closest('tr').removeClass('bg-danger');
    }
  });

  $('.invalid_all').click(function(){
    var checkbox = $('.invalid_checkbox:checked');

    if(checkbox.length > 0)
    {
      var checkbox_value = [];

      $(checkbox).each(function(){
        checkbox_value.push($(this).val());
      });

      $.ajax({
        url: base_url + "admin/multiple_invalidation",
        type: 'post',
        data: {checkbox_value:checkbox_value},
        success: function(){
          $('tr.bg-danger').fadeOut(1500);
          window.setTimeout(function(){
            location.reload();
          }, 3000)
        }
      });
    }
    else
    {
      alert('veuillez sélectionner une ligne');
    }

  });

});