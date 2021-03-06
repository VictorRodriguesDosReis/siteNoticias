<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('modelHome');
	}

	public function index() {
		$data['onHome'] = true;
		$noticias = array(
			'noticiasParciais' => $this->modelHome->selectNoticiaParcial(10),
			'principaisDia' => $this->modelHome->selectPrincipaisNoticiasDia(5),
			'principaisSemana' => $this->modelHome->selectPrincipaisNoticiasSemana(5),
			'principaisMes' => $this->modelHome->selectPrincipaisNoticiasMes(5),
			'principaisComImagem' => $this->modelHome->selectPrincipaisComImagem(3)
		);

		if ($this->session->userdata('logado')) {
			$data['nomeUsuario'] = $this->session->userdata('nome');
			$this->load->view('templates/headerLogado', $data);
		}
		else
			$this->load->view('templates/headerPadrao', $data);
		
		$this->load->view('paginas/home', $noticias);
	}

	public function carregarMaisNoticias() {
		$ultimaPosicao = $this->input->get('posicao');
		$noticiasParciais = $this->modelHome->selectNoticiaParcialFiltrado($ultimaPosicao, 10);

		for ($i=0; $i < sizeof($noticiasParciais); $i++)
			$noticiasParciais[$i]['data'] = date('d/m/Y H:i:s', strtotime($noticiasParciais[$i]['data']));

		echo json_encode($noticiasParciais);
	}
}

?>