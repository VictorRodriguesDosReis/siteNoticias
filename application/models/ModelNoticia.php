<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelNoticia extends CI_Model {
	
	private $noticiaCompleta = "CALL p_S_NoticiaCompleta(?)";
	private $comentarios = "CALL p_S_Comentarios(?)";
	private $insereComentario = "CALL p_I_Comentario(?,?,?)";
	private $atualizaVisualizacao = "Call p_U_Visualizacao(?)";

	function __construct() {
		parent::__construct();
	}

	public function selectNoticia($codigo) {
		$dado['codigo'] = $codigo;
		$query = $this->db->query($this->noticiaCompleta, $dado);
		$resultado = $query->row_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}

	public function selectComentarios($codigo) {
		$dado['codigo'] = $codigo;
		$query = $this->db->query($this->comentarios, $dado);
		$resultado = $query->result_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}

	public function insertComentario($dados) {
		$query = $this->db->query($this->insereComentario, $dados);
		$resultado = $query->row_array();
		$query->next_result();
  		$query->free_result();
	}

	public function updateVisualizao($codigo) {
		$dado['codigoNoticia'] = $codigo;
		$query = $this->db->query($this->atualizaVisualizacao, $dado);
  		$query->free_result();
	}
}

?>