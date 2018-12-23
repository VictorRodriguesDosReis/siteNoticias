<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/css/dashboard.css">

	<div class="container">
		<div class="row">
			<section class="col-md-8" id="cria-noticia">
				<form>
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
						<textarea name="noticia" id="noticia" class="form-control" placeholder="Digite a notícia aqui..."></textarea>
					</div>

					<button type="submit" class="btn">Publicar</button>
				</form>
			</section>
		</div>
	</div>

</body>
</html>