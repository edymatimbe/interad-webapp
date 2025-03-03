<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Bank extends CI_Controller
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
		$banks = $this->core_model->get_all('bank', null,  array('id', 'ASC'));
		echo $this->load->view('settings/bank/_table', array('banks' => $banks), true);
	}
	function index()
	{
		$data = array(
			'title' => 'Bancos',
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
			'menu_active' => 'menu-system',
			'sub_menu_active' => 'banks',
			'banks' => $this->core_model->get_all('bank', null,  array('id', 'ASC')),
		);
		$this->load->view('settings/bank/index', $data);
	}

	public function create()
	{
		echo $this->load->view('settings/bank/_create', null, true);
	}



	public function save()
	{
		header('Content-Type: application/json');

		$action = $this->input->post('action'); //create or udate

		$data = elements(
			array(
				'name',
			),
			$this->input->post()
		);
		if ($action == 'create') {
			$data['created_by'] = $this->user_id;
			$data['updated_by'] = $this->user_id;
			if ($this->core_model->insert('bank', $data)) {
				echo json_encode(array('status' => 'success', 'message' => $this->lang->line('bank_account') . ' ' . $this->lang->line('saved')));
			} else {
				echo json_encode(array('status' => 'error', 'message' => $this->lang->line('bank_account') . ' ' . $this->lang->line('saved')));
			}
		} else {
			$data['updated_at'] = date("Y-m-d H:i:s");
			$data['updated_by'] = $this->user_id;
			$id = $this->input->post('id');

			if ($this->core_model->update('bank', $data, array('id' => $id))) {
				echo json_encode(array('status' => 'success', 'message' => $this->lang->line('bank_account') . ' ' . $this->lang->line('updated')));
			} else {
				echo json_encode(array('status' => 'error', 'message' => $this->lang->line('bank_account') . ' ' . $this->lang->line('saved')));
			}
		}
	}

	public function getBank()
	{
		$bank = $this->core_model->get_by_id('bank', array('id' => $_POST['id']));
		return array(
			'bank' => $bank
		);
	}


	public function edit()
	{
		echo $this->load->view('settings/bank/_edit', $this->getBank(), true);
	}
}
