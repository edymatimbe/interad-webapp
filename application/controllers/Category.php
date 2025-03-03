<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Category extends CI_Controller
{
	protected $user_id;

	public function __construct()
	{
		parent::__construct();

//		if (!$this->ion_auth->logged_in()) {
//			$this->session->set_flashdata('info', 'your session has expired');
//			redirect(base_url('auth'));
//		}
//		$this->user_id = $this->ion_auth->get_user_id();


if($this->session->userdata('type_user')  == 3){
	redirect(base_url('advertiser'));
}
	}


	function index()
	{
//		echo '<pre>'; print_r($this->core_model->get_all_order('category')); echo '</pre>';
//		exit();
		$data = array(
			'title' => $this->lang->line('categories'),
			'styles' => array(
				'vendor/datatables/dataTables.bootstrap4.min.css',
				'css/croppie.css',

				'assets/category/category.css'
			),
			'cdns_css' => array(),

			'scripts' => array(
				'vendor/datatables/jquery.dataTables.min.js',
				'vendor/datatables/dataTables.bootstrap4.min.js',
				'vendor/datatables/app.js',
				'js/croppie.js',
				'assets/category/category.js'
			),
		);
		$this->load->view('category/index', $data);
	}

	function get_index()
	{
		set_cookie('is_service', $_POST['is_service'], time() + 3600);

		$data = [
			'is_service' => $_POST['is_service'],
			'categories' => $this->core_model->get_all('category', ['is_service' => $_POST['is_service']], ['name'])
		];
		echo $this->load->view('category/_index', $data, true);
	}


	public function count_products($id)
	{
		$this->db->where('company_id', $this->session->userdata('company_id'));

		$has_child = $this->db->select('id')->where('parent_id', $id)->get('category')->result();
		$total = count($this->db->where('category_id', $id)->get('product')->result());

		if (count($has_child) > 0) {
			foreach ($has_child as $cat) {
				$this->count_products($cat->id);
				$total += count($this->db->where('category_id', $cat->id)->get('product')->result());
			}
		}
		return $total;
	}


	public function save()
	{
		header('Content-Type: application/json');

		$action = $this->input->post('action'); //create or udate
		$user_id = $this->ion_auth->get_user_id();

		$data = elements(
			array(
				'name',
				'image',
				'parent_id',
				'created_by',
				'updated_by',
			),
			$this->input->post()
		);
		$data['is_service'] = is_service();
		$parent_id = $this->input->post('parent_id');
		if (!$parent_id) {
			unset($data['parent_id']);
		}
		if (is_service() == 1) {
			$data['in_invoice'] = $_POST['in_invoice'];
		}
		$image_byte = $this->input->post('image');
		$imagePath = 'public/img/categories/' . date('Y');
		$image_name = 'IMG_' . date('YmdHis') . '.jpg';
		if ($image_byte) {
			$data['image'] = $imagePath . '/' . $image_name;
		}

		$data['updated_by'] = $user_id;

		if ($action == 'create') {
			$data['created_by'] = $user_id;
			if ($this->core_model->insert('category', $data)) {
				if (!empty($image_byte)) {
					if (!is_dir($imagePath)) {
						mkdir($imagePath, 0777, true);
					}

					$image = substr($image_byte, strpos($image_byte, ",") + 1);
					$decode = base64_decode($image);
					$fp = fopen($imagePath . '/' . $image_name, 'w+');
					fwrite($fp, $decode);
				}
				echo json_encode(array('status' => 'success', 'message' => $this->lang->line('category') . ' ' . $this->lang->line('saved')));
			} else {
				echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . ' ' . $this->lang->line('category')));
			}
		} else {
			unset($data['created_by']);
			$data['updated_at'] = date("Y-m-d H:i:s");

			$id = $this->input->post('id');
			$category = $this->core_model->get_by_id('category', array('id' => $id));
			if ($imagePath) {
				if ($category->image) { // if have image
					$oldImage = $category->image; //to remove
				}
			}

			if ($this->core_model->update('category', $data, array('id' => $id))) {

				if ($imagePath) {
					if (!is_dir($imagePath)) {
						mkdir($imagePath, 0777, true);
					}
					$image = substr($image_byte, strpos($image_byte, ",") + 1);
					$decode = base64_decode($image);
					$fp = fopen($imagePath . '/' . $image_name, 'w+');
					fwrite($fp, $decode);
				}

				echo json_encode(array('status' => 'success', 'message' => $this->lang->line('category') . ' ' . $this->lang->line('updated')));
			} else {
				echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . ' ' . $this->lang->line('category')));
			}
		}
	}

	public function create()
	{
		echo $this->load->view('category/_form', null, true);
	}

	public function edit()
	{
		echo $this->load->view('category/_form', $this->getCategory(), true);
	}

	function getAll()
	{
		echo $this->load->view('category/_table',
			array('categories' => $this->core_model->get_all('category', ['is_service' => is_service()], ['name']),
				'is_service' => is_service()
			), true
		);
	}

	public function getCategory()
	{
		$category = $this->core_model->get_by_id('category', array('id' => $_POST['id']));
		return array(
			'category' => $category,
			'products' => $this->core_model->get_all('product', array('category_id' => $category->id))
		);
	}

	public function show()
	{
		echo $this->load->view('category/_show', $this->getCategory(), true);
	}


	public function delete()
	{
		header('Content-Type: application/json');

		$category = $this->core_model->get_by_id('category', array('id' => $_POST['id']));

		$category_id = $_POST['id'];
		$products = $this->category_model->count_products($category_id);

		if ($products > 0) {
			if ($category->parent_id) {
//				$parent = $this->core_model->get_by_id('category',array('id'=>$category->parent_id));
				foreach ($this->core_model->get_all('product', array('category_id' => $category_id)) as $product) {
					$this->core_model->update('product', array('category_id' => $category->parent_id), array('id' => $product->id));
				}
				$this->core_model->delete('category', array('id' => $category_id));

				echo json_encode(array('ok' => true, 'message' => 'has parent: ' . $category->parent_id));
			} else {
				echo json_encode(array('ok' => false, 'message' => 'have not parent'));
			}
		} else {
			$this->core_model->delete('category', array('id' => $category_id));
			echo json_encode(array('ok' => true, 'message' => 'can be deleted'));
		}
	}


	public function history()
	{
		header('Content-Type: application/json');

		$data = array(
			'categories' => $this->core_model->get_all_order('category'),
		);
		echo json_encode(array('table' => $this->load->view('category/_history', $data, true), 'target' => $this->lang->line('category')));
	}

	public function get_category(){
		header('Content-Type: application/json');

		$data = null;
		foreach ($this->core_model->get_all('category') as $category){
			$line = [
				'_id' => $category->id,
				'name' => $category->name,
				'category' => $category->name,
			];
			$data[] = $line;
		}
		echo json_encode($data);
	}
}
