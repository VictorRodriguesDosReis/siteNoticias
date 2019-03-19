<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets');?>/css/home.css">

	<div class="container">
		<section id="principais-noticias">
			<?php 
				$i = 0;

				if (sizeof($principaisComImagem) >= 3) {
					foreach ($principaisComImagem as $noticiaComImagem) {
						$i++;

						if ($i == 1) {
			?>

					<div class="col-md-12">
						<div id="noticia-principal" style="background-image: url('<?php echo $noticiaComImagem['imagem'] ?>')">
							<div class="descricao-noticia">
							<h1>
								<a href="<?php echo base_url().'noticia/'.$noticiaComImagem['codigo'] ?>">
									<?php echo $noticiaComImagem['titulo'] ?>
								</a>
							</h1>
							<span><?php echo $noticiaComImagem['subtitulo'] ?></span>
							</div>
						</div>
					</div>

			<?php
						}
						else {
			?>
				
					<div class="col-md-12">
						<div class="noticia-sub-principal" style="background-image: url('<?php echo $noticiaComImagem['imagem'] ?>')">
							<div class="descricao-noticia">
							<h1>
								<a href="<?php echo base_url().'noticia/'.$noticiaComImagem['codigo'] ?>">
									<?php echo $noticiaComImagem['titulo'] ?>
								</a>
							</h1>
							<span><?php echo $noticiaComImagem['subtitulo'] ?></span>
							</div>
						</div>
					</div>

			<?php 
						}
					}
				}
			?>
		</section>
		
		<section class="row" id="secao-principal">
			<section class="col-md-7" id="noticias-recentes">
				<?php 
					$i = 0;
					foreach ($noticiasParciais as $noticia) {
						$i++;
				?>
					<div class="card-noticias" <?php if ($i == 8) echo 'id="load-news"'; ?>>
						<h3><a href="<?php echo base_url().'noticia/'.$noticia['codigo'] ?>"><?php echo $noticia['titulo'] ?></a></h3>
						<span><?php echo $noticia['subtitulo'] ?></span>
						<div class="data-noticia"><?php echo date('d/m/Y H:i:s', strtotime($noticia['data'])) ?></div>
					</div>

				<?php } ?>
			</section>

			<aside class="col-md-5" id="coluna-direita">
				<article class="noticias-destaque">
					<h3>Principais do Dia</h3>
					<?php 
					if (empty($principaisDia)) {
						echo '<div class="aviso-sem-noticias">Nenhuma notícia foi visualizada hoje.</div>';
					}
					else {
					foreach ($principaisDia as $noticiaDia) {
					?>
					<div>
						<h4><a href="<?php echo base_url().'noticia/'.$noticiaDia['codigo'] ?>"><?php echo $noticiaDia['titulo'] ?></a></h4>
						<span><?php echo $noticiaDia['subtitulo'] ?></span>
					</div>
					<?php }} ?>
				</article>
				<article class="noticias-destaque">
					<h3>Principais da Semana</h3>
					<?php 
					if (empty($principaisSemana)) {
						echo '<div class="aviso-sem-noticias">Nenhuma notícia foi visualizada esta semana.</div>';
					}
					else {
					foreach ($principaisSemana as $noticiaSemana) {
					?>
					<div>
						<h4><a href="<?php echo base_url().'noticia/'.$noticiaSemana['codigo'] ?>"><?php echo $noticiaSemana['titulo'] ?></a></h4>
						<span><?php echo $noticiaSemana['subtitulo'] ?></span>
					</div>
					<?php }} ?>
				</article>
				<article class="noticias-destaque">
					<h3>Principais do Mês</h3>
					<?php 
					if (empty($principaisMes)) {
						echo '<div class="aviso-sem-noticias">Nenhuma notícia foi visualizada este mês.</div>';
					}
					else {
					foreach ($principaisMes as $noticiaMes) {
					?>
					<div>
						<h4><a href="<?php echo base_url().'noticia/'.$noticiaMes['codigo'] ?>"><?php echo $noticiaMes['titulo'] ?></a></h4>
						<span><?php echo $noticiaMes['subtitulo'] ?></span>
					</div>
					<?php }} ?>
				</article>
			</aside>

		</section>
	</div>
	
	<script type="text/template" data-template="noticias-parciais">
        <div class="card-noticias" {{id-load}}>
			<h3><a href="{{url}}"> {{titulo}} </a></h3>
			<span> {{subtitulo}} </span>
			<div class="data-noticia"> {{data}} </div>
		</div>
    </script>
	<script type="text/javascript">
		var baseURL = '<?php echo base_url() ?>';
		var idUltimaNoticia = <?php echo $noticiasParciais[sizeof($noticiasParciais)-1]['codigo'] ?>;
	</script>
	<script type="text/javascript" src="<?php echo base_url('assets')?>/js/home.js"></script>
</body>
</html>