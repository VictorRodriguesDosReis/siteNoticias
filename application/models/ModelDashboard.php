<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelDashboard extends CI_Model {

	private $insertNoticia = "CALL p_I_Noticia(?,?,?,?,?)";
	private $selectNoticiaParcial = "CALL p_S_NoticiaParcialAutor(?,?)";
	private $selectNoticiaFiltrado = "CALL p_S_NoticiaParcialFiltradoAutor(?,?,?)";
	private $selectNoticiaCompleta = "CALL p_S_NoticiaCompletaAutor(?,?)";
	private $updateNoticia = "CALL p_U_Noticia(?,?,?,?,?,?)";
	private $deleteNoticia = "CALL p_U_DesativaNoticia(?,?)";

	function __construct() {
		parent::__construct();
	}

	public function insertNoticia($dados) {
		$query = $this->db->query($this->insertNoticia, $dados);
		$resultado = $query->row_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}

	public function selectNoticiaParcial($dados) {
		$query = $this->db->query($this->selectNoticiaParcial, $dados);
		$resultado = $query->result_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}

	public function selectNoticiaFiltrado($dados) {
		$query = $this->db->query($this->selectNoticiaFiltrado, $dados);
		$resultado = $query->result_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}

		public function selectNoticiaCompleta($dados) {
		$query = $this->db->query($this->selectNoticiaCompleta, $dados);
		$resultado = $query->row_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}

	public function updateNoticia($dados) {
		$query = $this->db->query($this->updateNoticia, $dados);
		$resultado = $query->row_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}

	public function deleteNoticia($dados) {
		$query = $this->db->query($this->deleteNoticia, $dados);
  		$query->free_result();
	}
}

?>