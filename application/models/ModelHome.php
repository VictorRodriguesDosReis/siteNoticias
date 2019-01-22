<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelHome extends CI_Model {
	
	private $noticiaParcial = 'CALL  p_S_NoticiaParcial(?)';
	private $noticiaParcialFiltrado = 'CALL  p_S_NoticiaParcialFiltrado(?,?)';
	private $principaisDia = 'CALL  p_S_PrincipaisNoticiasDia()';
	private $principaisSemana = 'CALL  p_S_PrincipaisNoticiasSemana()';
	private $principaisMes = 'CALL  p_S_PrincipaisNoticiasMes()';

	function __construct() {
		parent::__construct();
	}

	public function selectNoticiaParcial($quantidade) {
		$dados = array(
			'quantidade' => $quantidade
		);

		$query = $this->db->query($this->noticiaParcial, $dados);
		$resultado = $query->result_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}

	public function selectNoticiaParcialFiltrado($ultimoId, $quantidade) {
		$dados = array(
			'ultimoId' => $ultimoId,
			'quantidade' => $quantidade
		);

		$query = $this->db->query($this->noticiaParcialFiltrado, $dados);
		$resultado = $query->result_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}

	public function selectPrincipaisNoticiasDia() {
		$query = $this->db->query($this->principaisDia);
		$resultado = $query->result_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}

	public function selectPrincipaisNoticiasSemana() {
		$query = $this->db->query($this->principaisSemana);
		$resultado = $query->result_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}

	public function selectPrincipaisNoticiasMes() {
		$query = $this->db->query($this->principaisMes);
		$resultado = $query->result_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}
}

?>