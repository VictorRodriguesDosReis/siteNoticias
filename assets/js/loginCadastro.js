$(document).ready(function() {

	/* EVENTOS */
	$('#abri-login').click({abrir: 'login'}, mostrarDiv);
	$('#abri-cadastro').click({abrir: 'cadastro'}, mostrarDiv);
	
	function enviarFormularioCadastro() {
		event.preventDefault();
		var senha = $('#form-cadastro input[name=senha]').val();
		var senha_confirma = $('#form-cadastro input[name=confirma-senha]').val();

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
				}).then((a) => {
					window.location = baseURL+"usuario/dashboard";					
				});
			}
		});
	};

	function enviarFormularioLogin() {
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
	};



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



	/* VALIDAÇÕES DE CAMPO */
	$.validator.addMethod("email", function(value, element) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  		return regex.test(value);

	});

	$("#form-cadastro").validate({
		errorPlacement: function(error, element){
			element.next('.aviso').html(error);
		},
		submitHandler: function() {
			enviarFormularioCadastro()

		},
		rules: {
			nome: {
				required:true,
				minlength: 5,
				maxlength: 35        
			},
			email: {
				required: true,
				email: true,
				minlength: 5,
				maxlength: 254
			},
			senha: {
				required: true,
				minlength: 6,
				maxlength: 20
			},
			'confirma-senha': {
				required: true,
				equalTo: '#form-cadastro input[name="senha"]',			
			}
		},
		messages:{
			nome: {
				required: "O nome não pode ser vazio",
				maxlength: "O nome deve ter no máximo 35 caracteres",
				minlength: "O nome deve ter no mínimo 5 caracteres"
			},
			email: {
				required: "O e-mail não pode ser vazio",
				email: "Digite um e-mail válido",
				maxlength: "O e-mail deve ter no máximo 254 caracteres",
				minlength: "O e-mail deve ter no mínimo 5 caracteres"
			},
			senha: {
				required:"A senha não pode ser vazia",
				maxlength: "A senha deve ter no máximo 20 caracteres",
				minlength: "A senha deve ter no mínimo 6 caracteres"
			},
			'confirma-senha': {
				required:"A senha de confirmação não pode ser vazia",
				equalTo: "A senha de confirmação deve ser igual a senha digitada anteriormente"
			}
		}	
	});

	$("#form-login").validate({
		errorPlacement: function(error, element){
			element.next('.aviso').html(error);
		},
		submitHandler: function(){
			enviarFormularioLogin()

		},
		rules: {
			email: {
				required: true,
				email: true,
				minlength: 5,
				maxlength: 254
			},
			senha: {
				required: true,
				minlength: 6,
				maxlength: 20
			},
		},
		messages:{
			email: {
				required: "O e-mail não pode ser vazio",
				email: "Digite um e-mail válido",
				maxlength: "O e-mail deve ter no máximo 254 caracteres",
				minlength: "O e-mail deve ter no mínimo 5 caracteres"
			},
			senha: {
				required:"A senha não pode ser vazia",
				maxlength: "A senha deve ter no máximo 20 caracteres",
				minlength: "A senha deve ter no mínimo 6 caracteres"
			}
		}	
	});
});