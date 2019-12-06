$(document).ready(function() {

	function enviarFormularioComentario() {
		event.preventDefault();

		var dados = $('#form-comentario').serialize();
		$.post(baseURL+'noticia/publicar-comentario', dados, function(resultado) {
			if(resultado == 'error')
				swal({
					title: 'Erro ao enviar comentário',
					text: 'Não foi possível enviar seu comentário',
					icon: 'error',
					button: 'Ok'
				});
			else {
				let templateComentario = $('script[data-template="comentario"]').html();
				let quantidadeComentarios = $('#div-comentarios .comentarios').length;
				resultado = JSON.parse(resultado);

				$('#nome').val('');
				$('#comentario').val('');

				templateComentario = templateComentario.replace(/{{nomeLeitor}}/g, resultado.nomeLeitor);
				templateComentario = templateComentario.replace(/{{dataCriacao}}/g, resultado.dataCriacao);
				templateComentario = templateComentario.replace(/{{comentario}}/g, resultado.comentario);

				$('#div-comentarios .todos-comentarios').prepend(templateComentario);
				$('#div-comentarios h2').text(++quantidadeComentarios +' Comentários');

			}
		});
	};

	$("#form-comentario").validate({
		errorPlacement: function(error, element){
			element.next('.aviso').html(error);
		},
		submitHandler: function() {
			enviarFormularioComentario()

		},
		rules: {
			nome: {
				required:true,
				minlength: 2,
				maxlength: 20        
			},
			comentario: {
				required: true,
				minlength: 5,
				maxlength: 255
			}
		},
		messages:{
			nome: {
				required: "O nome não pode ser vazio",
				maxlength: "O nome deve ter no máximo 20 caracteres",
				minlength: "O nome deve ter no mínimo 2 caracteres"
			},
			comentario: {
				required: "O comentário não pode ser vazio",
				maxlength: "O comentário deve ter no máximo 255 caracteres",
				minlength: "O comentário deve ter no mínimo 5 caracteres"
			}
		}	
	});

});