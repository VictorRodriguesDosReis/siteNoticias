<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelDashboard extends CI_Model {

	private $insertNoticia = "CALL p_I_Noticia(?,?,?,?)";

	function __construct() {
		parent::__construct();
	}

	public function insertNoticia($dados) {
		$query = $this->db->query($this->insertNoticia, $dados);
		$query->free_result();
	}

}

?>