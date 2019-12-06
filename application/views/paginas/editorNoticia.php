<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/css/editorNoticia.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/css/froalaEditor.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/css/slickCarousel.css">

	<div class="container">
		<div class="row">
			<section class="col-md-8" id="cria-noticia">
				<h2 id="titulo-noticia">Nova Notícia</h2>

				<form id="form-adiciona-noticia" method="post">
					<div class="form-group">
						<label for="titulo">Título</label>
						<input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título" value="<?php if (isset($noticia)) echo $noticia['titulo'];?>">
						<small id="aviso-titulo" class="form-text text-muted aviso"></small>
					</div>
					<div class="form-group">
						<label for="subtitulo">Subtítulo</label>
						<textarea name="subtitulo" id="subtitulo" class="form-control" placeholder="Subtítulo" value="<?php if (isset($noticia)) echo $noticia['subtitulo'];?>"></textarea>
						<small id="aviso-subtitulo" class="form-text text-muted aviso"></small>
					</div>
					<div class="form-group">
						<label for="noticia">Notícia</label>
						<textarea name="noticia" id="noticia" class="form-control custom-theme" placeholder="Digite a notícia aqui..." value="<?php if (isset($noticia)) echo $noticia['titulo'];?>"></textarea>
						<small id="aviso-noticia" class="form-text text-muted aviso"></small>
					</div>
					<div class="form-group">
						<label>Imagem de Capa</label>
						<div id="carrossel-imagens">
						</div>
						<input type="hidden" name="imagem-capa">
					</div>

					<button type="submit" id='submit' class="btn">Publicar</button>
				</form>
			</section>
		</div>
	</div>
	
	<script type="text/javascript">
		var baseURL = '<?php echo base_url(); ?>';
	</script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/js/froala_editor.pkgd.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets')?>/js/editorNoticia.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets')?>/js/formularioNoticia.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets')?>/js/slickCarousel.js"></script>
</body>
</html>