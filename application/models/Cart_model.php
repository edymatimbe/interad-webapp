<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends CI_Model
{


	private function get_company()
	{
		return $this->core_model->get_by_id('company', array('id' => $this->session->userdata('company_id')));
	}

	private function get_user()
	{
		return $this->core_model->get_by_id('users', array('id' => $this->ion_auth->get_user_id()));
	}




	function drawPDF($data, $table, $id = null, $from_cart = null)
	{
		$data['user'] = $this->get_user()->first_name . ' ' . $this->get_user()->last_name;
		$data['company'] = $this->get_company();
		$data['table'] = $table;
		$data['from_cart'] = $from_cart;
		if ($table != 'invoice')
			$target = $this->core_model->get_by_id($table, array('id' => $id));
		// $data['date'] = date_format(date_create($target->created_at), 'd-m-Y');

		if ($table == 'sale') {
			$payment = $this->core_model->get_by_id('payment', array('id' => $target->payment_id));
			$data['sale'] = $target;
			$data['code'] = $target->code;
			$data['payment'] = $payment;
			$data['payment_method_name'] = $this->core_model->get_by_id('payment_method', array('id' => $payment->method_id))->name;
			$data['customer_id'] = $target->customer_id;
		} elseif ($table == 'invoice') {
			$data['expiry_date'] = date_format(date_create($data['final_date']), 'd-m-Y');
			$data['expired_date'] = date_format(date_create($data['final_date']), 'd-m-Y');
			$data['issued_at'] = date_format(date_create($data['created_at']), 'd-m-Y');
			$data['date'] = date_format(date_create($data['created_at']), 'd-m-Y');
		} elseif ($table == 'quotation') {
			$data['quotation'] = $target;
			$data['code'] = $target->number;
			$data['customer_id'] = $target->customer_id;
			$data['due_date'] = $target->due_date ? date_format(date_create($target->due_date), 'd-m-Y') : date_format(date_create($target->created_at), 'd-m-Y');
		} elseif ($table == 'extract') {
			$data['quotation'] = $target;
			$data['code'] = $target->number;
			$data['customer_id'] = $target->customer_id;
		} elseif ($table == 'purchase') {
			$data['code'] = $target->code;
			$data['supplier_id'] = $target->supplier_id;
		}elseif($table== 'payment'){
			$data['is_receipt'] = true;
			$data['payment'] = $target;
			$data['issued_at'] = date_format(date_create($data['created_at']), 'd-m-Y');
			$data['payment_method_name'] = $this->core_model->get_by_id('payment_method', array('id' => $data['method_id']))->name;
		}

		$this->pdf->load_view('layout/document', $data);
		$options = $this->pdf->getOptions();
		$options->setIsRemoteEnabled(true);
		$this->pdf->setOptions($options);
		$this->pdf->render();

		//		watermark
		$canvas = $this->pdf->getCanvas();
		$fontMetrics = new \Dompdf\FontMetrics($canvas, $options);
		$font = $fontMetrics->getFont('times');

		$w = $canvas->get_width();
		$h = $canvas->get_height();
		$text = "41BC - Publicita";

		$txtHeight = $fontMetrics->getFontHeight($font, 75);
		$textWidth = $fontMetrics->getTextWidth($text, $font, 75);

		$canvas->set_opacity(.2);

		// Specify horizontal and vertical position
		$x = (($w - $textWidth) / 2);
		$y = (($h - $txtHeight) / 2);

		// Writes text at the specified x and y coordinates
		//		$canvas->text($x, $y, $text, $font, 75,null,null,null,-45);

		$output = $this->pdf->output();


		
		
			$invoicePath = 'companies/fortyone.'.$table;
			if (!is_dir($invoicePath)) {
				mkdir($invoicePath, 0777, true);
			}
			$invoicePath .= '/' . $data['code'] . '.pdf';
	



		//		if (is_file(FCPATH . $invoicePath)) {
		//			return chunk_split(base64_encode(file_get_contents(base_url($invoicePath)))); //funcoes que retornam file pdf
		//		} else {
		$fp = fopen($invoicePath, 'w+');
		if (fwrite($fp, $output)) {
			return chunk_split(base64_encode(file_get_contents(base_url($invoicePath))));
		} else {
			return false;
		}
		//		}
	}
	//	services

	private function get_type($type, $invoice_id)
	{
		$this->db->select(array(
			'product.price',
			'product.has_tax as tax',
			$type . '_service.quantity qty',
			$type . '_service.other_price',
		));

		$this->db->join($type . '_service', $type . '_service.' . $type . '_id = ' . $type . '.id', 'LEFT');
		$this->db->join('product', 'product.id =' . $type . '_service.product_id', 'LEFT');
		$this->db->join('category', 'category.id = product.category_id', 'LEFT');
		$this->db->where($type . '.company_id', $this->session->userdata('company_id'));
		$this->db->where($type . '.id', $invoice_id);
		$this->db->where($type . '.is_service', 1);
		$this->db->where($type . '_service.active', 1);
	}

	public function cart_resume($is_cart, $invoice_id = null, $type = null)
	{
		$pay_tax = 0;
		$exempt_tax = 0;
		if ($is_cart) {
			foreach ($this->cart_service->contents() as $item) {
				if ($item['tax'] == 1) :
					$pay_tax += $item['price'] * $item['qty'];
				else :
					$exempt_tax += $item['price'] * $item['qty'];
				endif;
			}
		} else {
			$this->get_type($type, $invoice_id);
			foreach ($this->db->get($type)->result() as $item) {
				$price = $item->other_price ? $item->other_price : $item->price;
				if ($item->tax == 1) :
					$pay_tax += $price * $item->qty;
				else :
					$exempt_tax += $price * $item->qty;
				endif;
			}
		}
		$data['pay_tax'] = $pay_tax;
		$data['exempt_tax'] = $exempt_tax;
		$data['subtotal'] = $pay_tax + $exempt_tax;
		$data['total'] = $data['subtotal'] + $pay_tax * 0.16;
		$data['total_iva'] = $pay_tax * 0.16;
		return $data;
	}

	private function find_total_category($category, $is_cart, $invoice_id = null, $type = null)
	{
		$total = 0;
		if ($is_cart) {
			foreach ($this->cart_service->contents() as $item) {
				$category_id = $item['options']['category_id'];
				if ($category_id == $category->id) {
					$total += $item['price'] * $item['qty'];
				}
			}
		} else {
			if ($type) {
				$this->get_type($type, $invoice_id);
				$this->db->where('category.id', $category->id);
				foreach ($this->db->get($type)->result() as $item) {
					$price = $item->other_price ? $item->other_price : $item->price;
					$total += $price * $item->qty;
				}
			}
		}
		return $total;
	}

	public function category_sum($is_cart, $invoice_id = null, $type = null)
	{
		//		$categories = $this->core_model->get_all('category', ['is_service' => 1, 'in_invoice' => 1]);
		$categories = $this->core_model->get_all('category', ['is_service' => 1, 'active' => 1]);
		$categories_data = array();
		foreach ($categories as $category) {
			$value = $this->find_total_category($category, $is_cart, $invoice_id, $type);
			if ($value > 0) {
				$min = ['name' => $category->name, 'value' => $value];
				array_push($categories_data, $min);
			}
		}
		// array_push($categories_data, ['name' => 'Outros custos', 'value' => $this->other_costs($is_cart, $invoice_id, $type)]);
		return $categories_data;
	}

	private function other_costs($is_cart, $invoice_id = null, $type = null)
	{
		$total = 0;
		if ($is_cart) {
			foreach ($this->cart_service->contents() as $item) {
				$category_id = $item['options']['category_id'];
				if ($category_id == '') {
					$total += $item['price'] * $item['qty'];
				}
			}
		} else {
			if ($type) {
				$this->get_type($type, $invoice_id);
				$this->db->where('category.id', null);
				foreach ($this->db->get($type)->result() as $item) {
					$price = $item->other_price ? $item->other_price : $item->price;
					$total += $price * $item->qty;
				}
			}
		}
		return $total;
	}

	public function get_delivery_details()
	{
		return isset($_COOKIE["delivery"]) ? unserialize($_COOKIE["delivery"]) : false;
	}

	public function getCustomer()
	{
		return get_cookie('customer_service') ? get_cookie('customer_service') : false;
	}

	public function drawPDF_service($data, $type, $is_receipt = null)
	{
		$this->pdf->load_view('invoice/service/pdf', $data);
		$options = $this->pdf->getOptions();
		$options->setIsRemoteEnabled(true);
		$this->pdf->setOptions($options);
		$this->pdf->render();
		if (!$is_receipt) {
			$canvas = $this->pdf->getCanvas();
			$fontMetrics = new \Dompdf\FontMetrics($canvas, $options);
			$font = $fontMetrics->getFont('Nunito');
			$canvas->page_text(534, 33, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0, 0, 0));
		}
		$output = $this->pdf->output();

		$invoicePath = 'companies/' . str_replace(' ', '_', remove_accents($this->get_company()->name)) . '/' . $type . 's/' . date_format(date_create($data['issued_at']), 'Y');
		if (!is_dir($invoicePath)) {
			mkdir($invoicePath, 0777, true);
		}
		$invoicePath .= '/' . $type . '_' . $data['number'] . '_' . date_format(date_create($data['issued_at']), 'Y') . '.pdf';

		$fp = fopen($invoicePath, 'w+');
		if (fwrite($fp, $output)) {
			return chunk_split(base64_encode(file_get_contents(base_url($invoicePath))));
		} else {
			return false;
		}
	}

	function delete_all_service_cookie()
	{
		$this->cart_service->destroy();
		delete_cookie('issued_at');
		delete_cookie('expiry_date');
		delete_cookie('customer');
		delete_cookie('customer_service');
		delete_cookie('delivery');
		delete_cookie('is_edit_quotation');
		delete_cookie('is_edit_quotation_id');
		delete_cookie('sale_service_type');
		delete_cookie('payment_type');
	}

	public function add_item_service($id, $qty = null, $other_price = null)
	{
		$product = $this->core_model->get_by_id('product', array('id' => $id));
		$category = $this->core_model->get_by_id('category', array('id' => $product->category_id));
		$price = $other_price ? $other_price : $product->price;

		$new_data = array(
			'id' => $id,
			'qty' => $qty ? $qty : 1,
			'price' => $price,
			'name' => $product->name,
			'tax' => $product->has_tax,
			'options' => array(
				'image' => $product->image,
				'note' => '',
				'discount' => 0,
				'discount_percent' => 0,
				'other_price' => 0,
				'category_id' => $category ? $category->id : '',
			)
		);
		$this->cart_service->insert($new_data);
	}

	public function available_services()
	{
		$services = $this->core_model->get_all('product', array('active' => 1, 'is_service' => 1), ['name']);
		$last_services = array();
		foreach ($services as $service) {
			if (!$this->get_array_key($service->id)) {
				array_push($last_services, $service);
			}
		}
		return $last_services;
	}

	private function get_array_key($id)
	{
		foreach ($this->cart_service->contents() as $key => $val) {
			if ($val['id'] == $id) {
				return true;
			}
		}
		return false;
	}
}
