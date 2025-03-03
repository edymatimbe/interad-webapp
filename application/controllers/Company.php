<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Company extends CI_Controller
{
	protected $company;

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			$this->session->set_flashdata('info', 'your session has expired');
			redirect(base_url('auth'));
		}

		$this->company = $this->core_model->get_by_id('company',array('id'=>$this->session->userdata('company_id')));
	}

	public function index()
	{
		$data = array(

			'title' => 'General Infomation',
			'styles' => array(
				'css/croppie.css',
				'assets/company/company.css',
			),
			'scripts' => array(
				'js/croppie.js',
				'vendor/mask/jquery.mask.min.js',
				'vendor/mask/app.js',
				'assets/company/company.js',
			),
			'menu_active' => 'menu-system',
			'sub_menu_active' => 'general',
			'company' => $this->core_model->get_by_id('company', array('id' => $this->company->id)),
			'responsible' => $this->core_model->get_by_id('users', array('id'=>$this->company->resposible_id)),
		);
		$this->load->view('company/index', $data);
	}

	public function save()
	{
		header('Content-Type: application/json');

		$this->form_validation->set_rules('name', 'nome', 'required|min_length[5]|max_length[145]');
//		$this->form_validation->set_rules('telephone', '', 'required|max_length[25]');
//		$this->form_validation->set_rules('phone', '', 'required|max_length[25]');
//		$this->form_validation->set_rules('email', '', 'required|valid_email|max_length[100]');
		$this->form_validation->set_rules('site_url', '', 'valid_url|max_length[100]');
//		$this->form_validation->set_rules('nuit', '', 'required|exact_length[9]');
		$this->form_validation->set_rules('address', '', 'max_length[145]');
		$this->form_validation->set_rules('city', 'Cidade', 'max_length[25]');
//		$this->form_validation->set_rules('state_region', 'State', 'required|max_length[50]');
		$data = elements(
			array(
				'name',
				'nuit',
				'phone',
				'phone2',
				'telephone',
				'email',
				'site_url',
				'address',
				'city',
				'state_region',
			),
			$this->input->post()
		);

		$user_id = $this->ion_auth->get_user_id();

		$image_byte = $this->input->post('image');
		$imagePath_old = 'companies/'.str_replace(' ','_',remove_accents($this->company->name)).'';
		$imagePath = 'companies/'.str_replace(' ','_',remove_accents($data['name'])).'';

		rename($imagePath_old,$imagePath);

		if(!is_dir($imagePath)){
			mkdir($imagePath,0777,true);
		}
		$imagePath = $imagePath.'/logo.jpg';

		if ($image_byte) {
			$data['image'] = $imagePath;
		}

		$data['password'] = md5($this->input->post('password'));
		if ($this->form_validation->run()) {
			$data = html_escape($data);
			if ($_POST['action'] == 'update') {
				$data['updated_by'] = $user_id;
				$data['updated_at'] = date("Y-m-d H:i:s");
				if ($this->core_model->update('company', $data, array('id' => $_POST['id']))) {
					if ($image_byte) {

						if ($imagePath) {
							unlink($imagePath);
						}

						$image = substr($image_byte, strpos($image_byte, ",") + 1);
						$decode = base64_decode($image);
						$fp = fopen($imagePath, 'w+');
						fwrite($fp, $decode);
					}
					echo json_encode(
						array(
							'status' => 'success',
							'message' => 'dados actualizados com sucesso',
							'account'=> $this->load->view('settings/_account',
								array(
									'company' => $this->core_model->get_by_id('company', array('id'=>$this->company->id)),
									// 'responsible' => $this->core_model->get_by_id('users', array('id'=>$this->company->responsible_id))
								),true
							)
//							'profile'=> $this->load->view('company/_profile',
//								array(
//									'company' => $this->company,
//									'responsible' => $this->core_model->get_by_id('users', array('id'=>$this->company->responsible_id))
//								),true
//							)
						));
				} else {
					echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . ' ' . $this->lang->line('company')));
				}
			}else{
				echo json_encode(array('status' => 'error', 'message' => $this->lang->line('save') . ' ' . $this->lang->line('company')));
			}
		} else {
			$errors_validation = $this->form_validation->error_array();
			$array_keys = array_keys($errors_validation);
			$array_values = array_values($errors_validation);
			$errors = array_combine($array_keys,$array_values);
			echo json_encode(array('status' => 'error_validation', 'message' => 'error validation', 'error' => $errors));
		}
	}

	public function edit()
	{
		echo $this->load->view('company/_edit',
			array(
				'company' => $this->core_model->get_by_id('company', array('id' => $_POST['id']))
			),
			true
		);
	}


	public function back_accounts(){

	}
}
