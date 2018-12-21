<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		$data['hideCadastro'] = "style='display: none;'";

		$this->load->view('templates/headerPadrao');
		$this->load->view('paginas/loginCadastro', $data);
	}

}


?>