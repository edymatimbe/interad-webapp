<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Package extends CI_Controller
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

		$data = array(
			'title' => 'Pacotes',
			'croppie' => true,
			'dataTable' => true,
			'styles' => array(
				'assets/customer/customer.css'
			),
            
		);
		$this->load->view('package/index', $data); 
	}

}
