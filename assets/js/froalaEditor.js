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
    }).on('froalaEditor.image.error', function (e, editor, error, response) {
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