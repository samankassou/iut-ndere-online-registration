var table;

$(document).ready(function() {
    //datatables
    table = $('#liste_candidats').DataTable({ 

      "language": {
            url: base_url + "assets/js/French.json"//pour le datatable en francais
          },
          responsive: true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "fnInitComplete": function(oSettings, json) {
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
        },

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": base_url + "candidates/ajax_list/",
          "type": "POST",
          "data": {
            statut: function() { return $('#statut').val() },
            cycle: function() { return $('[name="cycle"]').val() },
            pays: function() { return $('[name="pays"]').val() },
            region: function() { return $('[name="region"]').val() },
            sexe: function() { return $('[name="sexe"]').val() },
            mention: function() { return $('[name="mention"]').val() },
            lieu_depot: function() { return $('[name="lieu_depot"]').val() },
            centre_examen: function() { return $('[name="centre_examen"]').val() },
            langue: function() { return $('[name="langue"]').val() },
            parcours: function() { return $('[name="parcours"]').val() }
          }
        },
        "fnDrawCallback": function( oSettings ) {
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
        },

        //Set column definition initialisation properties.
        "columnDefs": [
                          { 
                            "targets": [ 0 ], //first column
                            "orderable": false, //set not orderable
                          },
                          { 
                            "targets": [ 1 ], //last column
                            "orderable": false, //set not orderable
                          },
                          { 
                            "targets": [ 2 ], //last column
                            "orderable": false, //set not orderable
                          }
                      ],

    });

    $('select').change(function() {
      table.ajax.reload();
    });

    $('[name="pays"]').change(function(){
      id_pays = $(this).val();
      $.ajax({
        url: base_url + 'candidates/ajax_get_region/',
        data: {id_pays: id_pays},
        type: 'POST',
        dataType: 'JSON',
        success: function(data){
                  var html = '<option value="" disabled="disabled" selected="selected">Choisissez une region d\'origine</option>';
                  var i;
                  for(i=0; i<data.length; i++)
                    {
                      html += '<option value='+data[i].id_reg_or+'>'+data[i].nom_reg_or+'</option>';
                    }
                  $('[name="region"]').html(html);
                },
        error: function(){
          alert('erreur ajax');
        }
      });
    });

    $('[name="cycle"]').change(function(){
      id_cycle = $(this).val();

      $.ajax({
        url: base_url + 'candidates/ajax_get_mentions/',
        data: {id_cycle: id_cycle},
        type: 'POST',
        dataType: 'JSON',
        success: function(data){
                  $('[name="parcours"]').html('<option value="" disabled="disabled" selected="selected">Choisissez un parcours</option>');
                  var html = '<option value="" disabled="disabled" selected="selected">Choisissez une mention</option>';
                  var i;
                  for(i=0; i<data.length; i++)
                    {
                      html += '<option value='+data[i].id_mention+'>'+data[i].nom_mention+'</option>';
                    }
                    html += '<option value="">Toutes</option>';

                  $('[name="mention"]').html(html);
                  reload_table();
         },
        error: function(){
          alert('erreur ajax');
        }
      });
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
            url: base_url + "candidates/multiple_validation",
            type: 'post',
            data: {checkbox_value:checkbox_value},
            success: function(){
              $('tr.bg-success').fadeOut(1500);
              reload_table();
            }
          });
        }
        else
        {
          alert('veuillez sélectionner une ligne');
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
            url: base_url + "candidates/multiple_invalidation",
            type: 'post',
            data: {checkbox_value:checkbox_value},
            success: function(){
              $('tr.bg-danger').fadeOut(1500);
              reload_table();
            }
          });
        }
        else
        {
          alert('veuillez sélectionner une ligne');
        }
    });

    $('[name="mention"]').change(function(){
      id_mention = $(this).val();
      id_cycle = function(){return $('[name="cycle"]').val()};
      if (id_cycle !== '')
      {
        $.ajax({
        url: base_url + 'candidates/ajax_get_parcours/',
        data: {id_mention: id_mention, id_cycle: id_cycle},
        type: 'POST',
        dataType: 'JSON',
        success: function(data){
                  $('[name="parcours"]').html('<option value="" disabled="disabled" selected="selected">Choisissez un parcours</option>');
                  var html = '<option value="" disabled="disabled" selected="selected">Choisissez un parcours</option>';
                  var i;
                  for(i=0; i<data.length; i++)
                    {
                      html += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'</option>';
                    }
                    html += '<option value="">Tous</option>';

                  $('[name="parcours"]').html(html);
                  reload_table();
         },
        error: function(){
          alert('erreur ajax');
        }
      });
      }
    });

    function reload_table()
    {
      table.ajax.reload(null,false); //reload datatable ajax 
    }

});