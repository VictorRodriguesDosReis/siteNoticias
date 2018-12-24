$(document).ready(function() {

	/* EVENTOS */
	$('#abri-login').click({abrir: 'login'}, mostrarDiv);
	$('#abri-cadastro').click({abrir: 'cadastro'}, mostrarDiv);
	
	$("#form-cadastro").submit(function(event) {
		event.preventDefault();

		var dados = $('#form-cadastro').serialize();
		$.post(baseURL+'cadastro/criar-conta', dados, function(resultado) {
			if (resultado == 'error')
				apresentaMenssagem('erroCadastro');
			else if (resultado == 'success')
				window.location = baseURL+"usuario/dashboard";
		});
	});

	$("#form-login").submit(function(event) {
		event.preventDefault();

		var dados = $('#form-login').serialize();
		$.post(baseURL+'login/verificar-conta', dados, function(resultado) {
			if (resultado == 'error')
				apresentaMenssagem('erroCadastro');
			else if (resultado == 'success')
				window.location = baseURL+"usuario/dashboard";
		});
	});

	/* FUNÇÕES */
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

});