$(document).ready(function() {

	$('#titulo').on('input', function() {
		textoInputTitulo = $('#titulo').val();
		if(textoInputTitulo.trim().length > 0)
			$('#titulo-noticia').text(textoInputTitulo);
		else
			$('#titulo-noticia').text('Nova Notícia');
	});
});