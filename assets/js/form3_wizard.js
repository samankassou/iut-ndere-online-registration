$(function()

	{

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
				if ( newIndex === 1 ) 
					{
						$('.steps ul').addClass('step-2');
					}
				else 
					{
						$('.steps ul').removeClass('step-2');
					}
				if ( newIndex === 2 ) 
					{
						$('.steps ul').addClass('step-3');
					}
				else
					{
						$('.steps ul').removeClass('step-3');
					}
				if ( newIndex === 3 ) 
					{
						$('.steps ul').addClass('step-4');
					}
				else
					 {
						$('.steps ul').removeClass('step-4');
					 }
				if ( newIndex === 4 ) 
					{
						$('.steps ul').addClass('step-5');
					} 
				else 
					{
						$('.steps ul').removeClass('step-5');
					}
				if ( newIndex === 5 ) 
					{
						$('.steps ul').addClass('step-6');
					} 
				else 
					{
						$('.steps ul').removeClass('step-6');
					}

				if ( newIndex === 6 ) 
					{
						$('.steps ul').addClass('step-7');
						$('.actions ul').addClass('step-last');
					} 
				else 
					{
						$('.steps ul').removeClass('step-7');
						$('.actions ul').removeClass('step-last');
					}
				return true;
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
