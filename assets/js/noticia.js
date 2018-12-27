$(document).ready(function() {

	$('#form-comentario').submit(function(event) {
		event.preventDefault();

		var dados = $('#form-comentario').serialize();
		$.post(baseURL+'noticia/publicar-comentario', dados, function(resultado) {
			if(resultado == 'error')
				alert('Ocorreu um erro.');
			else if (resultado == 'success')
				alert('Comentário cadastrado !');
		});
	});

});