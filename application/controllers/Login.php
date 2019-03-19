<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('modelLogin');
		$this->verificaLogado();
	}

	public function index() {
		$data['hideCadastro'] = "style='display: none;'";
		$header['onLogin'] = 'active';

		$this->load->view('templates/headerPadrao', $header);
		$this->load->view('paginas/loginCadastro', $data);
	}

	/* Logar como autor */
	public function verificarConta() {
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|min_length[5]|max_length[254]|valid_email');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]|max_length[20]');

		if($this->form_validation->run()) {
			$resposta = $this->modelLogin->verificarConta($this->input->post());

			if(isset($resposta['codigo'])) {
				$data = array (
						'codigo' => $resposta['codigo'],
						'nome' => $resposta['nome'],
						'email' => $this->input->post('email'),
						'logado' => true
					);
					$this->session->set_userdata($data);

				echo 'success';
			}
			else
				echo 'error';
			
		}
		else {
			echo 'error';
		}
	}

	/* Verifica se o usuário já está logado, caso esteja ele não pode entrar nessa pagina */
	public function verificaLogado() {
		if ($this->session->userdata('logado'))
			redirect('usuario/dashboard');
	}

}


?>