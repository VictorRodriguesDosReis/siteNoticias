<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

	public function index() {
		$header['onCadastro'] = "active";
		$data['hideLogin'] = "style='display: none;'";

		$this->load->view('templates/headerPadrao', $header);
		$this->load->view('paginas/loginCadastro', $data);
	}

}


?>