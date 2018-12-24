<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('modelCadastro');
		$this->verificaLogado();
	}

	public function index() {
		$header['onCadastro'] = "active";
		$data['hideLogin'] = "style='display: none;'";

		$this->load->view('templates/headerPadrao', $header);
		$this->load->view('paginas/loginCadastro', $data);
	}

	/* Cria a conta de Autor */
	public function criarConta() {
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[5]|max_length[35]');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|required|min_length[5]|max_length[254]|valid_email|is_unique[tb_autor.ds_email]');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]|max_length[20]');
		$this->form_validation->set_rules('confirma-senha', 'Senha de Confirmação', 'trim|required|matches[senha]');

		if($this->form_validation->run()) {
			$resposta = $this->modelCadastro->insertUsuario($this->input->post());

			if(isset($resposta['codigo'])) {
				$data = array (
						'codigo' => $resposta['codigo'],
						'nome' => $this->input->post('nome'),
						'email' => $this->input->post('email'),
						'logado' => true
					);
					$this->session->set_userdata($data);

				echo 'success';
			}
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