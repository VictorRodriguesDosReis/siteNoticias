$(document).ready(function() {

	$("#form-noticia").submit(function(event) {
		event.preventDefault();

		var dados = $('#form-noticia').serialize();
		$.post(baseURL+'usuario/dashboard/publicar-noticia', dados, function(resultado) {
			if (resultado == 'error')
				apresentaMenssagem('erroCadastro');
			else if (resultado == 'success')
				alert('Noticia publicada com sucesso!')
		});
	});
 
    $('#noticia').froalaEditor({
      toolbarButtons: [
        'bold', 'italic', 'underline', 'strikethrought', 'paragraphFormat', 'insertLink', 'insertImage', 'formatOL',
        'formatUL', 'undo', 'redo', 'html'
      ],
      // Indica ao froala que terá um tema customizado
      theme: 'custom',

      // Remove o botão de quick insert
      quickInsertTags: [''],

      // Edita os botões dentro do dropdown da Imagem na toolbar
      imageInsertButtons: ['imageUpload', 'imageByURL'],

      // Set the image upload parameter.
      imageUploadParam: 'image',

      // Set the image upload URL.
      imageUploadURL: baseURL+'usuario/dashboard/upload-imagem',

      // Additional upload params.
      imageUploadParams: {id: 1},

      // Set request type.
      imageUploadMethod: 'POST',

      // Set max image size to 5MB.
      imageMaxSize: 5 * 1024 * 1024,

      // Allow to upload PNG and JPG.
      imageAllowedTypes: ['jpeg', 'jpg', 'png']
    })
    .on('froalaEditor.image.beforeUpload', function (e, editor, images) {
        // Return false if you want to stop the image upload.
      })
      .on('froalaEditor.image.uploaded', function (e, editor, response) {
        console.log(e)
        console.log(editor)
        console.log(response)
      })
      .on('froalaEditor.image.inserted', function (e, editor, $img, response) {
        // Image was inserted in the editor.
      })
      .on('froalaEditor.image.replaced', function (e, editor, $img, response) {
        console.log(e)
        console.log(editor)
        console.log($img)
        console.log(response)
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

});