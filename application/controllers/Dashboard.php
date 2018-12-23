<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}

	function index($usuario) {
		$this->load->view('templates/headerPadrao');
		$this->load->view('paginas/dashboard');
	}
}

?>