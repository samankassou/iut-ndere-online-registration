$(function()
	
	{

        /*Chargement des regions en fonctions de la nationalité selectionnée*/

		$('#nationalite').change(function()

			{
				var id_pays = $(this).val();
				$.ajax(
						  
					  {
						url: base_url + "registration/get_regions",
						type: 'post',
						data: {id_pays: id_pays},
						dataType: 'json',
						success: function(data)
								{	
									var html = '';
									var i;
									for(i=0; i<data.length; i++)
										{
											html += '<option value='+data[i].id_reg_or+'>'+data[i].nom_reg_or+'</option>';
										}
									$('#region').html(html);
								},
						error: function()
								{
									alert('erreur');
								}
					  });
			});

          /* Chargement de la langue de composition en fonction du mode d'admission*/

         $('#admission').change(function(){
			var mode_admission = $(this).val();

			if (mode_admission == 'Concours')
			{
				var html = '<label>Langue de composition:</label>';
				html += '<select class="form-control" name="lang_comp">';
				html += '<option selected value="Francais">Français</option>';
				html += '<option value="Anglais">Anglais</option>';
				html += '</select>';
				
				$('#lang_comp').html(html);
			}
			if ((mode_admission == 'Etude de dossier') || (mode_admission == ''))
			{
				$('#lang_comp').html('');
			}
		});
        


    
         /* Chargement des Parcours en fonctions des Mentions*/ 

		$('#mention').change(function()
			{
				var mention = $(this).val();
				var selection = $('#mention option:selected').text();
				var abrev_mention = selection.slice(selection.indexOf('(')+1, selection.indexOf(')'));
				var cycle = 'DUT';

				// Cas des Mention ayant plusieurs Parcours
				if (abrev_mention == 'GBIO') 
						{
							$.ajax(
								{
									url: base_url + "registration/get_parcours",
									type: 'post',
									data: {mention: mention, cycle: cycle},
									dataType: 'json',
									success: function(data)
										{
											var html = '<label class="control-label">Parcours par ordre de préférence:</label>';
											html += '<div class="row">';
											html += '<div class="col-md-4">';
											html += '<label>1er choix:</label>';
											html += '<select class="form-control" name="parcours1" id="parcours1">';
											html += '<option selected value="">--Parcours--</option>';
											var i;
											for(i=0; i<data.length; i++)
												{
													html += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
												}
											html += '</select>';
											html +=  '<span  id="errorparcours1" class="errors text-danger"></span>';
											html += '</div>';
											var a ='';
											
											html += '<div class="col-md-4">';
											html += '<label>2eme choix:</label>';
											html += '<select class="form-control" name="parcours2" id="parcours2">';
											html += '<option selected value="">--Parcours--</option>';
											var i;
											$(document).on('change','#parcours1',function()
											{
												a = $('#parcours1').val();
												var html2='<option selected value="">--Parcours--</option>';
												for(i=0; i<data.length; i++)
													{
														if (a!=data[i].id_parcour)
															 {
																html2 += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
															 }
							
													}
													$('#parcours2').html(html2);
											});
												
											html += '</select>';
											html +=  '<span  id="errorparcours2" class="errors text-danger"></span>';
											html += '</div>';
											var b ='';
											html += '<div class="col-md-4">';
											html += '<label>3eme choix:</label>';
											html += '<select class="form-control" name="parcours3" id="parcours3">';
											html += '<option selected value="">--Parcours--</option>';
											var i;
											$(document).on('change','#parcours2',function()
												{
													b = $('#parcours2').val();
													var html3='<option selected value="">--Parcours--</option>';
													for(i=0; i<data.length; i++)
														{
															if ((a!=data[i].id_parcour) && (b!=data[i].id_parcour))
																{
																	html3 += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
																}
							
														}
													$('#parcours3').html(html3);
												});
											html += '</select>';
											html += '</div>';
											html +=  '<span  id="errorparcours3" class="errors text-danger"></span>';
											html += '</div>';
											$('#parcours').html(html);
										},
									error: function()
										{
											alert('erreur');
										}
								});

						}
                


                // CAS DE GIM (4  CHOIX DE PARCOURS)

                
                else if (abrev_mention == 'GIM') 
						{
							$.ajax(
								{
									url: base_url + "registration/get_parcours",
									type: 'post',
									data: {mention: mention, cycle: cycle},
									dataType: 'json',
									success: function(data)
										{
											var html = '<label class="control-label">Parcours par ordre de préférence:</label>';
											html += '<div class="row">';
											html += '<div class="col-md-3">';
											html += '<label>1er choix:</label>';
											html += '<select class="form-control" name="parcours1" id="parcours1">';
											html += '<option selected value="">--Parcours--</option>';
											var i;
											for(i=0; i<data.length; i++)
												{
													html += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
												}
											html += '</select>';
											html +=  '<span  id="errorparcours1" class="errors text-danger"></span>';
											html += '</div>';
											var a ='';
											
											html += '<div class="col-md-3">';
											html += '<label>2eme choix:</label>';
											html += '<select class="form-control" name="parcours2" id="parcours2">';
											html += '<option selected value="">--Parcours--</option>';
											var i;
											$(document).on('change','#parcours1',function()
											{
												a = $('#parcours1').val();
												var html2='<option selected value="">--Parcours--</option>';
												for(i=0; i<data.length; i++)
													{
														if (a!=data[i].id_parcour)
															 {
																html2 += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
															 }
							
													}
													$('#parcours2').html(html2);
											});
												
											html += '</select>';
											html +=  '<span  id="errorparcours2" class="errors text-danger"></span>';
											html += '</div>';
											var b ='';
											html += '<div class="col-md-3">';
											html += '<label>3eme choix:</label>';
											html += '<select class="form-control" name="parcours3" id="parcours3">';
											html += '<option selected value="">--Parcours--</option>';
											var i;
											$(document).on('change','#parcours2',function()
												{
													b = $('#parcours2').val();
													var html3='<option selected value="">--Parcours--</option>';
													for(i=0; i<data.length; i++)
														{
															if ((a!=data[i].id_parcour) && (b!=data[i].id_parcour))
																{
																	html3 += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
																}
							
														}
													$('#parcours3').html(html3);
												});
											html += '</select>';
											html +=  '<span  id="errorparcours3" class="errors text-danger"></span>';
											html += '</div>';
											var c ='';
											html += '<div class="col-md-3">';
											html += '<label>4eme choix:</label>';
											html += '<select class="form-control" name="parcours4" id="parcours4">';
											html += '<option selected value="">--Parcours--</option>';
											var i;
											$(document).on('change','#parcours3',function()
												{
													c = $('#parcours3').val();
													var html4='<option selected value="">--Parcours--</option>';
													for(i=0; i<data.length; i++)
														{
															if ((a!=data[i].id_parcour) && (b!=data[i].id_parcour) && (c!=data[i].id_parcour))
																{
																	html4 += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
																}
							
														}
													$('#parcours4').html(html4);
												});
											html += '</select>';
											html +=  '<span  id="errorparcours4" class="errors text-danger"></span>';
											html += '</div>';
											html += '</div>';
											$('#parcours').html(html);
										},
									error: function()
										{
											alert('erreur');
										}
								});

						}



                 // Cas des Mention ayant un Parcours unique 
                 
                else
						{
							$.ajax(
								{
									url: base_url + "registration/get_parcours",
									type: 'post',
									data: {mention: mention, cycle: cycle},
									dataType: 'json',
									success: function(data)
										{
											var html = '<label>Parcours: </label>';
											html += '<div>';
											html += '<select class="form-control" name="parcours1" id="parcours1">';
											html += '<option selected value="">--Parcours--</option>';
											var i;
											for(i=0; i<data.length; i++)
												{
													html += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
												}
											html += '</select>';
											html +=  '<span  id="errorparcours1" class="errors text-danger"></span>';
											html += '</div>';
											$('#parcours').html(html);
										},
									error: function()
										{
											alert('erreur');
										}
								});
						}




			});


            // Chargement des Diplomes en fonction des Parcours choisis

           $(document).on('change','#parcours1',function()

			{
				var parcours1 = $('#parcours1').val();

				$.ajax(
						  
					  {
						url: base_url + "registration/get_diplome",
						type: 'post',
						data: {parcours1:parcours1},
						success: function(data)
								{	
									$('#diplome').html(data);
								},
						error: function()
								{
									alert('erreur');
								}
					  });
			});

/*
           $(document).on('click','.confirm',function()

			{
				swal(
						{
						  title: "Are you sure?",
						  text: "Once deleted, you will not be able to recover this imaginary file!",
						  icon: "warning",
						  buttons: true,
						  dangerMode: true,
						})
				.then((willDelete) => 

						{
							  if (willDelete) 
							  	{
								    swal("Poof! Your imaginary file has been deleted!", 
								    {
								      	icon: "success",
							    	});
							 	} 
							  else 
							  {
							    swal("Your imaginary file is safe!");
							  }

						});
			});

*/
          $('#btn-apercu').on('click', function () 
          	{
          		var form = $('form');
				var url = base_url + "registration/apercu";
				
				$.ajax({
							type: "POST"
							, data: form.serialize()
							, url: url
							, async: true
							, success: function (data) 
								{
									$('#apercu').html(data);
									return false;
								}
							, error: function ()
								 {
									alert('Une erreur est survenue');
									return false;
								 }
						});
			});







	}
);
