<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {
		$data['onHome'] = "active";

		$this->load->view('templates/headerPadrao', $data);
		$this->load->view('paginas/home');
	}
}
