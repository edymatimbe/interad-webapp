<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Base extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			$this->session->set_flashdata('info', 'your session has expired');
			redirect(base_url('auth'));
		}
	}

	function notFound()
	{
		$this->load->view('notFound');
	}

	function activeOrNot()
	{
		$user_id = $this->ion_auth->get_user_id();
		$data = elements(
			array(
				'active'
			),
			$this->input->post()
		);
		$data['updated_at'] = date("Y-m-d H:i:s");
		$data['updated_by'] = $user_id;

		$id = $this->input->post('id');
		$table = $this->input->post('table');
		$data = html_escape($data);
		$this->core_model->update($table, $data, array('id' => $id));
		if ($table == 'customer_group') {
			redirect(base_url('customers-groups'));
		} else {
			redirect(base_url($table));
		}
	}

	function activeOrNot_ajax()
	{
		header('Content-Type: application/json');
		$user_id = $this->ion_auth->get_user_id();
		$data = elements(
			array(
				'active'
			),
			$this->input->post()
		);
		$data['updated_at'] = date("Y-m-d H:i:s");
		$data['updated_by'] = $user_id;

		$id = $this->input->post('id');
		$table = $this->input->post('table');
		$data = html_escape($data);
		if ($this->core_model->update($table, $data, array('id' => $id))) {
			if ($table == 'users') {
				$table = 'user';
			}
			echo json_encode(array('ok' => true, 'message' => $this->lang->line($table) . ' ' . $this->lang->line('updated')));
		} else {
			echo json_encode(array('ok' => false, 'message' => $this->lang->line($this) . ' ' . $this->lang->line('updated')));
		}
	}

}
