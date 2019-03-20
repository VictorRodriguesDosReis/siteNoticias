<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('modelDashboard');
		$this->nomeAutor['nomeUsuario'] = $this->session->userdata('nome');
		$this->verificarLogin();
	}

	public function index() {
		$dadosSelect = array(
			'quantidade' => 10,
			'codigo' => $this->session->userdata('codigo')
		);
		$noticias['noticias'] = $this->modelDashboard->selectNoticiaParcial($dadosSelect);

		$this->load->view('templates/headerLogado', $this->nomeAutor);
		$this->load->view('paginas/dashboard', $noticias);

	}

	public function novaNoticia() {
		$data['titulo'] = 'Nova Notícia';

		$this->load->view('templates/headerLogado', $this->nomeAutor);
		$this->load->view('paginas/editorNoticia', $data);
	}

	public function editarNoticia() {
		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|min_length[10]|max_length[100]');
		$this->form_validation->set_rules('subtitulo', 'Subtítulo', 'trim|min_length[10]|max_length[250]');
		$this->form_validation->set_rules('noticia', 'Notícia', 'trim|required|min_length[10]');
		$this->form_validation->set_rules('codigo-noticia', 'Código da notícia', 'trim|required|integer');

		if($this->form_validation->run()) {
			$data = array(
				'titulo' => html_purify($this->input->post('titulo')),
				'subtitulo' => html_purify($this->input->post('subtitulo')),
				'noticia' => $this->input->post('noticia'),
				'codigo-usuario' => $this->session->userdata('codigo'),
				'codigo-noticia' => $this->input->post('codigo-noticia'),
			);

			$resposta = $this->modelDashboard->updateNoticia($data);
			$resposta['dataEdicao'] = date('d/m/Y H:i:s', strtotime($resposta['dataEdicao']));
			echo json_encode($resposta);

		}
		else
			echo 'error';
	}

	public function excluirNoticia() {
		$this->form_validation->set_rules('codigo', 'Código da notícia', 'trim|required|integer');

		if($this->form_validation->run()) {
			$data = array(
				'codigo-usuario' => $this->session->userdata('codigo'),
				'codigo-noticia' => $this->input->post('codigo'),
			);

			$resposta = $this->modelDashboard->deleteNoticia($data);
			echo 'success';

		}
		else
			echo 'error';
	}

	public function publicarNoticia() {
		$arrayImagensNoticia = explode(',', $this->input->post('imagens'));

		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|min_length[10]|max_length[100]');
		$this->form_validation->set_rules('subtitulo', 'Subtítulo', 'trim|min_length[10]|max_length[250]');
		$this->form_validation->set_rules('noticia', 'Noticia', 'trim|required|min_length[10]');

		if($this->form_validation->run()) {
			$data = array(
				'titulo' => html_purify($this->input->post('titulo')),
				'subtitulo' => html_purify($this->input->post('subtitulo')),
				'noticia' => $this->input->post('noticia'),
				'codigo' => $this->session->userdata('codigo'),
			);

			$codigoNoticia = $this->modelDashboard->insertNoticia($data);

			if (!empty($arrayImagensNoticia[0]))
				$this->modelDashboard->insertImagensNoticia($arrayImagensNoticia, $codigoNoticia['codigo']);

			echo 'success';	

		}
		else
			echo 'error';
	}

	public function dadosNoticia() {
		$data = array(
			'codigo-noticia' => $this->input->get('codigo'),
			'codigo-usuario' => $this->session->userdata('codigo')
		);

		$dados = $this->modelDashboard->selectNoticiaCompleta($data);
		
		echo json_encode($dados);

	}

	public function salvarImagem() {
		$codigoUsuario = $this->session->userdata('codigo');

		if($_FILES)
		{
			foreach ($_FILES as $arquivo) {

				$array_nome = explode('.', $arquivo["name"]);
				$extencao = end($array_nome);
				$nome = md5(date('Y-m-d').$arquivo["name"].time()). '.' .$extencao;
				$localizacao = APPPATH.'../assets/img/'.$codigoUsuario.'/'.$nome;
				move_uploaded_file($arquivo["tmp_name"], $localizacao);
			}

			echo json_encode(array('link' => base_url().'assets/img/'.$codigoUsuario.'/'.$nome));
			// header('Content-Type: '.$arquivo['type']);
			// readfile($arquivo["tmp_name"]);
			// base_url();

			// $type = $arquivo['type'];
			// $data = file_get_contents($arquivo['tmp_name']);
			// echo json_encode(array('link' => 'data:image/' . $type . ';base64,' . base64_encode($data)));
		}
		else {
			echo "error";
		}
	}

	// public function criarImagem($imagemEmBase64) {
	// 	$nomeImagem = md5(date('Y-m-d').time()). '.png';
	// 	$caminhoImagem = APPPATH.'../assets/img/'. $nomeImagem;

	// 	$imagemEmCriacao = fopen($caminhoImagem, 'wb'); 

	//     // we could add validation here with ensuring count( $data ) > 1
	//     fwrite($imagemEmCriacao, base64_decode($imagemEmBase64));

	//     // clean up the file resource
	//     fclose($imagemEmCriacao); 

	//     return $caminhoImagem;
	// }

	/* Carrega as imagens que o usuário tem na pasta */
	public function carregarImagens() {
		$codigoUsuario = $this->session->userdata('codigo');
		$caminhoPastaImagens = APPPATH.'../assets/img/';
		$arrayImagens = array();

		if ($handle = opendir($caminhoPastaImagens.$codigoUsuario)) {
			$linkPastaUsuario = base_url().'assets/img/'.$codigoUsuario.'/';

		    /* Esta é a forma correta de varrer o diretório */
		    while (false !== ($file = readdir($handle))) {
		    	if ($file != "." && $file != "..") {
		    		$arrayCaminhoImagem['url'] = $linkPastaUsuario.$file;
		            array_push($arrayImagens, $arrayCaminhoImagem);
		        }
		    }
		    closedir($handle);
		}

		echo json_encode($arrayImagens);
	}

	/* Deleta a imagem seleciona pelo usuário*/
	public function deletarImagem() {
		$codigoUsuario = $this->session->userdata('codigo');
		$arrayLinkImagemParaDeletar = explode('/', $this->input->input_stream('src'));
		$nomeImagem = end($arrayLinkImagemParaDeletar);
		$localizacao = APPPATH.'../assets/img/'.$codigoUsuario.'/'.$nomeImagem;
		unlink($localizacao);

	}

	/* Verifica se o usuário está logado */
	public function verificarLogin() {
		if(!$this->session->userdata('logado'))
			redirect('login');
	}

	/* Desloga o usuário destruindo a seção*/
	public function deslogar() {
		$this->session->sess_destroy();
		redirect('home');
	}
}

?>