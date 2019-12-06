$(document).ready(function() {	
	// Validação dos campos do formulário
	var validator = $("#form-adiciona-noticia, #form-edita-noticia").validate({
		errorPlacement: function(error, element){
			element.next('.aviso').html(error);
		},
		submitHandler: function(form){
			var formId = $(form).attr('id');

			if (formId == 'form-adiciona-noticia')
				enviarFormularioAdiciona()

			if (formId == 'form-edita-noticia')
				enviarFormularioEdita()

		},
		rules: {
			titulo: {
				required:true,
				minlength: 10,
				maxlength: 100        
			},
			subtitulo: {
				minlength: 10,
				maxlength: 250     
			},
			noticia: {
				required: true,
				minlengthwithoutHTML: 10
			}
		},
		messages:{
			titulo: {
				required: "O título não pode ser vazio",
				maxlength: "O título deve ter no máximo 100 caracteres",
				minlength: "O título deve ter no mínimo 10 caracteres"
			},
			subtitulo: {
				maxlength: "O subtítulo deve ter no máximo 250 caracteres",
				minlength: "O subtítulo deve ter no mínimo 10 caracteres"
			},
			noticia: {
				required:"A notícia não pode ser vazio",
				minlengthwithoutHTML: "A notícia deve ter no mínimo 10 caracteres"
			}
		}	
	});

	$.validator.addMethod("minlengthwithoutHTML", function(value, element, param) {
		return $(value).text().length >= param;
	});

	function enviarFormularioAdiciona() {
		event.preventDefault();

		var dados = $('#form-adiciona-noticia').serialize();

		$.post(baseURL+'usuario/dashboard/publicar-noticia', dados, function(resultado) {
			if (resultado == 'error')
			swal({
				title: 'Erro',
				text: 'Ocorreu um erro no envio dos dados',
				icon: 'error',
				button: 'Ok'
			})
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
	}

	function enviarFormularioEdita() {
		event.preventDefault();

		var dados = $('#form-edita-noticia').serialize();

		$.post(baseURL+'usuario/dashboard/editar-noticia', dados, function(resultado) {
			if (resultado == 'error')
				swal({
					title: 'Erro na edição',
					text: 'Não foi possivel realizar a modificação, por favor tente novamente',
					icon: 'warning',
					button: 'Ok'
				});

			else {
				const novosDados = JSON.parse(resultado);

				atualizarNoticia(novosDados);

				$('#modal-editar').modal('hide');

				swal({
					title: 'Modificação realizada',
					text: 'Edição realizada com sucesso !',
					icon: 'success',
					button: 'Ok'
				});
			}
		});
	}

	function atualizarNoticia(dados) {
		const titulo = dados['titulo'];
		const subtitulo = dados['subtitulo'];
		const data = dados['dataEdicao'];
		
		elementoAtual.find('.titulo a').text(titulo);
		elementoAtual.find('.subtitulo').text(subtitulo);
		elementoAtual.find('.data-noticia').text(data);
	}

  $('#noticia').froalaEditor({
    toolbarButtons: [
    'bold', 'italic', 'underline', 'strikethrought', 'paragraphFormat', 'insertLink', 'insertImage', 'formatOL',
    'formatUL', 'undo', 'redo', 'html'
    ],
      // Indica ao froala que terá um tema customizado
      theme: 'custom',

      // Remove o botão de quick insert
      quickInsertTags: [''],

      // Set the load images request URL.
      imageManagerLoadURL: baseURL+"usuario/dashboard/carregar-imagens",

      // Set the load images request type.
      imageManagerLoadMethod: "GET",

      // Set the delete image request URL.
      imageManagerDeleteURL: baseURL+"usuario/dashboard/deletar-imagem",

      // Set the delete image request type.
      imageManagerDeleteMethod: "DELETE",

      // Set the image upload URL.
      imageUploadURL: baseURL+'usuario/dashboard/upload-imagem',

      // Set request type.
      imageUploadMethod: 'POST',

      // Set max image size to 5MB.
      imageMaxSize: 5 * 1024 * 1024,

      // Allow to upload PNG and JPG.
      imageAllowedTypes: ['jpeg', 'jpg', 'png']
    })

    $('#noticia').on('froalaEditor.image.inserted', function (e, editor, $img, response) {
      const urlImagemInserida = $img[0].src;

      if (verificaQuantidadeImagem(urlImagemInserida) == 1)
        adicionaImagemCarrossel(urlImagemInserida);

    })
    .on('froalaEditor.image.replaced', function (e, editor, $img, response) {
      const imagemAntiga = $img['prevObject'][0].src;
      const imagemNova = $img[0].src;

      if (verificaQuantidadeImagem(imagemAntiga) == 0) {
        if (verificaQuantidadeImagem(imagemNova) == 1)
          trocarImagemCarrossel(imagemAntiga, imagemNova);

        else
          removerSlideCarrossel(imagemAntiga);
        
      }

      else {
        if (verificaQuantidadeImagem(imagemNova) == 1) 
          adicionaImagemCarrossel(imagemNova);

      }

    })
    .on('froalaEditor.image.beforeRemove', function (e, editor, $img) {
      const urlImagemSeraRemovida = $img[0].src;
      if (verificaQuantidadeImagem(urlImagemSeraRemovida) == 1)
        removerSlideCarrossel(urlImagemSeraRemovida);

    })
    .on('froalaEditor.contentChanged', function () {
      validator.element("#noticia");

    })
    .on('froalaEditor.image.error', function (e, editor, error, response) {
        // Bad link.
        /*if (error.code == 1) { ... }
 
        // No link in upload response.
        else if (error.code == 2) { ... }
 
        // Error during image upload.
        else if (error.code == 3) { ... }
 
        // Parsing response failed.
        else if (error.code == 4) { ... }
 
        // Image too text-large.
        else if (error.code == 5) { ... }
 
        // Invalid image type.
        else if (error.code == 6) { ... }
 
        // Image can be uploaded only to same domain in IE 8 and IE 9.
        else if (error.code == 7) { ... }
 
          // Response contains the original server response to the request if available;*/
      });

    function verificaQuantidadeImagem(urlImagem) {
      const expressaoRegular = new RegExp(urlImagem, "g")
      const ocorrenciasImagem = $('.fr-element').html().match(expressaoRegular);

      if (ocorrenciasImagem != null)
        return ocorrenciasImagem.length;

      else
        return 0;
    }
  });