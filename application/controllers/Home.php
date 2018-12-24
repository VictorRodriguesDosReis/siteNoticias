<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('modelHome');
	}

	public function index() {
		$data['onHome'] = "active";

		$noticias['noticiasParciais'] = $this->modelHome->selectNoticiaParcial(0, 10);

		$this->load->view('templates/headerPadrao', $data);
		$this->load->view('paginas/home', $noticias);
	}
}
