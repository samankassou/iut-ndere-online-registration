
/* Script  formulaire inscription*/
$(function()
{
	var validat = "";
	var ajx = function (seri, furl) {
		$.ajax({
			type: "POST"
			, data: seri
			, url: furl
			, async: false
			, success: function (data) {
				console.log(data);
				if (parseInt(data) === parseInt("1")) {
					validat = true;
				}
				else {
					var errors = JSON.parse(data);
					var err = Object.keys(errors);
					var ln = err.length;
					for (var i = 0; i < ln; i++) {
						$('#error' + err[i]).html( errors[err[i]]);
						$('#error' + err[i]).show();
					}
					validat = false;
				}
			}
			, error: function () {
				alert('Une erreur est survenue');
				validat = false;
			}
		})
	};
	var form = $('#form_wizard');
	form.steps(
	{
		headerTag: "h4",
		bodyTag: "section",
		transitionEffect: "fade",
		enableAllSteps: false,
		transitionEffectSpeed: 700,
		labels: 
		{
			finish: "Télécharger",
			next: "Suivant",
			previous: "Précédant"
		},
		onStepChanging: function(event, currentIndex, newIndex)
		{
			if (currentIndex > newIndex) {
				return true;
			}
			if (currentIndex < newIndex) {
				if (currentIndex > -1) {
					var vurl = "";
					switch (currentIndex) {
						case 0:
						$('.steps ul').addClass('step-1');
						vurl = "validateInfoPerso";
						break;
						case 1:
						$('.steps ul').addClass('step-2');
						vurl = "validateInfoPerso";
						break;
						case 2:
						$('.steps ul').addClass('step-3');
						vurl = "validateFormation";
						break;
						case 3:
						$('.steps ul').addClass('step-4');
						vurl = "validateDiplome";
						break;
						case 4:
						$('.steps ul').addClass('step-5');
						vurl = "validateAddPerso";
						break;
						case 5:
						$('.steps ul').addClass('step-6');
						vurl = "validateCursus";
						break;
						case 6:
						$('.steps ul').addClass('step-7');
						$('.actions ul').addClass('step-last');
						vurl = "validateAddParents";
						break;
						case 7:
						vurl = "validatePaiement";
						break;
						default:
						vurl = "form";
						break;
					}
					var furl = base_url + "registration" + "/" + vurl;
					var seri = form.serialize();
					$('.errors').hide();
					ajx(seri, furl);
					return validat;
				}
			}
			else return true;
			
		},
		onFinishing: function (event, currentIndex) 
		{
			return true;
		},
		onFinished: function (event, currentIndex) 
		{
			form.submit();
		}
	});
			// Custom Steps Jquery Steps
			$('.wizard > .steps li a').click(function()
			{
				$(this).parent().addClass('checked');
				$(this).parent().prevAll().addClass('checked');
				$(this).parent().nextAll().removeClass('checked');
			});
			// Custom Button Jquery Steps
			$('.forward').click(function()
			{
				$("#form_wizard").steps('Suivant');
			})
			$('.backward').click(function()
			{
				$("#form_wizard").steps('Précédant');
			})
			// Checkbox
			$('.checkbox-circle label').click(function()
			{
				$('.checkbox-circle label').removeClass('active');
				$(this).addClass('active');
			})	
		});