<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelHome extends CI_Model {
	
	private $noticiaParcial = 'CALL  p_S_NoticiaParcial(?,?)';

	function __construct() {
		parent::__construct();
	}

	public function selectNoticiaParcial($codigoInicio, $quantidade) {
		$dados = array(
			'codigoInicio' => $codigoInicio, 
			'quantidade' => $quantidade, 
		);

		$query = $this->db->query($this->noticiaParcial, $dados);
		return $query->result_array();
	}
}

?>