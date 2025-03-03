<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Brand extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			$this->session->set_flashdata('info', 'your session has expired');
			redirect(base_url('auth'));
		}

		
		if($this->session->userdata('type_user')  == 3){
			redirect(base_url('advertiser'));
		}
	}

	function index()
	{

//		$columns = $this->db->list_fields('brand');
////		$columnsx = array_values($columns);
//
//		$sql_names  = '';
//		$distinct = 'name';
//
//		if (($key = array_search($distinct, $columns)) !== false) {
//			unset($columns[$key]);
//		}
//
//		echo '<pre>'; print_r($columns); echo '</pre>';
//		echo '<pre>'; print_r($sql_names); echo '</pre>';
//		exit();


		$data = array(
			'title' => $this->lang->line('brands'),
			'styles' => array(
				'vendor/datatables/dataTables.bootstrap4.min.css',
				'assets/brand/brand.css',
			),
			'cdns_css' => array(),

			'scripts' => array(
				'vendor/datatables/jquery.dataTables.min.js',
				'vendor/datatables/dataTables.bootstrap4.min.js',
				'vendor/datatables/app.js',
				'assets/brand/brand.js',
			),
			'cdns_js' => array(),
			'menu_active' => 'menu-product',
			'sub_menu_active' => 'brand',
			'brands' => $this->core_model->get_all_order('brand',null,'name'),
		);
		$this->load->view('brand/index', $data);
	}

	public function save()
	{
		$action = $this->input->post('action'); //create or udate
		$user_id = $this->ion_auth->get_user_id();

		$data = elements(
			array(
				'name',
				'created_by',
				'updated_by',
			),
			$this->input->post()
		);

		$data['updated_by'] = $user_id;

		if ($action == 'create') {
			$data['created_by'] = $user_id;
			$data = html_escape($data);
			if ($this->core_model->insert('brand', $data)) {
				echo json_encode(array('status' => 'success', 'message' => $this->lang->line('brand') . ' ' . $this->lang->line('saved')));
			} else {
				echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . ' ' . $this->lang->line('brand')));
			}
		} else {
			unset($data['created_by']);
			$data['updated_at'] = date("Y-m-d H:i:s");

			$data = html_escape($data);
			$id = $this->input->post('id');
			if($this->core_model->update('brand', $data, array('id' => $id))){
				echo json_encode(array('status' => 'success', 'message' => $this->lang->line('brand') . ' ' . $this->lang->line('updated')));
			} else {
				echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . ' ' . $this->lang->line('brand')));
			}
		}
	}

	public function getProducts()
	{
		$brand_id = $_POST['brand_id'];
		$products = $this->core_model->get_all('product', array('brand_id' => $brand_id));
		echo $this->load->view('brand/_products', array('products' => $products), true);
	}

	public function create()
	{
		echo $this->load->view('brand/_create', null, true);
	}

	function getAll()
	{
		echo $this->load->view('brand/_table',
			array('brands' =>  $this->core_model->get_all_order('brand',null,'name')),
			true
		);
	}

	public function getBrand()
	{
		$category = $this->core_model->get_by_id('brand', array('id' => $_POST['id']));
		return array(
			'brand' => $category,
			'products' => $this->core_model->get_all('product',array('brand_id'=>$category->id))
		);
	}

	public function show()
	{
		echo $this->load->view('brand/_show', $this->getBrand(), true);
	}

	public function edit()
	{
		echo $this->load->view('brand/_edit', $this->getBrand(), true);
	}

}
