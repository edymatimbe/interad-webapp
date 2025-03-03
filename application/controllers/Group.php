<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Group extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			$this->session->set_flashdata('info', 'your session has expired');
			redirect(base_url('auth'));
		}
	}

	function getAll()
	{
		$table = $this->input->post('table');
		$data = array();
		if($table == 'customer'){
			$groups = $this->core_model->get_all('customer_group');
		}else{
			$groups = $this->core_model->get_all('supplier_group');
		}

		$data['groups']=$groups;
		$data['table']=$table;
		echo $this->load->view('group/_table', $data, true);
	}

	public function save()
	{
		header('Content-Type: application/json');

		$action = $this->input->post('action'); //create or udate
		$table = $this->input->post('table');
		$user_id = $this->ion_auth->get_user_id();

		$data = elements(
			array(
				'name',
			),
			$this->input->post()
		);

		$data['updated_by'] = $user_id;

		if ($action == 'create') {
			$data['created_by'] = $user_id;
			$data = html_escape($data);
			if($table === 'customer'){
				if($this->core_model->insert('customer_group', $data)){
					echo json_encode(array('status' => 'success', 'message' => $this->lang->line('group').' '.$this->lang->line('saved')));
				}else{
					echo json_encode(array('status' => 'error', 'message' =>$this->lang->line('saved_error').' '.$this->lang->line('group')));
				}
			}else{
				if($this->core_model->insert('supplier_group', $data)){
					echo json_encode(array('status' => 'success', 'message' => $this->lang->line('group').' '.$this->lang->line('saved')));
				}else{
					echo json_encode(array('status' => 'error', 'message' =>$this->lang->line('saved_error').' '.$this->lang->line('group')));
				}
			}
		} else {
			$data['updated_at'] = date("Y-m-d H:i:s");

			$data = html_escape($data);
			$id = $this->input->post('id');
			if($table === 'customer'){
				if($this->core_model->update('customer_group', $data, array('id' => $id))){
					echo json_encode(array('status' => 'success', 'message' => $this->lang->line('group').' '.$this->lang->line('updated')));
				}else{
					echo json_encode(array('status' => 'error', 'message' =>$this->lang->line('saved_error').' '.$this->lang->line('group')));
				}
			}else{
				if($this->core_model->update('supplier_group', $data, array('id' => $id))){
					echo json_encode(array('status' => 'success', 'message' => $this->lang->line('group').' '.$this->lang->line('updated')));
				}else{
					echo json_encode(array('status' => 'error', 'message' =>$this->lang->line('saved_error').' '.$this->lang->line('group')));
				}
			}
		}
	}

	public function create()
	{
		echo $this->load->view('group/_create', null, true);
	}

	public function getGroup()
	{
		$group_id = $_POST['id'];

		if($_POST['table'] === 'customer'){
			return array(
				'group'=>$this->core_model->get_by_id('customer_group',array('id'=>$group_id)),
				'customers' => $this->core_model->get_all('customer',array('group_id'=>$group_id)),
				'table'=>$_POST['table']
			);
		}else{
			return array(
				'group'=>$this->core_model->get_by_id('supplier_group',array('id'=>$group_id)),
				'suppliers' => $this->core_model->get_all('supplier',array('group_id'=>$group_id)),
				'table'=>$_POST['table']
			);
		}
	}

	public function show()
	{
		echo $this->load->view('group/_show', $this->getGroup(), true);
	}

	public function edit()
	{
		echo $this->load->view('group/_edit', $this->getGroup(), true);
	}
}
