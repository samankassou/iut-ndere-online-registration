var save_method; //ajout ou mise a jour
var table;

$(document).ready(function() {

    //datatables
    table = $('#users_table').DataTable({ 

        "language": {
            url: base_url + "assets/js/French.json"//pour le datatable en francais
        },
        responsive: true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": base_url + "accounts/ajax_list",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
                "targets": [ 0 ], //first column
                "orderable": false, //set not orderable
            },
            { 
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },
            { 
                "targets": [ -2 ], //last column
                "orderable": false, //set not orderable
            },
            { 
                "targets": [ -3 ], //2 last column (photo)
                "orderable": false, //set not orderable
            },
            { 
                "targets": [ -4 ], //2 last column (photo)
                "orderable": false, //set not orderable
            }
            ],

        });


    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).removeClass('is-invalid');
        $(this).prev().removeClass('text-danger');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).removeClass('is-invalid');
        $(this).prev().removeClass('text-danger');
        $(this).next().empty();
    });

});



function add_user()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#password-zone').show(); // show password input by default
    $('.psw_check').hide();// hide checkbox for change password update
    $('#password-zone').before('<input class="test" type="hidden" name="change_psw" value="yes" />');//add change_psw variable
    $('.help-block').empty(); // clear error string
    $('label').removeClass('text-danger');//remove red color from label
    $('input, select').removeClass('is-invalid');
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Ajouter un utilisateur'); // Set Title to Bootstrap modal title

    $('#photo-preview').hide(); // hide photo preview modal

    $('#label-photo').text('Choisir photo'); // label photo upload
}

function edit_user(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.psw_check').show();//show change password for update
    $('.test').remove('');//remove change_psw variable
    $('input, select').removeClass('is-invalid');
    $('label').removeClass('text-danger');//remove red color from label
    $('#password-zone').hide(); // hide password input by default
    $('.form-group').removeClass('error'); // clear error class
    $('.help-block').empty(); // clear error string


    //Ajax Load data from ajax
    $.ajax({
        url : base_url + "accounts/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id_user);
            $('[name="firstname"]').val(data.firstname);
            $('[name="lastname"]').val(data.lastname);
            $('[name="email"]').val(data.email);
            $('[name="role"]').val(data.role);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Modifier un utilisateur'); // Set title to Bootstrap modal title

            $('#photo-preview').show(); // show photo preview modal

            if(data.photo)
            {
                $('#label-photo').text('Changer de Photo'); // label photo upload
                $('#photo-preview div').html('<img width="50" height="50" src="'+base_url+'assets/img/profiles/'+data.photo+'" class="img-responsive">'); // show photo
                $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+data.photo+'"/> Supprimer la photo'); // remove photo

            }
            else
            {
                $('#label-photo').text('Choisir Photo'); // label photo upload
                $('#photo-preview div').text('(Pas de photo)');
            }


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Erreur dans l\'appel ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('enregistrement...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = base_url + "accounts/ajax_add/";
    } else {
        url = base_url + "accounts/ajax_update/";
    }

    // ajax adding data to database

    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {

                swal.fire({
                    title: 'Enregistrement',
                    text: 'Effectué',
                    icon: 'success',
                    timer: 2000
                });
                
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid'); //select parent twice to select div form-group class and add has-error class

                    if (data.inputerror[i] == 'photo')
                    {
                        $('[name="'+data.inputerror[i]+'"]').closest('.form-group').child('label').addClass('text-danger');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                    else
                    {

                        $('[name="'+data.inputerror[i]+'"]').prev().addClass('text-danger');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string

                    }
                }
            }
            $('#btnSave').text('Enregistrer'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Erreur d\'ajout / modification');
            $('#btnSave').text('Enregistrer'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}



function delete_user(id)
{
    session_id = function(){
        return $('#session_id').attr('session_id');
    }
    console.log(session_id);

    Swal.fire({
      title: 'Etes vous sûr?',
      text: 'Cette action est irréversible!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Oui, supprimer!',
      cancelButtonText: 'Non, Annuler!'
  }).then((result) => {

    if (id == session_id) {
        Swal.fire(
          'Suppression',
          'Vous ne pouvez pas supprimer le compte actif!',
          'error'
          )
        return;
    }
    else
    {
        if (result.value) {
            $.ajax({
              url: base_url + 'accounts/ajax_delete/' + id,
              success: function(data){
                Swal.fire({
                  title: 'Suppression',
                  text: 'Suppression effectué!',
                  icon: 'success',
                  timer: 2000
              });
                reload_table();
            },
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
    }
})
}

// on or off user account
function unset_user(id)
{

   Swal.fire({
      title: 'Etes vous sûr?',
      text: 'Cette action est irréversible!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Oui',
      cancelButtonText: 'Non, Annuler!'
  }).then((result) => {
      if (result.value) {
        $.ajax({
          url: base_url + 'accounts/ajax_unset/' + id,
          success: function(data){
            Swal.fire({
              title: 'Statut!',
              text: 'L\'utilasateur a été activé\\désactivé',
              icon: 'success',
              timer: 2000
          });
            reload_table();
        },
        error: function(){
          alert('erreur ajax');
      }
  });
    } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire("Annulé", "Activation/Désactivation annulée", "error");
    }
});
}

//show or hide password zone

function psw_zone()
{
    if($('[name="change_psw"]').is(':checked')){

        $('#password-zone').fadeIn(1500);
        $('#password-zone').val('yes'); 
    }else{
        $('#password-zone').fadeOut(1500); 
        $('#password-zone').val('no'); 
    }
    
}
