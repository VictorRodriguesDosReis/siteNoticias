$(document).ready(function() {

	$('#form-comentario').submit(function(event) {
		event.preventDefault();

		var dados = $('#form-comentario').serialize();
		$.post(baseURL+'noticia/publicar-comentario', dados, function(resultado) {
			if(resultado == 'error')
				alert('Ocorreu um erro.');
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
	});

});