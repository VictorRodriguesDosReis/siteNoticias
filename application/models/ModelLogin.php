<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelLogin extends CI_Model {
	
	private $verificaConta = 'CALL p_S_LoginAutor(?,?)';

	function __construct()
	{
		parent::__construct();
	}

	public function verificarConta($dados) {
		$data = array(
			'email' => $dados['email'],
			'senha' => do_hash(SALT.$dados['senha'], 'md5') 
		);

		$query = $this->db->query($this->verificaConta, $data);
		return $query->row_array();
	}
}


?>