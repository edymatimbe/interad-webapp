<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Post extends CI_Controller
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
			'title' => 'Publicidades',
			'croppie' => true,
			'dataTable' => true,
			'styles' => array(
				'assets/customer/customer.css'
			),

		);
		$this->load->view('post/index', $data);
	}

	public function post()
	{

		$data = array(
			'title' => 'Publicidades',
			'croppie' => true,
			'dataTable' => true,
			'styles' => array(
				'assets/customer/customer.css'
			),

		);
		$this->load->view('post/_plan', $data);
	}

	public function form($plan, $id)
	{

		$data = array(
			'title' => 'Formulario de publicidade',
			'styles' => [
				'css/croppie.css',
			],

			'scripts' => [
				
				'vendor/datatables/app.js',
				'js/croppie.js',
			],

		);
		$this->load->view('post/form', $data);
	}

	public function getInputs()
    {
        $id = $_POST['id'];
        if ($id == 3) {
            echo $this->load->view('post/input_check', null, true);
        } elseif ($id == 12) {
            echo $this->load->view('post/input_transference', null, true);
        } elseif ($id == 13) {
            echo $this->load->view('post/input_deposit', null, true);
        }
    }
}
