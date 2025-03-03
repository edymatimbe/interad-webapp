<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Advertiser extends CI_Controller
{



	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			$this->session->set_flashdata('info', 'your session has expired');
			redirect(base_url('auth'));
		}
	}



	public function index()
	{
		$controller_tax = [];
		if (!empty($this->setting_model->campaign()))
			$controller_tax = get_all('controller_tax', ['created_by' => $this->ion_auth->get_user_id()]);


		$data = array(
			'title' => 'Dashboard',
			'croppie' => true,
			'dataTable' => true,
			'styles' => array(
				'assets/customer/customer.css'
			),
			'campaigns' => $this->setting_model->campaign(),
			'location' => $controller_tax,
			'ads' => count(get_all('controller', ['controller.created_by' => $this->ion_auth->get_user_id()]))
		);

		$this->load->view('advertiser/index', $data);
	}


	public function get_chart()
	{
		$monthes = [];

		for ($i = 1; $i <=  intval(date('m')); $i++) {
			$month_character = $i;
			if (strlen($i) == 1)
				$month_character = '0' . $i;
			$chart = [
				'count_active' => 	count(get_all('controller', ['DATE_FORMAT(init_date,"%m")' => $month_character, 'status' => 'pago', 'controller.created_by' => $this->ion_auth->get_user_id()])),
				'pendente' => 	count(get_all('controller', ['DATE_FORMAT(init_date,"%m")' => $month_character, 'status' => 'pendente', 'controller.created_by' => $this->ion_auth->get_user_id()])),
				'expiry' => 	count(get_all('controller', ['DATE_FORMAT(init_date,"%m")' => $month_character, 'status' => 'expirou', 'controller.created_by' => $this->ion_auth->get_user_id()]))
			];
			array_push($monthes, $chart);
		}
		echo json_encode($monthes);
	}


	public function dashboard()
	{
		$data = [];
		echo json_encode($data);
	}


	public function publicity($offset = 0)
	{
		$limit = 6; // Number of cards per page
		// Load pagination library
		$this->load->library('pagination');

		// Pagination configuration
		$config['base_url'] = base_url('public/advertiser/publicity');
		$config['total_rows'] = $this->setting_model->count_cards();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3; // The segment in URL containing the offset

		$config['full_tag_open'] = '<ul class="pagination ms-auto"">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '&laquo; Primeiro';
		$config['last_link'] = 'Ultimo &raquo;';
		$config['next_link'] = 'Proximo &rarr;';
		$config['prev_link'] = '&larr; Anterior';
		$config['num_tag_open'] = '<li class="page-item mr-2 px-1">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item  mr-2 active"><a class="page-link mx-3" >';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li class="page-item mr-2 px-1">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="page-item mr-2 px-1">';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="page-item mr-2 px-1">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item mr-2 px-1">';
		$config['last_tag_close'] = '</li>';
		$this->pagination->initialize($config);

		$controller_tax = [];
		if (get_by_id('controller_tax'))
			$controller_tax = get_by_id('controller_tax', ['controller_id' => $this->setting_model->campaign()[0]->controller_id]);
		$data = array(
			'title' => 'Publicidades',
			'croppie' => true,
			'dataTable' => true,
			'styles' => array(
				'assets/customer/customer.css'
			),
			'campaign' => $this->setting_model->campaign(null, $limit, $offset),
			'location' => $controller_tax,
		);
		$this->load->view('advertiser/ads/index', $data);
	}


	public function filter_cards($offset = 0)
	{
		$limit = 6; // Number of cards per page
		// Load pagination library
		$this->load->library('pagination');
		$search = $_POST['search'];
		$filter = null;
		if (!empty($_POST['status_id'])) {
			$filter = [];
			$filter['controller.status'] = $_POST['status_id'];
		}


		// Pagination configuration
		$config['base_url'] = base_url('public/advertiser/publicity');
		$config['total_rows'] = $this->setting_model->count_cards($filter, $search);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3; // The segment in URL containing the offset

		$config['full_tag_open'] = '<ul class="pagination ms-auto"">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '&laquo; Primeiro';
		$config['last_link'] = 'Ultimo &raquo;';
		$config['next_link'] = 'Proximo &rarr;';
		$config['prev_link'] = '&larr; Anterior';
		$config['num_tag_open'] = '<li class="page-item mr-2 px-1">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item  mr-2 active"><a class="page-link mx-3" >';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li class="page-item mr-2 px-1">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="page-item mr-2 px-1">';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="page-item mr-2 px-1">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item mr-2 px-1">';
		$config['last_tag_close'] = '</li>';
		$this->pagination->initialize($config);


		$data = array(
			'data' => $this->load->view('advertiser/ads/_cards', ['campaign' => $this->setting_model->campaign($filter, $limit, $offset, $search),], true),
			'count' => $this->setting_model->count_cards(null, $search),
		);

		echo json_encode($data);
	}


	public function publicityCreate()
	{

		$data = array(
			'title' => 'Nova Publicidade',
			'croppie' => true,
			'dataTable' => true,
			'styles' => array(
				'assets/customer/customer.css'
			),

		);
		$this->load->view('advertiser/ads/_create', $data);
	}


	public function setting()
	{

		$data = array(
			'title' => 'Definições',
			'user' => get_by_id('users', array('id' => $this->ion_auth->get_user_id()))
		);
		$this->load->view('advertiser/setting/index', $data);
	}
	public function get_last_date()
	{
		echo json_encode(sum_date_and_date($_POST['periodicity'], $_POST['init_date']));
	}

	public function show($id)
	{
		$data = [
			'campaign_details' => $this->setting_model->campaign_details(['controller.id' => $id]),
			'avaliation' => $this->setting_model->controller_tax(['controller_tax.controller_id' => $id]),
			'controller_id' => $id,
			'location' => get_all('controller_tax', ['controller_id !=' => null, 'tax_id !=' => null])
		];
		$this->load->view('advertiser/ads/ad/index', $data);
	}

	public function uploadImage()
	{
		$document = $request->file('documents');
		if ($document) {

			// foreach ($documents as $document) {
			$document_name_gen = hexdec(uniqid()) . '_' . $document->getClientOriginalName();

			$document_path = 'uploads/documents/';
			$document->move(public_path($document_path), $document_name_gen);

			if (!file_exists($document_path)) {
				mkdir($document_path, 666, true);
			}

			$document_url = $document_path . $document_name_gen;
			return response()->json(['success' => 'Image uploaded successfully.']);
		}
		// }
	}

	public function save()
	{
		header('Content-Type: application/json');
		// $this->form_validation->set_rules('description', 'descrição', 'trim|required');
		$this->form_validation->set_rules('title', 'titulo', 'trim|required');
		$this->form_validation->set_rules('periodicity', 'periodicidade', 'trim|required|greater_than_equal_to[7]');
		$this->form_validation->set_rules('count_tax', 'Numero de taxes', 'trim|required|greater_than_equal_to[1]');
		$this->form_validation->set_rules('district', 'distrito', 'required');
		// $this->form_validation->set_rules('coordinates', 'coordenadas', 'trim|required');

		if ($this->form_validation->run()) {

			$user_id = $this->ion_auth->get_user_id();
			$data = elements(
				array(
					'description',
					'title',
					'video_duration',
				),
				$this->input->post()
			);

			$controller = [
				'periodicity' => $_POST['periodicity'],
				'multiplier' => $_POST['multiplier'],
				'count_tax' => $_POST['count_tax'],
				'cost' => $_POST['cost'],
				'init_date' => $_POST['init_date'],
				'final_date' => $_POST['final_date'],
				'created_by' => $user_id,
				'updated_by' => $user_id,
				'district' => $_POST['district']
			];

			$code = $this->core_model->code_generator('banner');

			// Diretório de upload
			$uploadDir = 'uploads/';
			if (!file_exists($uploadDir)) {
				mkdir($uploadDir, 0777, true); // Cria o diretório se ele não existir
			}

			if ($this->input->method() === 'post' && isset($_FILES['fileUpload'])) {
				$fileName = $_FILES['fileUpload']['name'];
				$fileTmp = $_FILES['fileUpload']['tmp_name'];
				$fileType = $_FILES['fileUpload']['type'];
				$fileError = $_FILES['fileUpload']['error'];

				// Verifica se houve erro no upload
				if ($fileError === UPLOAD_ERR_OK) {
					// Gera nome único para o arquivo
					$uniqueName = uniqid() . '_' . time();
					$extension = pathinfo($fileName, PATHINFO_EXTENSION);
					$newFileName = $uniqueName . '.' . $extension;
					$targetFile = $uploadDir . $newFileName;

					// Move o arquivo para o diretório de upload
					if (move_uploaded_file($fileTmp, $targetFile)) {
						// Definir nome de saída para o arquivo HLS
						$outputM3u8 = $uploadDir . $uniqueName . ".m3u8";



						$ffmpegCommand = "ffmpeg -i $targetFile -codec: copy -start_number 0 -hls_time 10 -hls_list_size 0 -f hls $outputM3u8 2>&1";
						exec($ffmpegCommand, $output, $returnVar);

						// Verifique a saída de erro
						if ($returnVar !== 0) {
							echo json_encode([
								'status' => 'error',
								'message' => 'Erro na conversão para HLS',
								'ffmpeg_output' => implode("\n", $output)
							]);
							die;
						}

						// Comando FFmpeg para converter o vídeo para HLS
						$ffmpegCommand = "ffmpeg -i $targetFile -codec: copy -start_number 0 -hls_time 10 -hls_list_size 0 -f hls $outputM3u8 2>&1";
						exec($ffmpegCommand, $output, $returnVar);

						if ($returnVar === 0) {
							$data['path'] = $outputM3u8;
							$data['type'] = $fileType;
						} else {

							echo json_encode(array('status' => 'error', 'message' => "Erro na conversão para HLS"));
							die;
						}
					} else {

						echo json_encode(array('status' => 'error', 'message' => "Erro ao mover o arquivo de vídeo."));
						die;
					}
				} else {

					echo json_encode(array('status' => 'error', 'message' => 'Erro no upload. Código de erro'));
					die;
				}
			} else {

				echo json_encode(array('status' => 'error', 'message' => 'Nenhum vídeo foi enviado.'));
				die;
			}
			$verify = 0;
			$data['code'] = $code;
			$data['created_by'] = $user_id;
			$data['updated_by'] = $user_id;
			$data['customer_id'] = $user_id;

			if (insert('banner', $data)) {
				$banner_id = $this->session->userdata('last_id');
				$controller['banner_id'] = $banner_id;
				$controller['code'] = $this->core_model->code_generator('controller');
				if (insert('controller', $controller)) {
					echo json_encode(array('status' => 'success', 'message' => 'Nova campanha criada', 'verify' => $verify));
				} else {
					echo json_encode(array('status' => 'error', 'message' => 'Erro ao inserir controlador'));
				}
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Erro ao salvar campanha'));
			}
		} else {
			$errors_validation = $this->form_validation->error_array();
			$array_keys = array_keys($errors_validation);
			$array_values = array_values($errors_validation);
			$errors = array_combine($array_keys, $array_values);
			echo json_encode(array('status' => 'error_validation', 'message' => 'error validation', 'error' => $errors));
		}
	}


	public function pdf_invoice()
	{
		// header('Content-Type: application/json');
		$id = $_POST['id'];

		// $result = $this->setting_model->get_billing(['controller.id' => $id])[0];
		// $data = [
		// 	'company'  		=> get_by_id('company', ['id' => 1]),
		// 	'customer' 		=> get_by_id('users', ['id' => $result->user_id]),
		// 	'periodicity' 	=> $result->periodicity,
		// 	'multiplier' 	=> $result->multiplier,
		// 	'count_tax' 	=> count(get_all('controller_tax', ['controller_id' => $result->controller_id])),
		// 	'video_duration' => $result->video_duration,
		// 	'video_amount' 	=> $result->cost,
		// 	'code' 	=> $result->code,
		// 	'type' => 'saved',
		// 	'controller_id' => $result->controller_id,
		// 	'controller' => true
		// ];


		echo json_encode($id);

		// $this->pdf->load_view('layout/document', $data);
		// $options = $this->pdf->getOptions();
		// $options->setIsRemoteEnabled(true);
		// $this->pdf->setOptions($options);
		// $this->pdf->render();

		// //		watermark
		// $canvas = $this->pdf->getCanvas();
		// $fontMetrics = new \Dompdf\FontMetrics($canvas, $options);
		// $font = $fontMetrics->getFont('times');

		// $w = $canvas->get_width();
		// $h = $canvas->get_height();
		// $text = "BigB Soft DEMO";

		// $txtHeight = $fontMetrics->getFontHeight($font, 75);
		// $textWidth = $fontMetrics->getTextWidth($text, $font, 75);

		// $canvas->set_opacity(.2);

		// // Specify horizontal and vertical position
		// $x = (($w - $textWidth) / 2);
		// $y = (($h - $txtHeight) / 2);

		// // Writes text at the specified x and y coordinates
		// //		$canvas->text($x, $y, $text, $font, 75,null,null,null,-45);

		// $output = $this->pdf->output();



		// $invoicePath = 'companies/' . str_replace(' ', '_', remove_accents( get_by_id('company', ['id' => 1])->name)) . '/invoices'  ;
		// if (!is_dir($invoicePath)) {
		// 	mkdir($invoicePath, 0777, true);
		// }
		// $invoicePath .= '/' . '_' . $data['code'] . '.pdf';


		// $fp = fopen($invoicePath, 'w+');
		// if (fwrite($fp, $output)) {
		// 	$b64Doc = chunk_split(base64_encode(file_get_contents(base_url($invoicePath))));
		// } else {
		// 	$b64Doc = false;
		// }

		// // $b64Doc = $this->cart_model->drawInvoicePDF($data, 'invoice', $id, false);
		// echo json_encode(array('ok' => true, 'pdf' => $b64Doc));
	}

	public function get_map()
	{
		$controller_tax = get_by_id('controller_tax', ['controller_id' => $_POST['controller_id'], 'tax_id' => $_POST['tax_id']]);
		$data = [
			'history' => $controller_tax
		];
		echo json_encode($this->load->view('advertiser/ads/ad/map_history', $data, true));
	}



	public function get_quotaion()
	{

		if ($_POST['controller_id']) {
			$result = $this->setting_model->get_billing(['controller.id' => $_POST['controller_id']])[0];
			$data = [
				'company'  		=> get_by_id('company', ['id' => 1]),
				'customer' 		=> get_by_id('users', ['id' => $result->user_id]),
				'periodicity' 	=> $result->periodicity,
				'multiplier' 	=> $result->multiplier,
				'count_tax' 	=> count(get_all('controller_tax', ['controller_id' => $result->controller_id])),
				'video_duration' => $result->video_duration,
				'video_amount' 	=> $result->cost,
				'code' 	=> $result->code,
				'type' => 'saved',
				'controller_id' => $result->controller_id
			];
		} else {
			$data = [
				'company'  		=> get_by_id('company', ['id' => 1]),
				'customer' 		=> get_by_id('users', ['id' => 4]),
				'periodicity' 	=> $_POST['periodicity'],
				'multiplier' 	=> $_POST['multiplier'],
				'count_tax' 	=> $_POST['count_tax'],
				'video_duration' => $_POST['video_duration'],
				'video_amount' 	=> $_POST['video_amount'],
			];
		}


		echo json_encode($this->load->view('advertiser/ads/_quotation', $data, true));
	}

	public  function billing()
	{
		$data = array(
			'title' => 'Facturas e contas',



			'styles' => array(
				'vendor/datatables/dataTables.bootstrap4.min.css',
			),

			'scripts' => array(
				'vendor/datatables/jquery.dataTables.min.js',
				'vendor/datatables/dataTables.bootstrap4.min.js',
				'vendor/datatables/app.js',
				'vendor/print-js/print.min.js',
			),
			// 'styles' => array(
			// 	'css/croppie.css',
			// 	'vendor/datatables/dataTables.bootstrap4.min.css',
			// ),

			// 'scripts' =>
			// array(
			// 	'js/croppie.js',
			// 	'vendor/datatables/jquery.dataTables.min.js',
			// 	'vendor/datatables/dataTables.bootstrap4.min.js',
			// 	'vendor/datatables/app.js',
			// ),
			'billings' => $this->setting_model->get_billing(['controller.created_by' => $this->ion_auth->get_user_id()])
		);
		$this->load->view('advertiser/billing/index', $data);
	}

	public function save_profile()
	{
		header('Content-Type: application/json');

		$this->form_validation->set_rules('first_name', '', 'trim|required');
		$this->form_validation->set_rules('last_name', '', 'trim|required');
		$this->form_validation->set_rules('confirm_password', 'Cofrimar password', 'matches[password]');
		$this->form_validation->set_rules('username', 'Username', 'trim|callback_username_check');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
		$this->form_validation->set_rules('password', 'password', 'min_length[8]|max_length[255]');
		$this->form_validation->set_rules('address', 'endereço', 'trim');

		$this->form_validation->set_rules('nuit', 'nuit', 'trim|required');

		if ($this->form_validation->run()) {
			$data = elements(
				array(
					'first_name',
					'last_name',
					'email',
					'username',
					'company',
					'phone',
					'phone2',
					'nuit',
					'address'
				),
				$this->input->post()
			);

			// -----------------------------------------------------------------------------------------------
			$id = $this->input->post('id'); //verifica se foi passado o password
			$password = $this->input->post('password'); //verifica se foi passado o password
			$s = 'nao';
			if ($password) {
				$s = 'sim';
				$data['password'] = $password;
			}

			if ($this->ion_auth->update($id, $data)) {
				echo json_encode(array('status' => 'success', 'message' => 'Perfil actualizado com sucesso'));
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Error, ao actualizar o perfil'));
			}
		} else {
			$errors_validation = $this->form_validation->error_array();
			$array_keys = array_keys($errors_validation);
			$array_values = array_values($errors_validation);
			$errors = array_combine($array_keys, $array_values);
			echo json_encode(array('status' => 'error_validation', 'message' => 'error validation', 'error' => $errors));
		}
	}


	function email_check($email)
	{
		$id = $this->input->post('id');

		if ($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $id))) {
			$this->form_validation->set_message('email_check', 'This email already exist');
			return false;
		} else {
			return true;
		}
	}

	function username_check($username)
	{
		$id = $this->input->post('id');
		if ($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $id))) {
			$this->form_validation->set_message('username_check', 'This username already exist');
			return false;
		} else {
			return true;
		}
	}
}
