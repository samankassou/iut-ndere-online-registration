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

        



    
         /* Chargement des Parcours en fonctions des Mentions*/ 

		$('#mention').change(function()
			{
				var mention = $(this).val();
				var selection = $('#mention option:selected').text();
				var abrev_mention = selection.slice(selection.indexOf('(')+1, selection.indexOf(')'));
				var cycle = 'LITECH';

				// Cas des Mention ayant plusieurs Parcours
				 // Cas des Mention ayant un Parcours unique 
                 
                if (abrev_mention == 'GCD')
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
											html += '<select class="form-control" name="parcours1" id="parcours1">';
											html += '<option selected value="">--Parcours--</option>';
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
											var html = '<label class="control-label">Parcours par ordre de préférence:</label>';
											html += '<div class="row">';
											html += '<div class="col-md-6">';
											html += '<label>1er choix:</label>';
											html += '<select class="form-control" name="parcours1" id="parcours1">';
											html += '<option selected value="">--Parcours--</option>';
											var i;
											for(i=0; i<data.length; i++)
												{
													html += '<option value='+data[i].id_parcour+'>'+data[i].nom_parcour+'('+ data[i].abreviation_parcour +')</option>';
												}
											html += '</select>';
											html +='<span id="errorparcours1" class="errors text-danger"></span>'
											html += '</div>';
											var a ='';
											
											html += '<div class="col-md-6">';
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
											html +='<span id="errorparcours2" class="errors text-danger"></span>'
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


        $('#emploi').change(function()
				
			{
				var emploi = $(this).val();

				if (emploi == 'Oui')
					{
						alert(emploi);
						var html0 = '<label>Nom de votre Employeur:</label>';
						html0 += '<input  type="text" class="form-control" name="nom_employeur" id="nom_employeur">';
						html0 += '<span id="errornom_employeur" class="errors text-danger"></span>';
						var html2 = '<label>Responsabilité:</label>';
						html2 += '<input  type="text" class="form-control" name="poste" id="poste">';
						html2 += '<span id="errorposte" class="errors text-danger"></span>';
						$('#employeur').html(html0);
						$('#poste').html(html2);
					}

				if ((emploi== 'Non') || (emploi == ''))
						
					{
						


						$('#employeur').html('');
						$('#poste').html('');
					}
			});















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
