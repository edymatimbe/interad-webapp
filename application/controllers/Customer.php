<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Customer extends CI_Controller
{

	protected $company;
	protected $user_id;
	protected $user;

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			$this->session->set_flashdata('info', 'your session has expired');
			redirect(base_url('auth'));
		}
		$this->user_id = $this->ion_auth->get_user_id();
		$this->user = $this->core_model->get_by_id('users', array('id' => $this->user_id));
		$this->company = $this->core_model->get_by_id('company', array('id' => $this->session->userdata('company_id')));

		
		if($this->session->userdata('type_user')  == 3){
			redirect(base_url('advertiser'));
		}
	}

	public function get_customers()
	{
		$this->db->select(array(
			'customer.*',
		));
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->order_by('customer.created_at', 'DESC');
		return $this->db->get('customer')->result();
	}

	public function get_customer($id)
	{
		$this->db->select([
			'customer.*',
			'customer_group.name as group',
		]);
		$this->db->where('customer.company_id', $this->session->userdata('company_id'));
		$this->db->where('customer.id', $id);
		$this->db->join('customer_group', 'customer_group.id = customer.group_id', 'LEFT');
		return $this->db->get('customer')->result()[0];
	}

	public function index()
	{
		$data = array(
			'title' => $this->lang->line('customers'),
			'styles' => array(
				'css/croppie.css',
				'vendor/datatables/dataTables.bootstrap4.min.css',
				'assets/customer/customer.css'
			),

			'scripts' =>
				array(
					'js/croppie.js',
					'vendor/datatables/jquery.dataTables.min.js',
					'vendor/datatables/dataTables.bootstrap4.min.js',
					'vendor/datatables/app.js',
					'assets/customer/customer.js'
				),
			'menu_active' => 'menu-customer',
			'sub_menu_active' => 'customers',
			'customers' => $this->get_customers(),
			'customer_group' => $this->core_model->get_all('customer_group')
		);
		$this->load->view('customer/index', $data);
	}

	public function extract()
	{
		echo $this->load->view('customer/_create', null, true);
//		$this->load->view('customer/extract');
	}

	public function create()
	{
		echo $this->load->view('customer/_create', null, true);
	}

	function show()
	{
		$id = $_GET['id'];
		$customer = $this->get_customer($id);

//		invoices begin
		$total = 0;
		$subtotal = 0;
		$totalPaid = 0;
		$invoices = 0;
		$debt = 0;
		$invoiceList = $this->invoice_model->get_data(array('customer.id' => $id));
		foreach ($invoiceList as $invoice) {
			$totalPaid += $this->invoice_model->get_total_paid($invoice->id);
			$debt += $this->invoice_model->get_debt($invoice->id);
			$total += $invoice->total;
			$subtotal += $invoice->subtotal;
			$invoices += 1;
		}

		$data_invoice = array(
			'subtotal' => $subtotal,
			'total' => $total,
			'totalPaid' => $totalPaid,
			'debt' => $debt,
		);
//		invoices end

//		sales begin
		$this->db->select_sum('amount');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->where('type', 'sale');
		$this->db->where('customer_id', $id);
		$total_amount_sales =  $this->db->get('payment')->row()->amount;
//		sales end

		$this->db->select_sum('total');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->where('customer_id', $id);
		$total_total_quotations =  $this->db->get('quotation')->row()->total;

		$data = array(
			'customer' => $customer,
			'sales' => $this->core_model->get_all('sale', array('customer_id' => $id)),
			'total_amount_sales'=>$total_amount_sales,
			'invoices' => $invoiceList,
			'pending_invoices' => count($this->core_model->get_all('invoice', array('customer_id' => $id,'status'=>'pendente'))),
			'paid_invoices' => count($this->core_model->get_all('invoice', array('customer_id' => $id,'status'=>'paga'))),
			'expired_invoices' => count($this->core_model->get_all('invoice', array('customer_id' => $id,'status'=>'vencido'))),
			'invoice'=>$data_invoice,
			'quotations' =>  $this->core_model->get_all('quotation', array('customer_id' => $id)),
			'total_total_quotations'=>$total_total_quotations
		);
		echo $this->load->view('customer/_show', $data, true);
	}

	function edit()
	{
		$id = $_GET['id'];
		$customer = $this->get_customer($id);
		$data = array(
			'customer' => $customer,
		);
		echo $this->load->view('customer/_edit', $data, true);
	}

	public function email_check($email)
	{
		$id = $this->input->post('id');
		if ($this->core_model->get_by_id('customer', array('barcode' => $email, 'id !=' => $id))) {
			$this->form_validation->set_message('email_check', 'Ja temos um cliente com esse email');
			return false;
		} else {
			return true;
		}
	}

	public function name_check($name)
	{
		$id = $this->input->post('id');
		if ($this->core_model->get_by_id('customer', array('name' => $name, 'id !=' => $id))) {
			$this->form_validation->set_message('name_check', 'Ja temos um cliente com esse nome');
			return false;
		} else {
			return true;
		}
	}

	public function save()
	{
		header('Content-Type: application/json');

		$action = $this->input->post('action'); //create or udate
		$user_id = $this->ion_auth->get_user_id();

//		$this->form_validation->set_rules('name', '', 'trim|required|min_length[3]|max_length[45]|is');

		if ($_POST['action'] === 'create') {
			$this->form_validation->set_rules('name', '', 'trim|required|min_length[3]|max_length[45]|is_unique[customer.name]');
			$this->form_validation->set_rules('email', '', 'trim|valid_email|is_unique[customer.email]');
			$this->form_validation->set_rules('nuit', '', 'trim|required|is_unique[customer.nuit]');
			$this->form_validation->set_rules('phone', 'contacto', 'trim|required|is_unique[customer.phone]');
		} else {
			$this->form_validation->set_rules('name', '', 'trim|required|min_length[3]|max_length[45]|callback_name_check');
//			$this->form_validation->set_rules('email', '', 'trim|valid_email|callback_email_check');

		}
		$data = elements(
			array(
				'name',
				'nuit',
				'email',
				'phone',
				'phone2',
				'address',
				'city',
				'group_id',
				'type',
				'note',
				'responsible_name',
				'responsible_id',
				'responsible_office',
				'registration_number',
				'period_pay',
				'credit',
				'max_credit',
			),
			$this->input->post()
		);
		$data['updated_by'] = $user_id;
		$group_id = $this->input->post('group_id');
		if (!$group_id) {
			unset($data['group_id']);
		}

		$image_byte = $this->input->post('image');
		$code = $this->core_model->code_generator('customer');
		$image_name = 'IMG_' . $code . '.jpg';
		$imagePath = 'companies/' . str_replace(' ', '_', remove_accents($this->company->name)) . '/customers';

		if (!is_dir($imagePath)) {
			mkdir($imagePath, 0777, true);
		}

		if ($image_byte) {
			$data['image'] = $imagePath . '/' . $image_name;
		}

		$data['updated_by'] = $user_id;

		if ($this->form_validation->run()) {
			if ($action == 'create') {
				$data['created_by'] = $user_id;
				$data['code'] = $code;

				$data = html_escape($data);
				$saved = $this->core_model->insert('customer', $data);
				if ($saved) {
					$customerID = $this->session->userdata('last_id');

					if ($image_byte) {
						$image = substr($image_byte, strpos($image_byte, ",") + 1);
						$decode = base64_decode($image);
						$fp = fopen($imagePath . '/' . $image_name, 'w+');
						fwrite($fp, $decode);
					}

					echo json_encode(array(
						'status' => 'success',
						'message' => $this->lang->line('customer') . ' ' . $this->lang->line('saved'),
						'last_id' => $customerID,
						''
					));
				} else {
					echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . ' ' . $this->lang->line('customer')));
				}
			} else {
				$data['updated_at'] = date("Y-m-d H:i:s");
				$data = html_escape($data);

				$id = $this->input->post('id');
				$updated = $this->core_model->update('customer', $data, array('id' => $id));
				if ($updated) {
					if ($image_byte) {
						$image = substr($image_byte, strpos($image_byte, ",") + 1);
						$decode = base64_decode($image);
						$fp = fopen($imagePath . '/' . $image_name, 'w+');
						fwrite($fp, $decode);
					}
					echo json_encode(array('status' => 'success', 'message' => $this->lang->line('customer') . ' ' . $this->lang->line('saved')));
				} else {
					echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . ' ' . $this->lang->line('customer')));
				}
			}
		} else {
			//$errors = validation_errors();
			$errors = array(
				'email' => form_error('email'),
				'name' => form_error('name'),
				'nuit' => form_error('nuit'),
				'phone' => form_error('phone'),
			);
			echo json_encode(array('status' => 'error_validation', 'message' => 'error validation', 'error' => $errors));
		}
	}

	public function getAll()
	{
		$customers = $this->get_customers();
		echo $this->load->view('customer/_table', array('customers' => $customers), true);
	}

	public function getDatePeriod()
	{
		$id = $_POST['id'];
		$data = $this->core_model->get_by_id('customer', array('id' => $id));

		$data1 = $data->period_pay;

		$first_date = date('d-m-Y');
		$date_one = new DateTime($first_date);
		$date_plus = $date_one->modify('+' . $data1 . ' day')->format('d-m-Y');
		echo json_encode($date_plus);

	}

	function groups()
	{
		$data = array(
			'title' => $this->lang->line('groups'),
			'styles' => array(
				'vendor/datatables/dataTables.bootstrap4.min.css',
			),
			'scripts' => array(
				'vendor/datatables/jquery.dataTables.min.js',
				'vendor/datatables/dataTables.bootstrap4.min.js',
				'vendor/datatables/app.js',
				'assets/customer/group.js',
			),
			'menu_active' => 'menu-customer',
			'sub_menu_active' => 'groups',
			'groups' => $this->core_model->get_all('customer_group'),
			'table' => 'customer',
		);
		$this->load->view('customer/groups', $data);
	}
}
