<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/css/noticia.css">

<section class="container">
	<div class="row">
		<article class="col-md-8">
			<header>
				<h1 id="titulo"><?php echo $noticia['titulo']; ?></h1>
				<span id="sub-titulo"><?php echo $noticia['subtitulo'] ?></span>
			</header>

			<div id="dados-publicacao">
				<p id="autor"><?php echo htmlspecialchars($noticia['autor'], ENT_QUOTES, 'UTF-8'); ?></p>
				<time><?php 
					echo date('d/m/Y H:i:s', strtotime($noticia['dt_criacao'])); 
					if ($noticia['dt_criacao'] != $noticia['dt_alteracao'])
						echo ' - atualizado '.date('d/m/Y H:i:s', strtotime($noticia['dt_criacao']));
					?></time>
			</div>

			<div id="noticia">
				<?php echo $noticia['noticia']; ?>
			</div>
		</article>
		<aside class="col-md-4">
			<?php foreach ($noticiasRecentes as $noticia) { ?>
				<div class="noticias-destaque">
					<img src="<?php echo $noticia['imagem']?>">
					<h3><a href="<?php echo base_url().'noticia/'.$noticia['codigo'] ?>">
						<?php echo $noticia['titulo'] ?>
					</a></h3>
				</div>
			<?php } ?>
		</aside>
	</div>

	<hr>

	<div class="row" id="div-comentarios">
		<div class="col-lg-9">
			<h2><?php echo count($comentarios); ?> Comentários</h2>

			<form id="form-comentario" method="post">
				<div class="form-group">
					<label for="nome">Nome</label>
					<input type="text" name="nome" id="nome" class="form-control" placeholder="Digite seu nome..." maxlength="20" required>
					<small class="form-text text-muted aviso"></small>
				</div>
				<div class="form-group">
					<label for="comentario">Comentário</label>
					<textarea name="comentario" id="comentario" class="form-control" placeholder="Escreva um comentário..." maxlength="250" required></textarea>
					<small class="form-text text-muted aviso"></small>
				</div>
				<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">

				<button type="submit" class="btn">Enviar</button>
			</form>
			
			<hr>
			
			<div class="todos-comentarios">
			<?php foreach ($comentarios as $comentario) { ?>
				<div class="comentarios">
					<p class="autor-comentario"><?php echo $comentario['leitor']; ?></p>
					<p class="data-comentario"><?php echo date('d/m/Y H:i:s', strtotime($comentario['dt_criacao'])); ?></p>
					<p class="texto-comentario"><?php echo $comentario['comentario']; ?></p>
				</div>
			<?php } ?>
			</div>

		</div>
	</div>
</section>

<script type="text/javascript">
	var baseURL = '<?php echo base_url() ?>';
</script>
<script type="text/template" data-template="comentario">
    <div class="comentarios">
		<p class="autor-comentario">{{nomeLeitor}}</p>
		<p class="data-comentario">{{dataCriacao}}</p>
		<p class="texto-comentario">{{comentario}}</p>
	</div>
</script>
<script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets')?>/js/noticia.js"></script>