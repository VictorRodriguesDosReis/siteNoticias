<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/css/dashboard.css">

	<div class="container">
		<div class="row">
			<section class="col-md-8" id="cria-noticia">
				<form id="form-noticia" method="post">
					<div class="form-group">
						<label for="titulo">Título</label>
						<input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título">
					</div>
					<div class="form-group">
						<label for="subtitulo">Subtítulo</label>
						<textarea name="subtitulo" id="subtitulo" class="form-control" placeholder="Subtítulo"></textarea>
					</div>
					<div class="form-group">
						<label for="noticia">Notícia</label>
						<textarea name="noticia" id="noticia" class="form-control custom-theme" placeholder="Digite a notícia aqui..."></textarea>
					</div>

					<button type="submit" id='submit' class="btn">Publicar</button>
				</form>
			</section>
		</div>
	</div>
	
	<script type="text/javascript">
		var baseURL = '<?php echo base_url(); ?>';
	</script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/js/froala_editor.pkgd.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets')?>/js/dashboard.js"></script>
</body>
</html>