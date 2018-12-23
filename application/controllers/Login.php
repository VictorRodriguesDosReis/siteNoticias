<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {
		$data['hideCadastro'] = "style='display: none;'";
		$header['onLogin'] = 'active';

		$this->load->view('templates/headerPadrao', $header);
		$this->load->view('paginas/loginCadastro', $data);
	}

}


?>