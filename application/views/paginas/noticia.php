<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/css/noticia.css">

<section class="container">
	<div class="row">
		<article class="col-md-8">
			<header>
				<h1 id="titulo">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.</h1>
				<span id="sub-titulo">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</span>
			</header>

			<div id="dados-publicacao">
				<p id="autor">Por Victor Rodrigues</p>
				<time>11/11/2011 11h11</time>
			</div>

			<div id="noticia">
				<figure>
					<img src="https://picsum.photos/1000/500/?random">
					<figcaption>Lorem ipsum dolor sit amet</figcaption>
				</figure>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

				<figure>
					<img src="https://picsum.photos/900/400/?random">
					<figcaption>Lorem ipsum dolor sit amet</figcaption>
				</figure>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
		</article>
		<aside class="col-md-4">
			<?php for ($i=0; $i < 5; $i++) { ?>
				<div class="noticias-destaque">
					<img src="https://picsum.photos/200/200/?random">
					<h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</h3>
				</div>
			<?php } ?>
		</aside>
	</div>

	<hr>

	<div class="row" id="div-comentarios">
		<div class="col-lg-9">
			<h2>12 Comentários</h2>

			<form>
				<div>
					<label for="nome">Nome</label>
					<input type="text" name="nome" id="nome" class="form-control" placeholder="Digite seu nome..." required>
				</div>
				<div class="form-group">
					<label for="comentario">Comentário</label>
					<textarea name="comentario" id="comentario" class="form-control" placeholder="Escreva um comentário..." required></textarea>
				</div>

				<button type="submit" class="btn">Enviar</button>
			</form>
			
			<hr>

			<?php for ($i=0; $i < 5; $i++) { ?>
				<div class="comentarios">
					<p class="autor-comentario">João dos Santos</p>
					<p class="texto-comentario">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.</p>
				</div>
			<?php } ?>

		</div>
	</div>
</section>