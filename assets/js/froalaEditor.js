$(document).ready(function() {
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