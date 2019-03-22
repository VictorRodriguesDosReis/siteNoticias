<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
<link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/css/dashboard.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/css/froalaEditor.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/css/slickCarousel.css">

<div class="container">
	<div class="row">
		<div class="card-noticias" id="nova-noticia">
			<h3><a href="<?php echo base_url().'usuario/nova-noticia' ?>">Adicionar nova notícia</a></h3>
		</div>

		<?php 
		$i = 0;
		foreach ($noticias as $noticia) {
			$i++;
			?>
			<div class="card-noticias row" <?php if ($i == 8) echo 'id="load-news"'; ?>>
				<div class="informacao-noticia col-sm-10">
					<h3 class="titulo"><a href="<?php echo base_url().'noticia/'.$noticia['codigo'] ?>"><?php echo $noticia['titulo'] ?></a></h3>
					<span class="subtitulo"><?php echo $noticia['subtitulo'] ?></span>
					<div class="data-noticia"><?php echo date('d/m/Y H:i:s', strtotime($noticia['data'])) ?></div>
				</div>

				<div class="col-sm-1 editar-excluir"><a href="#" class="fas fa-pencil-alt btn-editar"></a></div>
				<div class="col-sm-1 editar-excluir"><a href="#" class="fas fa-times btn-excluir"></a></div>

				<input type="hidden" name="codigo-noticia" value="<?php echo $noticia['codigo'] ?>">
			</div>

		<?php } ?>
	</div>

	<div class="modal fade" id="modal-editar" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editar Noticia</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<form id="form-edita-noticia" method="post">
						<div class="form-group">
							<label for="titulo">Título</label>
							<input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título" value="">
						</div>
						<div class="form-group">
							<label for="subtitulo">Subtítulo</label>
							<textarea name="subtitulo" id="subtitulo" class="form-control" placeholder="Subtítulo" value=""></textarea>
						</div>
						<div class="form-group">
							<label for="noticia">Notícia</label>
							<textarea name="noticia" id="noticia" class="form-control custom-theme" placeholder="Digite a notícia aqui..." value=""></textarea>
						</div>
						<div class="form-group">
							<label>Imagem de Capa</label>
							<div id="carrossel-imagens">
							</div>
							<input type="hidden" name="imagem-capa">
						</div>

						<input id="codigo-noticia" type="hidden" name="codigo-noticia">

						<button type="submit" id='submit' class="btn">Publicar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var baseURL = '<?php echo base_url(); ?>';
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/js/froala_editor.pkgd.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets')?>/js/dashboard.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets')?>/js/froalaEditor.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets')?>/js/slickCarousel.js"></script>
</body>
</html>