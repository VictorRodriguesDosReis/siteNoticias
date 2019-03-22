$(document).ready(function() {

	$("#form-adiciona-noticia").submit(function(event) {
		event.preventDefault();

		var dados = $('#form-adiciona-noticia').serialize();

		$.post(baseURL+'usuario/dashboard/publicar-noticia', dados, function(resultado) {
			if (resultado == 'error')
				apresentaMenssagem('erroCadastro');
			else if (resultado == 'success')
				swal({
					title: 'Sucesso',
					text: 'A notícia foi publicada com sucesso',
					icon: 'success',
					button: 'Ok'
				}).then((a) => {
					window.location = baseURL+"usuario/dashboard";					
				});
			});
	});

	$('#titulo').on('input', function() {
		textoInputTitulo = $('#titulo').val();
		if(textoInputTitulo.trim().length > 0)
			$('#titulo-noticia').text(textoInputTitulo);
		else
			$('#titulo-noticia').text('Nova Notícia');
	});
});