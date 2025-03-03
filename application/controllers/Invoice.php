<?php

defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Invoice extends CI_Controller
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
	}

	public function get_invoice()
	{
		header('Content-Type: application/json');
		$id = $_POST['id'];
		echo json_encode($this->get_invoice_inner($id));
	}
	public function get_invoice_note()
	{
		header('Content-Type: application/json');
		$id = $_POST['id'];
		echo json_encode($this->get_invoice_inner($id));
	}

	public function get_invoice_inner($id)
	{
		$data = $this->get_invoice_data($id);

	

		




			$b64Doc = $this->cart_model->drawPDF($data, 'invoice', $id, false);
			return array('modal' => $this->load->view('layout/doc_modal', $data, true), 'pdf' => $b64Doc);
		
	}

	

	public function get_invoice_data($invoice_id)
	{

		
		$result = $this->setting_model->get_billing(['controller.id' =>$invoice_id])[0];
		$data = [
			'company'  		=> get_by_id('company', ['id' => 1]),
			'customer' 		=> get_by_id('users', ['id' => $result->user_id]),
			'periodicity' 	=> $result->periodicity,
			'multiplier' 	=> $result->multiplier,
			'count_tax' 	=> count(get_all('controller_tax', ['controller_id' => $result->controller_id])),
			'video_duration' => $result->video_duration,
			'video_amount' 	=> $result->cost,
			'number' 	=> $result->code,
			'code' 	=> $result->code,
			'type' => 'saved',
			'controller_id' => $result->controller_id,
			'created_at' => $result->created_at,
			'final_date' => $result->final_date,
			'id' =>$invoice_id
			
		];
		return $data;
	}

	public function get_payments()
	{
		$invoice_id = $_POST['id'];
		$data = $this->get_invoice_data($invoice_id);
		$details = $this->invoice_model->get_details(array('invoice.id' => $_POST['id']));
		$data['payments'] = $details;
		echo $this->load->view('invoice/_payment', $data, true);
	}

	public function filter()
	{
		$init_date = $_POST['init_date'];
		$final_date = $_POST['final_date'];
		$data = array(
			'DATE_FORMAT(controller.created_at,"%Y-%m-%d")>=' => $init_date,
			'DATE_FORMAT(controller.created_at,"%Y-%m-%d")<=' => $final_date,
			'controller.active' => 1
		);
		if (!empty($_POST['status'])) {
			$data['controller.status'] = $_POST['status'];
		}
		if (!empty($_POST['customer'])) {
			$data['controller.created_by'] = $_POST['customer'];
		}

		echo $this->load->view('invoice/_table', array('invoices' =>  $this->setting_model->get_billing($data)), true);
	}

	public function history()
	{
		header('Content-Type: application/json');

		foreach ($this->core_model->get_all('invoice', array('status' => 'pendente')) as $invoice) {
			if ($this->invoice_model->get_debt($invoice->id) <= 0) {
				//				$this->core_model->update('invoice', array('status' => 'paga'), array('id' => $invoice->id));
			}
			if (date('Y/m/d') > date_format(date_create($invoice->payment_limit), 'Y/m/d')) {
				$this->core_model->update('invoice', array('status' => 'vencido'), array('id' => $invoice->id));
			}
		}

		if (is_service() == 1) {
			set_cookie('sale_service_type', 'invoice', time() + 3600);
		}

		$data = array(
			'invoices' => $this->core_model->get_all('invoice', array('DATE_FORMAT(created_at,"%Y-%m-%d")' => date('Y-m-d'), 'active' => 1, 'is_service' => is_service()), true),
		);
		echo json_encode(array('table' => $this->load->view('invoice/_history', $data, true), 'target' => $this->lang->line('invoice')));
	}

	public function edit($id)
	{
		if ($this->ion_auth->in_group(array('admin', 'super admin'))) {
			$invoice = $this->core_model->get_by_id('invoice', array('id' => $id));
			$this->session->set_userdata('invoice_edit', $invoice->id);
			$this->session->set_userdata('source', 'credit');
			if (!$invoice->tax) {
				$tax = $invoice->total - $invoice->subtotal;
				$this->core_model->update('invoice', ['tax' => $tax], ['id' => $invoice->id]);
			}

			$items = $this->invoice_model->get_invoice_items($id);
			if (is_service() == 1) {
				$this->cart_service->destroy(); //destroy cart
				foreach ($items as $item) {
					$price = $item->other_price ? $item->other_price : $item->price;
					$this->cart_model->add_item_service($item->product_id, $item->qty, $price);
				}
			}else{
				$this->cart_service->destroy(); //destroy cart
				foreach ($items as $item) {
					$price = $item->other_price ? $item->other_price : $item->price;
					$this->cart_model->add_item_service($item->product_id, $item->quantity, $price);
				}
			}
			$data = array(
				'title' => $this->lang->line('edit') . ' ' . $this->lang->line('invoice'),
				'invoice' => $invoice,
				'items' => $items,
				'customer_id' => $invoice->customer_id,
				'customers' => $this->core_model->get_all('customer', ['active' => 1]),
				'source' => 'credit'
			);
			$this->load->view('invoice/edit', $data);
		} else {
			if (is_service() == 1) {
				redirect(base_url('invoices-service'));
			} else {
				redirect(base_url('sales'));
			}
		}
	}

	public function update_edit_table()
	{
		header('Content-Type: application/json');
		$invoice_id = $this->session->userdata('invoice_edit');

		$data = [
			'source' => $this->session->userdata('source'),
			'invoice' => $this->core_model->get_by_id('invoice', ['id' => $invoice_id]),

		];
		echo json_encode(['table' => $this->load->view('invoice/_edit_table', $data, true)]);
	}

	public function update_item_edit()
	{
		$rowId = $_POST['rowid'];
		$this->cart_service->update(array(
			'rowid' => $rowId,
			'qty' => $_POST['quantity'],
			'price' => $_POST['price'],
		));
		$response['ok'] = true;
		$response['status'] = 'success';
		$response['message'] = 'Item actualizado com sucesso';
		echo json_encode($response);
	}


	function search_value($value, $array, $reference)
	{
		foreach ($array as $key => $item) {
			if ($item[$reference] == $value) {
				return $item;
			}
		}
		return 0;
	}


	public function save_note()
	{
		header('Content-Type: application/json');

	
		$invoice_id = $this->session->userdata('invoice_edit');
		$invoice = $this->core_model->get_by_id('invoice', ['id' => $invoice_id]);
		$items = $this->invoice_model->get_invoice_items($invoice_id);
		$cart = $this->cart_model->cart_resume(true);
		$response = [];
		$check_edited = [];
		if(is_service() == 1){
			foreach ($items as $item) {
				$search_value = $this->search_value($item->product_id, $this->cart_service->contents(), 'id');
				if ($search_value) {
					if ($item->price != $search_value['price'] || $item->qty != $search_value['qty']) {
						array_push($check_edited, true);
					}
				}
			}
		}else{
			foreach ($items as $item) {
				$search_value = $this->search_value($item->product_id, $this->cart_service->contents(), 'id');
				if ($search_value) {
					if ($item->price != $search_value['price'] || $item->quantity != $search_value['qty']) {
						array_push($check_edited, true);
					}
				}
			}
		}


	
		$can = false;
		$source =  $_POST['type_note'];
		if ($source == 'credit') {
			if (in_array(true, $check_edited)) {
				$can = true;
			} else {
				$response['message'] = 'Nenhum dado modificado';
				if ($cart['total'] <= $invoice->total) {
					$can = true;
				} else {
					$response['message'] = 'o valor da nota de credito é maior que o valor da factura!';
				}
			}
			$response['type'] = 'credit';
		}else{
			if (in_array(true, $check_edited)) {
				$can = true;
			} else {
				$response['message'] = 'Nenhum dado modificado';
				if ($cart['total'] > $invoice->total) {
					$can = true;
				} else {
					$response['message'] = 'o valor da nota de credito é maior que o valor da factura!';
				}
			}
			$response['type'] = 'debit';
		}

		if ($can) {
			$number = $this->core_model->code_generator('note', ['is_service' => is_service()]);
			$note = [
				'number' => $number,
				'invoice_id' => $invoice->id,
				'type' => $source,
				'reason_note' => get_cookie('reason_note'),
				'subtotal' => $cart['subtotal'],
				'tax' => $cart['total_iva'],
				'total' => $cart['total'],
				'created_by' => $this->user_id,
				'updated_by' => $this->user_id,
				'company_id' => $this->company->id,
				'is_service' => is_service(),
			];

			if ($this->core_model->insert('note', $note)) {
				$note_id = $this->session->userdata('last_id');
				$note_product = array();
				if (is_service()) {
					foreach ($this->cart_service->contents() as $item) {
						$min = [
							'note_id' => $note_id,
							'product_id' => $item['id'],
							'quantity' => $item['qty'],
							'price' => $item['price']
						];
						$note_product[] = $min;
					}
					if (count($note_product)) {
						if ($this->core_model->insert_batch('note_product', $note_product)) {
							$response['ok'] = true;
							// $response['status'] = 'success';
							// $response['message'] = 'Salvo com sucesso';
							// $response['service'] = is_service();
						} else {
							$response['ok'] = false;
							$response['status'] = 'error';
							$response['message'] = 'Erro ao tentar items de nota';
						}
					}
				}else{
					
					foreach ($this->cart_service->contents() as $item) {
						$batch = $this->core_model->get_all('batch', array('product_id' => $item['id']), ['id','DESC'], null, 1)[0];
						$min = [
							'note_id' => $note_id,
							'product_id' => $item['id'],
							'quantity' => $item['qty'],
							'price' => $item['price']
						];
						$note_product[] = $min;

						if ($source == 'credit') {
							$newQuantity = $batch->stock + $item['qty'];
						}else{
							$newQuantity = $batch->stock - $item['qty'];
						}
						

						$batch_array = array(
							'stock' => $newQuantity,
							'updated_at' => date("Y-m-d H:i:s"),
							'updated_by' => $this->user_id,
						);
						update('batch',
							$batch_array,
							array('id' => $batch->id)
						);
					}
					if (count($note_product)) {
						if ($this->core_model->insert_batch('note_product', $note_product)) {
							$response['ok'] = true;
							$response['status'] = 'success';
							$response['message'] = 'Salvo com sucesso';
							$response['service'] = is_service();
							$response['stock'] = $batch_array;
						} else {
							$response['ok'] = false;
							$response['status'] = 'error';
							$response['message'] = 'Erro ao tentar items de nota';
						}
					}
				}
			} else {
				$response['ok'] = false;
				$response['message'] = 'Erro ao tentar nota';
			}
		}

		echo json_encode($response);
	}

	function notes()
	{

		header('Content-Type: application/json');
		$data = array(
			'notes' => $this->core_model->get_all('note', array('DATE_FORMAT(created_at,"%Y-%m-%d")' => date('Y-m-d'), 'active' => 1, 'is_service' => is_service()), true)
		);

		echo json_encode(array('table' => $this->load->view('invoice/_notes', $data, true)));
	}

	public function updateInvoice($id)
	{
		$subtotal = 0;
		$total = 0;
		$invoiceList = $this->invoice_model->get_invoice_items($id);
		if (count($invoiceList)) {
			foreach ($invoiceList as $item) {
				$price = $item->other_price == 0 ? $item->price : $item->other_price;
				$subtotal += $price * $item->quantity;
			}
			$total = $subtotal + $subtotal * taxMath();
		}
		$this->core_model->update('invoice', array('subtotal' => $subtotal, 'total' => $total), array('id' => $id));
	}

	public function disable_invoice()
	{
		$invoice = $this->core_model->get_by_id('invoice', array('id' => $_POST['id'], 'active' => 1));
		foreach ($this->invoice_model->get_invoice_items($invoice->id) as $item) {
			$batch = $this->core_model->get_by_id('batch', array('id' => $item->batch_id));
			$new_stock = $batch->stock + $item->quantity;
			$this->core_model->update(
				'batch',
				array(
					'updated_by' => $this->user_id,
					'updated_at' => date("Y-m-d H:i:s"),
					'stock' => $new_stock
				),
				array('id' => $item->batch_id)
			);
			$this->core_model->update(
				'invoice_batch',
				array(
					'active' => 0,
					'updated_at' => date("Y-m-d H:i:s"),
				),
				array('id' => $item->invoice_batch_id)
			);
		}
	}

	//services
	public function index()
	{
		
		$data = array(
			'title' => $this->lang->line('invoices'),
			'styles' => array(
				'vendor/datatables/dataTables.bootstrap4.min.css',
				'vendor/daterangepicker/daterangepicker.css',
			),

			'scripts' => array(
				'vendor/moment/moment.js',
				'vendor/daterangepicker/daterangepicker.js',
				'vendor/datatables/jquery.dataTables.min.js',
				'vendor/datatables/dataTables.bootstrap4.min.js',
				'vendor/datatables/app.js',
				'vendor/print-js/print.min.js', 
			),
			'invoices' => $this->setting_model->get_billing()
		);
		$this->load->view('invoice/index', $data);
	}

	

	public function create_service()
	{
		set_cookie('is_service', 1, time() + 3600);
		delete_cookie('is_edit_quotation');
		$data = array(
			'title' => $this->lang->line('new2') . ' ' . $this->lang->line('sale') . ' de serviços',
			'scripts' => array(
				'vendor/print-js/print.min.js',
				'assets/sale/create.js',
				'assets/payment/payment.js',
				'vendor/input-spinner/bootstrap-input-spinner.js',
				'js/app.js',
			),
			'customer_id' => $this->cart_model->getCustomer(),
			'customers' => $this->core_model->get_all('customer', array('active' => 1), ['name']),
			'subtotal_cart' => $this->cart_service->total(),
			'total' => $this->cart_service->total(),
			'source' => $this->getSource(),
			'services' => $this->cart_model->available_services(),
			'issued_at' => get_cookie('issued_at') ? get_cookie('issued_at') : date('Y-m-d'),
			'expiry_date' => get_cookie('expiry_date') ? get_cookie('expiry_date') : date('Y-m-d')
		);
		$this->load->view('invoice/service/create', $data);
	}

	public function add_item_service()
	{
		header('Content-Type: application/json');
		$product_id = $_POST['id'];
		$this->add_item_service_in($product_id);
		echo json_encode(array('ok' => true, 'message' => 'done'));
	}

	private function add_item_service_in($id, $qty = null, $other_price = null)
	{
		$this->cart_model->add_item_service($id, $qty, $other_price);
	}

	public function remove_item_service()
	{
		header('Content-Type: application/json');
		$this->cart_service->remove($_POST['id']);
		echo json_encode(array('ok' => true));
	}

	public function remove_item_from_edit()
	{
		header('Content-Type: application/json');
		if (is_service() == 1) {
			$this->cart_service->remove($_POST['id']);
		} else {
			$this->cart->remove($_POST['id']);
		}
		echo json_encode(array('ok' => true));
	}

	public function update_cart_service_item()
	{
		$product = $this->core_model->get_by_id('product', ['id' => $_POST['product_id']]);
		$rowId = $_POST['id'];
		$details = $this->cart_service->product_options($rowId);
		$this->cart_service->update(array(
			'rowid' => $rowId,
			'name' => $product->name,
			'qty' => $_POST['quantity'],
			'price' => $_POST['price'],
			'tax' => $product->has_tax,
			'options' => array(
				'image' => $details['image'],
				'note' => $details['note'],
				'discount' => $details['discount'],
				'discount_percent' => $details['discount_percent'],
				'other_price' => 1,
				'category_id' => $details['category_id'],
			),
		));
		echo '';
	}

	public function get_cart_service()
	{
		$data = array(
			'customer_id' => $this->cart_model->getCustomer(),
			'customers' => $this->core_model->get_all_order('customer', array('active' => 1)),
			'subtotal_cart' => $this->cart_service->total(),
			'total' => $this->cart_service->total(),
			'source' => $this->getSource(),
		);

		if (get_cookie('is_edit_quotation')) {
			$data['is_edit'] = 1;
		}
		return $data;
	}

	public function getSource()
	{
		return get_cookie('sale_service_type') ? get_cookie('sale_service_type') : 'invoice';
	}

	public function update_cart_service()
	{
		header('Content-Type: application/json');
		echo json_encode(
			array(
				'cart' => $this->load->view('invoice/service/_cart', $this->get_cart_service(), true),
				'services' => $this->load->view('invoice/service/_services', array('services' => $this->cart_model->available_services()), true),
			)
		);
	}

	public function get_delivery_details()
	{
		$delivery = $this->cart_model->get_delivery_details();
		$data = array();
		if ($delivery) {
			$data['delivery'] = $delivery;
		}
		echo $this->load->view('invoice/service/_delivery', $data, true);
	}

	public function save_delivery_details()
	{
		$delivery = elements(
			array(
				'merchandise_type',
				'regime',
				'transport',
				'other_reference',
				'waybill',
				'supplier',
				'address',
				'invoice_number',
				'fob',
				'cif',
				'fret_insurance',
				'arrival_date',
				'terminal',
				'exchange',
				'cif_mt',
				'du',
				'transport_doc',
				'contact',
				'currency',
			),
			$this->security->xss_clean( $this->input->post())           

		);
		$deliveryCookie = serialize($delivery);
		set_cookie('delivery', $deliveryCookie, time() + 3600);
		echo json_encode(array('status' => 'success', 'message' => 'Detalhes de transporte prontos para serem salvos'));
	}

	public function show_invoice_service()
	{
		$data = array(
			'company' => $this->company,
			'bank_accounts' => $this->core_model->get_all('bank_account'),
			'customer' => $this->core_model->get_by_id('customer', ['id' => $this->cart_model->getCustomer()]),
			'categories_sum' => $this->cart_model->category_sum(true),
			'number' => $this->core_model->code_generator('invoice', ['is_service' => is_service()]),
			'issued_at' => get_cookie('issued_at') ? get_cookie('issued_at') : date('Y-m-d'),
			'expiry_date' => get_cookie('expiry_date') ? get_cookie('expiry_date') : date('Y-m-d'),
			'is_cart' => 1
		);
		$data = array_merge($data, $this->cart_model->cart_resume(true));
		$delivery = $this->cart_model->get_delivery_details();
		if ($delivery) {
			$data['delivery'] = $delivery;
		}

		echo $this->load->view('invoice/service/_modal', $data, true);
	}

	public function save_invoice_service()
	{
		header('Content-Type: application/json');
		$code = $this->core_model->code_generator('invoice', ['is_service' => 1]);
		$cart = $this->cart_model->cart_resume(true);
		$invoice_array = array(
			'number' => $code,
			'created_by' => $this->user_id,
			'updated_by' => $this->user_id,
			'total' => $cart['total'],
			'discount' => 0,
			'subtotal' => $cart['subtotal'],
			'note' => '',
			'customer_id' => $this->cart_model->getCustomer(),
			'payment_limit' => get_cookie('expiry_date') ? get_cookie('expiry_date') : date('Y-m-d'),
			'issued_at' => get_cookie('issued_at') ? get_cookie('issued_at') : date('Y-m-d'),
			'is_service' => is_service()
		);

		$sale_saved = $this->core_model->insert('invoice', $invoice_array);
		if ($sale_saved) {
			$invoice_id = $this->session->userdata('last_id');
			foreach ($this->cart_service->contents() as $item) :
				$invoice_service = array(
					'product_id' => $item['id'],
					'invoice_id' => $invoice_id,
					'quantity' => $item['qty'],
					'created_by' => $this->user_id,
					'updated_by' => $this->user_id,
					'other_price' => $item['price']
				);
				$this->core_model->insert('invoice_service', $invoice_service);
			endforeach;

			$delivery = $this->cart_model->get_delivery_details();
			if ($delivery) {
				$delivery['invoice_id'] = $invoice_id;
				$delivery['created_by'] = $this->user_id;
				$delivery['updated_by'] = $this->user_id;
				$this->core_model->insert('delivery_details', $delivery);
			}

			$return = $this->get_invoice_inner($invoice_id);
			$this->cart_model->delete_all_service_cookie();
			echo json_encode(array('ok' => true, 'b64Doc' => $return['pdf'], 'message' => 'Factura salva com sucesso'));
		} else {
			echo json_encode(array('ok' => false, 'b64Doc' => false));
		}
	}

	public function set_my_cookie()
	{
		set_cookie($_POST['target'], $_POST['value'], time() + 3600);
	}

	public function show_note()
	{
		header('Content-Type: application/json');
		$id = $_POST['id']; // $id from note
		$note = get_by_id('note', ['id' => $id]);
		$pay_tax = 0;
		$exempt_tax = 0;

		$invoice = get_by_id('invoice', array('id' => $note->invoice_id));
		$items = $this->invoice_model->get_note_items($id);
		$data = array(
			'id' => $note->id,
			'date' => $note->created_at,
			'code' => $note->number,
			'subtotal' => $note->subtotal,
			'tax' => $note->tax,
			'total' => $note->total,
			'discount' => 0,
			'invoice_number' => $invoice->number,
			'date_2' => $invoice->created_at,
			'customer_id' => $invoice->customer_id,
			'customer' => get_by_id('customer', array('id' => $invoice->customer_id)),
			'seller' => '',
			'note' => $note->reason_note,
			'company' => $this->company,
			'items' => $items,
			'issued_at' => $note->created_at,
			'number' => $note->number,
			'type' => $note->type,
			'table' => "note"
		);



		$delivery = $this->core_model->get_by_id('delivery_details', array('invoice_id' => $invoice->id));
		if ($delivery) {
			$array = json_decode(json_encode($delivery), true);
			$data['delivery'] = $array;
		}
		foreach ($items as $item) {
			if ($item->tax == 1) :
				$pay_tax += $item->price * $item->qty;
			else :
				$exempt_tax += $item->price * $item->qty;
			endif;
		}
		$data['pay_tax'] = $pay_tax;
		$data['exempt_tax'] = $exempt_tax;

		$data['total_iva'] = $pay_tax * taxMath();
		$data['categories_sum'] = $this->cart_model->category_sum(false, $invoice->id, 'invoice');

		$data['bank_accounts'] = $this->core_model->get_all('bank_account');
		$data['is_cart'] = 0;
		$data['object'] = $note->type == 'credit' ? 'Nota de credito' : 'Nota de debito';
		$data['is_note'] = true;
		$b64Doc = $this->cart_model->drawPDF_service($data, 'note');
		// echo json_encode(array('modal' => $this->load->view('invoice/service/_modal', $data, true),  'pdf' => $b64Doc));
		echo json_encode(array('modal' => $this->load->view('layout/modal', $data, true),  'pdf' => $b64Doc));
	}

	public function filter_note()
	{
		$init_date = $_POST['init_date'];
		$final_date = $_POST['final_date'];
		$data = array(
			'DATE_FORMAT(note.created_at,"%Y-%m-%d")>=' => $init_date,
			'DATE_FORMAT(note.created_at,"%Y-%m-%d")<=' => $final_date,
		);
		// if ($_POST['customer']) {
		// 	$data['customer.id'] = $_POST['customer'];
		// }
		// echo json_encode(array('modal' => $this->load->view('invoice/service/_modal', $data, true),  'pdf' => $b64Doc));
		echo $this->load->view('invoice/_table_note', array('notes' => get_all('note', $data, true)), true) ;
	}
}
