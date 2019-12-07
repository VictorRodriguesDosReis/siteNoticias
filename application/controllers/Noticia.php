<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticia extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('modelNoticia');
	}

	public function index($codigo) {
		$dados['onNoticia'] = true;
		$dados['noticia'] = $this->modelNoticia->selectNoticia($codigo);
		$dados['comentarios'] = $this->modelNoticia->selectComentarios($codigo);
		$dados['noticiasRecentes'] = $this->modelNoticia->selectNoticiasRecentes(5);
		$dados['codigo'] = $codigo;

		$this->modelNoticia->updateVisualizao($codigo);

		if ($this->session->userdata('logado')) {
			$dados['nomeUsuario'] = $this->session->userdata('nome');
			$this->load->view('templates/headerLogado', $dados);
		}
		else
			$this->load->view('templates/headerPadrao', $dados);
		$this->load->view('paginas/noticia', $dados);
	}

	public function publicaComentario() {
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[2]|max_length[20]');
		$this->form_validation->set_rules('comentario', 'Comentário', 'trim|required|min_length[5]|max_length[255]');
		$this->form_validation->set_rules('codigo', 'Código da Notícia', 'trim|required|min_length[1]|max_length[5]|integer');

		if ($this->form_validation->run()) {
			$data = array(
				'nome' => htmlspecialchars($this->input->post('nome'), ENT_QUOTES, 'UTF-8'),
				'comentario' => htmlspecialchars($this->input->post('comentario'), ENT_QUOTES, 'UTF-8'),
				'codigo' => $this->input->post('codigo'),
			);

			$comentarioInserido = $this->modelNoticia->insertComentario($data);

			$comentarioInserido['dataCriacao'] = date('d/m/Y H:i:s', strtotime($comentarioInserido['dataCriacao']));

			echo json_encode($comentarioInserido);

		} else {
			echo 'error';

		}
	}
}
?>