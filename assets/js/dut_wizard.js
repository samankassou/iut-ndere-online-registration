/*

$(function(){
	var form = $('#dut_wizard');
	form.steps({
		headerTag: "h4",
		bodyTag: "section",
		transitionEffect: "fade",
		enableAllSteps: false,
		transitionEffectSpeed: 500,
		labels: {
			finish: "Télécharger",
			next: "Suivant",
			previous: "Précédant"
		},
		onStepChanging: function (event, currentIndex, newIndex) {

			if ( newIndex === 1 ) {
				$('.steps ul').addClass('step-2');
			} else {
				$('.steps ul').removeClass('step-2');
			}
			if ( newIndex === 2 ) {
				$('.steps ul').addClass('step-3');
			} else {
				$('.steps ul').removeClass('step-3');
			}
			if ( newIndex === 3 ) {
				$('.steps ul').addClass('step-4');
			} else {
				$('.steps ul').removeClass('step-4');
			}
			if ( newIndex === 4 ) {
				$('.steps ul').addClass('step-5');
			} else {
				$('.steps ul').removeClass('step-5');
			}
			if ( newIndex === 5 ) {
				$('.steps ul').addClass('step-6');
			} else {
				$('.steps ul').removeClass('step-6');
			}

			if ( newIndex === 6 ) {
				$('.steps ul').addClass('step-7');
				$('.actions ul').addClass('step-last');
			} else {
				$('.steps ul').removeClass('step-7');
				$('.actions ul').removeClass('step-last');
			}
			return true;
		},
		onFinishing: function (event, currentIndex) {
			return true;
		},
		onFinished: function (event, currentIndex) {
			form.submit();
		}
	});
// Custom Steps Jquery Steps
$('.wizard > .steps li a').click(function(){
	$(this).parent().addClass('checked');
	$(this).parent().prevAll().addClass('checked');
	$(this).parent().nextAll().removeClass('checked');
});
// Custom Button Jquery Steps
$('.forward').click(function(){
	$("#dut_wizard").steps('Suivant');
})
$('.backward').click(function(){
	$("#dut_wizard").steps('Précédant');
})
// Checkbox
$('.checkbox-circle label').click(function(){
	$('.checkbox-circle label').removeClass('active');
	$(this).addClass('active');
})
})*/