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

        $('#admission').change(function()
				
			{
				var mode_admission = $(this).val();

				if (mode_admission == 'Concours')
					{
						var html = '<label>Langue de composition:</label>';
						html += '<select class="form-control" name="lang_comp">';
						html += '<option selected value="fr">Français</option>';
						html += '<option value="en">Anglais</option>';
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

				// Cas de la Mention Genie Biologique 
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
											html += '<select class="form-control" name="parcours1">';
											var i;
											for(i=0; i<data.length; i++)
												{
													html += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
												}
											html += '</select>';
											html += '</div>';
											html += '<div class="col-md-4">';
											html += '<label>2eme choix:</label>';
											html += '<select class="form-control" name="parcours2">';
											var i;
												for(i=0; i<data.length; i++)
													{
														if (i==1)
															 {
																html += '<option selected value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
															 }
														else
															 {
															  	html += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
															 }
							
													}
											html += '</select>';
											html += '</div>';
											html += '<div class="col-md-4">';
											html += '<label>3eme choix:</label>';
											html += '<select class="form-control" name="parcours3">';
											var i;
											for(i=0; i<data.length; i++)
												{
													if (i==2) 
														{
															html += '<option selected value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
														}
													else
														{
															html += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
														}
							
												}
												html += '</select>';
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
                 
                 // Cas de la mention  Genie Industriel et Maintenance
                else if(abrev_mention == 'GIM')
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
											html += '<select class="form-control" name="parcours1">';
											var i;
											for(i=0; i<data.length; i++)
												{
													html += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
												}
											html += '</select>';
											html += '</div>';
											html += '<div class="col-md-3">';
											html += '<label>2eme choix:</label>';
											html += '<select class="form-control" name="parcours2">';
											var i;
											for(i=0; i<data.length; i++)
												{
													if (i==1)
														 {
															html += '<option selected value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
								//i = i+1;
														 }
													else {
															html += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
														 }
							
												}
											html += '</select>';
											html += '</div>';
											html += '<div class="col-md-3">';
											html += '<label>3eme choix:</label>';
											html += '<select class="form-control" name="parcours3">';
											var i;
											for(i=0; i<data.length; i++)
												{
													if (i==2)
														 {
															html += '<option selected value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
								//i = i+1;
										   			 	 }
										   			else
										   			 	 {
															html += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
													 	 }
							
												}
											html += '</select>';
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
											html += '<select class="form-control" name="parcours">';
											var i;
											for(i=0; i<data.length; i++)
												{
													html += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
												}
											html += '</select>';
											$('#parcours').html(html);
										},
									error: function()
										{
											alert('erreur');
										}
								});
						}




			});


	}
);
