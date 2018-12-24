<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('modelDashboard');
		$this->verificarLogin();
	}

	public function index() {
		$data = array(
			'nomeUsuario' => $this->session->userdata('nome')
		);

		$this->load->view('templates/headerLogado', $data);
		$this->load->view('paginas/dashboard');

	}

	public function publicarNoticia() {
		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|min_length[10]|max_length[100]');
		$this->form_validation->set_rules('subtitulo', 'Subtítulo', 'trim|min_length[10]|max_length[250]');
		$this->form_validation->set_rules('noticia', 'Noticia', 'trim|required|min_length[10]');

		if($this->form_validation->run()) {
			$data = array(
				'titulo' => $this->input->post('titulo'),
				'subtitulo' => $this->input->post('subtitulo'),
				'noticia' => $this->input->post('noticia'),
				'codigo' => $this->session->userdata('codigo'),
			);

			$this->modelDashboard->insertNoticia($data);
			echo 'success';	

		}
		else
			echo 'error';
	}

	/* Verifica se o usuário está logado */
	public function verificarLogin() {
		if(!$this->session->userdata('logado'))
			redirect('login');
	}

	/* Desloga o usuário destruindo a seção*/
	public function deslogar() {
		$this->session->sess_destroy();
		redirect('home');
	}
}

?>