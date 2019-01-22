$(document).ready(function() {
	var templateNoticias = $('script[data-template="noticias-parciais"]').html();
	
	$('#principais-noticias > div > div').hover(
		function() {
			$(this).animate({
				backgroundSize: "130%"
			}, 450);
			$(this).clearQueue();

		},
		function() {
			$(this).animate({
				backgroundSize: "100%"
			}, 450);
			$(this).clearQueue();

		});

	$(window).scroll(function() {
		var hT = $('#load-news').offset().top,
		hH = $('#load-news').outerHeight(),
		wH = $(window).height(),
		wS = $(this).scrollTop();
		if (wS > (hT+hH-wH)){
			carregarNoticiasRecentes();
			$('#load-news').removeAttr('id');
		}
	});

	function carregarNoticiasRecentes() {
		$.get(baseURL+'carregar-mais-noticias', {posicao: idUltimaNoticia}, function(noticias){
			var lengthNoticias = noticias.length-1;
			idUltimaNoticia = noticias[lengthNoticias].codigo;
			noticias = JSON.parse(noticias);

			for (var i=0; i < lengthNoticias; i++) {
				var novaNoticia = templateNoticias;
				novaNoticia = i == lengthNoticias-1 ? novaNoticia.replace(/{{id-load}}/g, 'id="load-news"') : novaNoticia.replace(/{{id-load}}/g, '');
				novaNoticia = novaNoticia.replace(/{{url}}/g, baseURL+'noticia/'+noticias[i].codigo);
				novaNoticia = novaNoticia.replace(/{{titulo}}/g, noticias[i].titulo);
				novaNoticia = novaNoticia.replace(/{{subtitulo}}/g, noticias[i].subtitulo);
				novaNoticia = novaNoticia.replace(/{{data}}/g, noticias[i].data);

				$('#noticias-recentes').append(novaNoticia);
			}

		})
	}

});