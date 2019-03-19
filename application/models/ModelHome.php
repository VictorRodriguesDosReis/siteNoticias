<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelHome extends CI_Model {
	
	private $noticiaParcial = 'CALL  p_S_NoticiaParcial(?)';
	private $noticiaParcialFiltrado = 'CALL  p_S_NoticiaParcialFiltrado(?,?)';
	private $principaisDia = 'CALL  p_S_PrincipaisNoticiasDia(?)';
	private $principaisSemana = 'CALL  p_S_PrincipaisNoticiasSemana(?)';
	private $principaisMes = 'CALL  p_S_PrincipaisNoticiasMes(?)';
	private $principaisComImagem = 'CALL  p_S_PrincipaisComImagem(?)';

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

	public function selectPrincipaisNoticiasDia($quantidade) {
		$dados = array(
			'quantidade' => $quantidade
		);

		$query = $this->db->query($this->principaisDia, $quantidade);
		$resultado = $query->result_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}

	public function selectPrincipaisNoticiasSemana($quantidade) {
		$dados = array(
			'quantidade' => $quantidade
		);

		$query = $this->db->query($this->principaisSemana, $quantidade);
		$resultado = $query->result_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}

	public function selectPrincipaisNoticiasMes($quantidade) {
		$dados = array(
			'quantidade' => $quantidade
		);

		$query = $this->db->query($this->principaisMes, $quantidade);
		$resultado = $query->result_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}

	public function selectPrincipaisComImagem($quantidade) {
		$dados = array(
			'quantidade' => $quantidade
		);

		$query = $this->db->query($this->principaisComImagem, $quantidade);
		$resultado = $query->result_array();
		$query->next_result();
  		$query->free_result();
		return $resultado;
	}
}

?>