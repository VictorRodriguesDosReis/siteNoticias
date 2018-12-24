<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelCadastro extends CI_Model {
	
	private $insertUsuario = 'CALL p_I_Autor(?, ?, ?)';

	function __construct()
	{
		parent::__construct();
	}

	public function insertUsuario($dados) {
		$data = array(
			'nome' => $dados['nome'],
			'email' => $dados['email'],
			'senha' => do_hash(SALT.$dados['senha'], 'md5')
		);

		$query = $this->db->query($this->insertUsuario, $data);
		return $query->row_array();
	}

}

?>