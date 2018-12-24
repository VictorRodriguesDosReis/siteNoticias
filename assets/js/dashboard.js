$(document).ready(function() {

	$("#form-noticia").submit(function(event) {
		event.preventDefault();

		var dados = $('#form-noticia').serialize();
		$.post(baseURL+'usuario/dashboard/publicar-noticia', dados, function(resultado) {
			if (resultado == 'error')
				apresentaMenssagem('erroCadastro');
			else if (resultado == 'success')
				alert('foi')
		});
	});

});