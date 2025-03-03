<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Tax extends CI_Controller
{
	protected $user_id;

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			$this->session->set_flashdata('info', 'your session has expired');
			redirect(base_url('auth'));
		}
		$this->user_id = $this->ion_auth->get_user_id();
	}
	function getAll()
	{
		$taxes = get_all('tax', null,  array('id', 'DESC'));
		echo $this->load->view('tax/_table', array('taxes' => $taxes), true);
	}
	function index()
	{
		$data = array(
			'title' => 'Tax',
			'styles' => array(
				'vendor/datatables/dataTables.bootstrap4.min.css',
				'css/croppie.css',
				'assets/bank/bank.css'
			),
			'cdns_css' => array(),

			'scripts' => array(
				'vendor/datatables/jquery.dataTables.min.js',
				'vendor/datatables/dataTables.bootstrap4.min.js',
				'vendor/datatables/app.js',
				'js/croppie.js',
				'assets/bank/bank.js'
			),
			'cdns_js' => array(),
			'menu_active' => 'menu-tax',
			'sub_menu_active' => 'taxs',
			'taxes' => get_all('tax', null,  array('id', 'DESC')),
		);
		$this->load->view('tax/index', $data);
	}

	public function form()
	{
		$data = [];
		if (isset($_POST['id']))
			$data['tax'] = get_by_id('tax', ['id' => $_POST['id']]);
		echo $this->load->view('tax/_form', $data, true);
	}



	public function save()
	{
		header('Content-Type: application/json');
		// echo json_encode($this->input->post());
		// die;

		$action = $this->input->post('action'); //create or udate

		$data = elements(
			array(
				'name',
				'barcode',
				'category_id',
				'brand_id',
				'registration',
				'description',
			),
			$this->input->post()
		);

		if (!empty($_POST['access_code']))
			$data['access_code'] = md5($_POST['access_code']);


		if ($action == 'create') {
			$code =   $this->core_model->code_generator('tax');
			$data['code'] = $code;
			$data['created_by'] = $this->user_id;
			$data['updated_by'] = $this->user_id;
			if (insert('tax', $data)) {
				echo json_encode(array('status' => 'success', 'message' =>  'Tax ' . $this->lang->line('saved')));
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Taxe não ' . $this->lang->line('saved')));
			}
		} else {
			$data['updated_at'] = date("Y-m-d H:i:s");
			$data['updated_by'] = $this->user_id;
			$id = $this->input->post('id');

			if (update('tax', $data, array('id' => $id))) {
				echo json_encode(array('status' => 'success', 'message' => ' Tax ' . $this->lang->line('updated')));
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Tax não ' . $this->lang->line('updated')));
			}
		}
	}

	function saveNew()
	{
		header('Content-Type: application/json');

		$name = $_POST['name'];
		$object = $_POST['object'];
		$user_id = $this->ion_auth->get_user_id();

		$data = array(
			'name' => $name,
			'created_by' => $user_id,
			'updated_by' => $user_id,
		);

		$object_name = $this->lang->line($object);

		if ($this->core_model->insert($object, $data)) {
			$datas = [];
			$datas['active'] = 1;
			$last = $this->session->userdata('last_id');
			$select = $this->load->view(
				'layout/_select',
				array('selected' => $last, 'result' => get_all($object, $datas)),
				true
			);
			echo json_encode(array('status' => 'success', 'message' => $object_name . ' ' . $this->lang->line('saved'), 'select' => $select));
		} else {
			echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . ' ' . $object_name));
		}

		// if ($this->core_model->insert($object, $data)) {
		// 	$select = $this->updateSelect($object);
		// 	echo json_encode(array('status' => 'success', 'message' => $object_name . ' ' . $this->lang->line('saved'), 'select' => $select));
		// } else {
		// 	echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . ' ' . $object_name));
		// }
	}

	// function updateSelect($object)
	// {
	// 	$datas = [];

	// 	$datas['active'] = 1;
	// 	$last = $this->session->userdata('last_id');
	// 	return $this->load->view(
	// 		'layout/_select',
	// 		array('selected' => $last, 'result' => get_all($object, $datas)),
	// 		true
	// 	);
	// }
}
