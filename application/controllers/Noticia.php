<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticia extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('modelNoticia');
	}

	public function index($codigo) {
		$dados['noticia'] = $this->modelNoticia->selectNoticia($codigo);
		$dados['comentarios'] = $this->modelNoticia->selectComentarios($codigo);
		$dados['codigo'] = $codigo;

		$this->modelNoticia->updateVisualizao($codigo);

		$this->load->view('templates/headerPadrao');
		$this->load->view('paginas/noticia', $dados);
	}

	public function publicaComentario() {
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[2]|max_length[20]');
		$this->form_validation->set_rules('comentario', 'Comentário', 'trim|required|min_length[5]|max_length[255]');
		$this->form_validation->set_rules('codigo', 'Código da Notícia', 'trim|required|min_length[1]|max_length[5]|integer');

		if ($this->form_validation->run()) {
			$this->modelNoticia->insertComentario($this->input->post());

			echo 'success';

		} else {
			echo 'error';

		}
	}
}
?>