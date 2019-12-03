<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Web News</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/css/header.css">

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-md">
			<div class="container">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".links-menu" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse links-menu" id="link-esquerda">
					<ul class="navbar-nav">
						<li class="nav-item <?php if (isset($onHome)) echo 'active' ?>">
							<a href="<?php echo base_url()?>home" class="nav-link">Home</a>
						</li>
						<li class="nav-item <?php if (isset($onNoticia)) echo 'active' ?>">
							<a href="#" class="nav-link">Notícia</a>
						</li>
					</ul>
				</div>

				<a class="navbar-brand" href="<?php echo base_url()?>home">
					Web News
				</a>

				<div class="collapse navbar-collapse links-menu" id="link-direita">
					<ul class="navbar-nav">
						<li class="nav-item <?php if (isset($onLogin)) echo 'active' ?>">
							<a href="<?php echo base_url()?>login" class="nav-link">Login</a>
						</li>
						<li class="nav-item <?php if (isset($onCadastro)) echo 'active' ?>">
							<a href="<?php echo base_url()?>cadastro" class="nav-link">Cadastro</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>