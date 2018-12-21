<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/css/loginCadastro.css">

	<section class="container">
		<div class="row">
			<div class="col-md-5 login-cadastro" id="div-login" <?php if (isset($hideLogin)) echo $hideLogin; ?>>
				<h1>Login</h1>

				<form method="POST">
					<div class="form-group">
						<label for="email">E-mail</label>
						<input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required>
					</div>
					<div class="form-group">
						<label for="senha">Senha</label>
						<input type="password" name="senha" class="form-control" id="senha" placeholder="Senha" required>
					</div>

					<button type="submit" class="btn">Entrar</button>
					<a href="" class="troca-div" id="abri-cadastro">Cadastrar-se</a>
				</form>

			</div>

			<div class="col-md-5 login-cadastro" id="div-cadastro" <?php if (isset($hideCadastro)) echo $hideCadastro; ?>>
				<h1>Cadastro</h1>

				<form method="POST">
					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" name="nome" class="form-control" id="nome" placeholder="Nome Completo" required>
					</div>
					<div class="form-group">
						<label for="email">E-mail</label>
						<input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required>
					</div>
					<div class="form-group">
						<label for="senha">Senha</label>
						<input type="password" name="senha" class="form-control" id="senha" placeholder="Senha" required>
					</div>
					<div class="form-group">
						<label for="confirma-senha">Confirmar senha</label>
						<input type="password" name="confirma-senha" class="form-control" id="confirma-senha" placeholder="Confirmar senha" required>
					</div>

					<button type="submit" class="btn">Criar conta</button>
					<a href="" class="troca-div" id="abri-login">Já possuo uma conta</a>
				</form>

			</div>
		</div>
	</section>

	<script type="text/javascript" src="<?php echo base_url('assets')?>/js/loginCadastro.js"></script>