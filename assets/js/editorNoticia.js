var urlImagensNoticia = [];

$(document).ready(function() {

	$("#form-adiciona-noticia").submit(function(event) {
		event.preventDefault();

		var dados = $('#form-adiciona-noticia').serialize();
		dados += '&imagens='+urlImagensNoticia;

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

	// Eventos do Froala Editor
	$('#noticia').on('froalaEditor.image.inserted', function (e, editor, $img, response) {
		urlImagensNoticia.push($img[0].src);

	})
	.on('froalaEditor.image.replaced', function (e, editor, $img, response) {
		let imagemAntiga = $img['prevObject'][0].src;
		let imagemNova = $img[0].src;
		let indexImagemAntigaNoArray = urlImagensNoticia.indexOf(imagemAntiga);

		urlImagensNoticia.splice(indexImagemAntigaNoArray, 1, imagemNova);

	})
	.on('froalaEditor.image.beforeRemove', function (e, editor, $img) {
		let indexImagemNoArray = urlImagensNoticia.indexOf($img[0].src);
		urlImagensNoticia.splice(indexImagemNoArray, 1);

	});
});