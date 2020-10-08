// Script  formulaire inscription
/*
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
			
			
});
*/

// Custom Steps Jquery Steps

$(function () {
  $("form").submit(function () {
    $("[href='#finish']").hide();
  });
  var validat = "";
  var ajx = function (seri, furl) {
    $.ajax({
      type: "POST",
      data: seri,
      url: furl,
      async: false,
      success: function (data) {
        console.log(data);
        if (parseInt(data) === parseInt("1")) {
          validat = true;
        } else {
          var errors = JSON.parse(data);
          var err = Object.keys(errors);
          var ln = err.length;
          for (var i = 0; i < ln; i++) {
            $("#error" + err[i]).html(errors[err[i]]);
            $("#error" + err[i]).show();
          }
          validat = false;
        }
      },
      error: function () {
        alert("Une erreur est survenue");
        validat = false;
      },
    });
  };

  var form = $("#form_wizard");
  form.steps({
    headerTag: "h4",
    bodyTag: "section",
    transitionEffect: "fade",
    enableAllSteps: false,
    transitionEffectSpeed: 700,
    labels: {
      finish: "Télécharger",
      next: "Suivant",
      previous: "Précédant",
    },
    onStepChanging: function (event, currentIndex, newIndex) {
      // Permet un retour en Arrière meme si les champs de l'étape ne sont pas valides!
      if (currentIndex > newIndex) {
        return true;
      }

      if (currentIndex < newIndex) {
        if (currentIndex > -1) {
          var vurl = "";
          switch (currentIndex) {
            case 0:
              vurl = "validateInfoPerso1";
              $(".steps ul").addClass("step-1");

              break;

            case 1:
              $(".steps ul").addClass("step-2");
              vurl = "validateInfoPerso2";
              break;

            case 2:
              $(".steps ul").addClass("step-3");
              vurl = "validateFormation";
              break;

            case 3:
              $(".steps ul").addClass("step-4");
              vurl = "validateConcours";
              break;

            case 4:
              $(".steps ul").addClass("step-5");
              vurl = "validateCursus";
              break;
            case 5:
              $(".steps ul").addClass("step-6");
              vurl = "validatePaiement";
              break;

            case 6:
              $(".steps ul").addClass("step-7");
              $(".actions ul").addClass("step-last");

              break;
            default:
              vurl = "";
              break;
          }

          var furl = base_url + "registration/" + vurl;
          var seri = form.serialize(); //recupere tout les champs du formulaire;
          $(".errors").hide(); // cache les erreurs
          ajx(seri, furl);
          return validat;
        } else return true;
      }
    },
    onFinishing: function (event, currentIndex) {
      return true;
    },
    onFinished: function (event, currentIndex) {
      form.submit();
    },
  });

  $("#btn-apercu").on("click", function () {
    var form = $("form");
    var url = base_url + "registration/apercu";

    $.ajax({
      type: "POST",
      data: form.serialize(),
      url: url,
      async: true,
      success: function (data) {
        $("#apercu").html(data);
        return false;
      },
      error: function () {
        alert("Une erreur est survenue");
        return false;
      },
    });
  });

  $(".wizard > .steps li a").click(function () {
    $(this).parent().addClass("checked");
    $(this).parent().prevAll().addClass("checked");
    $(this).parent().nextAll().removeClass("checked");
  });
  // Custom Button Jquery Steps
  $(".forward").click(function () {
    $("#form_wizard").steps("Suivant");
  });
  $(".backward").click(function () {
    $("#form_wizard").steps("Précédant");
  });
  // Checkbox
  $(".checkbox-circle label").click(function () {
    $(".checkbox-circle label").removeClass("active");
    $(this).addClass("active");
  });
});
