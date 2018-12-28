<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/css/home.css">

	<div class="container">
		<section id="principais-noticias">
			<div class="col-md-12">
				<div id="noticia-principal" style="background-image: url('https://picsum.photos/1000/1000/?random')">
					<div class="descricao-noticia">
					<h1>Lorem ipsum dolor sit amet, consectetur</h1>
					<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua.</span>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="noticia-sub-principal" style="background-image: url('https://picsum.photos/900/900/?random')">
					<div class="descricao-noticia">
					<h1>Lorem ipsum dolor sit amet, consectetur</h1>
					<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua.</span>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="noticia-sub-principal" style="background-image: url('https://picsum.photos/800/800/?random')">
					<div class="descricao-noticia">
					<h1>Lorem ipsum dolor sit amet, consectetur</h1>
					<span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua.</span>
					</div>
				</div>
			</div>
		</section>
		
		<section class="row" id="secao-principal">
			<section class="col-md-7" id="noticias-recentes">
				<?php 
					foreach ($noticiasParciais as $noticia) {
				?>
					<div class="card-noticias">
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
	
	<script type="text/javascript" src="<?php echo base_url('assets')?>/js/home.js"></script>
</body>
</html>