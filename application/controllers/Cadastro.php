<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

	public function index() {
		$data['hideLogin'] = "style='display: none;'";

		$this->load->view('templates/headerPadrao');
		$this->load->view('paginas/loginCadastro', $data);
	}

}


?>