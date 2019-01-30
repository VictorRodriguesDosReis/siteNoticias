$(document).ready(function() {

	/* EVENTOS */
	$('#abri-login').click({abrir: 'login'}, mostrarDiv);
	$('#abri-cadastro').click({abrir: 'cadastro'}, mostrarDiv);
	
	$("#form-cadastro").submit(function(event) {
		event.preventDefault();
		var senha = $('#form-cadastro input[name=senha]').val();
		var senha_confirma = $('#form-cadastro input[name=confirma-senha]').val();

		console.log(senha, senha_confirma);

		if (senha != senha_confirma) {
			swal({
				title: 'Senhas estão diferentes',
				text: 'Por favor digite as senhas iguais',
				icon: 'warning',
				button: 'Ok'
			});
			return;
		}

		var dados = $('#form-cadastro').serialize();
		$.post(baseURL+'cadastro/criar-conta', dados, function(resultado) {
			if (resultado == 'error')
				swal({
					title: 'Conta Existente',
					text: 'Já existe uma conta com esse e-mail',
					icon: 'warning',
					button: 'Ok'
				});

			else if (resultado == 'success') {
				swal({
					title: 'Sucesso !',
					text: 'A conta foi criada com sucesso',
					icon: 'success',
					timer: 1500,
					button: 'Ok'
				});
				window.location = baseURL+"usuario/dashboard";
			}
		});
	});

	$("#form-login").submit(function(event) {
		event.preventDefault();

		var dados = $('#form-login').serialize();
		$.post(baseURL+'login/verificar-conta', dados, function(resultado) {
			if (resultado == 'error')
				swal({
					title: 'Erro ao tentar logar',
					text: 'E-mail ou senha digitada está incorreta',
					icon: 'error',
					button: 'Ok'
				});
			else if (resultado == 'success')
				window.location = baseURL+"usuario/dashboard";
		});
	});

	/* FUNÇÕES */
	function mostrarDiv(event) {
		event.preventDefault();
		history.pushState("data", "", event.data.abrir);

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