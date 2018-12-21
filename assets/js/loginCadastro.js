$(document).ready(function() {
	
	function mostrarDiv(event) {
		event.preventDefault();
		history.pushState("data", "", event.data.abrir);

		console.log(event.data.abrir);

		if (event.data.abrir == "login") {
			$('#div-login').css('z-index', 0);
			$('#div-login').fadeIn(1500);
		}
		else {
			$('#div-cadastro').css('z-index', 0);
			$('#div-cadastro').fadeIn(1500);
		}

		var div = $(this).closest('.login-cadastro');
		div.fadeOut(1000);
		div.css('z-index', 1);

	}

	$('#abri-login').click({abrir: 'login'}, mostrarDiv);
	$('#abri-cadastro').click({abrir: 'cadastro'}, mostrarDiv);

});