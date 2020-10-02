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

        $('#admission').change(function()
				
			{
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
				var cycle = 'BTS';                
						
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
								html +=  '<span  id="errorparcours1" class="errors text-danger"></span>';
								$('#parcours').html(html);
							},
						error: function()
							{
								alert('erreur');
							}
					});
			
			});


            // Chargement des Diplomes en fonction du Parcours choisi

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


          // $('#btn-apercu').on('click', function () 
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
