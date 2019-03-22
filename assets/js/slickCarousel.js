$(document).ready(function() {

	$('#carrossel-imagens').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		dots: true,
		centerMode: true,
		focusOnSelect: true
	});

	// Verifica qual será o próximo slide no carrossel
	$('#carrossel-imagens').on('afterChange', function(event, slick, currentSlide) {
		atualizaImagemCapa(currentSlide);
	})
	.on('reInit', function(event, slick) {
		const slideSAtual = $('#carrossel-imagens').slick('slickCurrentSlide');
  		atualizaImagemCapa(slideSAtual);
	});

});

// Atualiza a imagem de capa
function atualizaImagemCapa(indexSlideAtual) {
	const urlImagemAtual = $('#carrossel-imagens div[data-slick-index = '+indexSlideAtual+']').find('img').attr('src');
	$('input[name="imagem-capa"]').val(urlImagemAtual);
}

function adicionaImagemCarrossel(urlNovaImagem) {
	const quantidadeImagensIgualNoSlide = $('#carrossel-imagens img[src="'+urlNovaImagem+'"]').parent('.slick-slide').length;
	const htmlNovaImagem = '<div><img src="'+ urlNovaImagem +'"></div>';

	if (quantidadeImagensIgualNoSlide == 0) {
		$('#carrossel-imagens').slick('slickAdd', htmlNovaImagem);
	}

}

function removerSlideCarrossel(urlImagem) {
	const quantidadeSlides = $('.slick-track').children().length;
	let slideSeraExcluido = '';

	if (quantidadeSlides <= 3)
		slideSeraExcluido = $('#carrossel-imagens img[src="'+urlImagem+'"]').parent('.slick-slide')[0];

	else
		slideSeraExcluido = $('#carrossel-imagens img[src="'+urlImagem+'"]').parent('.slick-slide')[1];

	const indexSlideSeraExcluido = $(slideSeraExcluido).attr('data-slick-index');

	$('#carrossel-imagens').slick('slickRemove', indexSlideSeraExcluido);
	$('#carrossel-imagens')[0].slick.refresh();
}

function trocarImagemCarrossel(imagemAntiga, imagemNova) {
	$('#carrossel-imagens img[src="'+imagemAntiga+'"]').attr('src', imagemNova);
}

function removerTodosSlidesCarrossel() {
	$('#carrossel-imagens').slick('removeSlide', null, null, true);
	$('#carrossel-imagens')[0].slick.refresh();
}

function submeterComoSlideAtual(urlImagem) {
	const quantidadeSlides = $('.slick-track').children().length;
	let slideSeraCentral = '';

	if (quantidadeSlides <= 3)
		slideSeraCentral = $('#carrossel-imagens img[src="'+urlImagem+'"]').parent('.slick-slide')[0];

	else
		slideSeraCentral = $('#carrossel-imagens img[src="'+urlImagem+'"]').parent('.slick-slide')[1];


	/*
		Dependendo de quantos slides tiverem no carrossel é preciso usar um tipo de estratégia pois,
		se usar o método 'slickGoTo' em um slide que tem menos de 4 slides, o carrossel quebra,
		e se usar a troca de classe em um carrossel que tem mais de 3 slides, o slide selecionado não fica centralizado.
	*/

	if (quantidadeSlides <= 3) {
		$('.slick-current').removeClass('slick-current slick-center');
		$(slideSeraCentral).addClass('slick-current slick-center');

	}
	else {
		const indexSlideSolicitado = $(slideSeraCentral).attr('data-slick-index');
		$('#carrossel-imagens').slick('slickGoTo', parseInt(indexSlideSolicitado));
	}

}