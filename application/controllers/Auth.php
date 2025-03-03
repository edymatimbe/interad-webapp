<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
	}

	public function index()
	{
		if (isset($_SESSION["id_company"]) && !empty($_SESSION["id_company"])) {
			redirect(base_url('/'));
		} elseif ($this->ion_auth->logged_in()) {
			redirect(base_url('dashboard'));
		} else {
			$this->cart_model->delete_all_service_cookie();
			$data = array(
				'title' => 'Login',
			);
			$this->load->view('auth/login', $data);
		}
	}

	public function signup()
	{
		if (isset($_SESSION["id_company"]) && !empty($_SESSION["id_company"])) {
			redirect(base_url('/'));
		} elseif ($this->ion_auth->logged_in()) {
			redirect(base_url('dashboard'));
		} else {
			$data = array(
				'title' => 'Cadastrar',
			);
			$this->load->view('auth/signup', $data);
		}
	}

	function save()
	{
		header('Content-Type: application/json');
		// echo json_encode($this->input->post());
		// die;


		$this->form_validation->set_rules('phone', 'contacto', 'trim');
		$this->form_validation->set_rules('address', 'endereço', 'trim');
		$this->form_validation->set_rules('company', 'empresa', 'trim|required');
		$this->form_validation->set_rules('nuit', 'nuit', 'trim|required');
		$this->form_validation->set_rules('first_name', 'nome', 'trim|required');
		$this->form_validation->set_rules('last_name', 'apelido', 'trim|required');
		$this->form_validation->set_rules('confirm_password', 'confirmar password', 'matches[password]');

		$this->form_validation->set_rules('username', 'username', 'trim|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[255]');


		if ($this->form_validation->run()) {
			$data = elements(
				array(
					'first_name',
					'last_name',
					'email',
					'username',
					'company',
					'phone',
					'phone2',
					'nuit',
					'address'
				),
				$this->input->post()
			);

			$data['active'] = 0;
			$data['company_id'] = 1;

			$username = $this->security->xss_clean($this->input->post('username'));
			$password = $this->security->xss_clean($this->input->post('password'));
			$email = $this->security->xss_clean($this->input->post('email'));

			$data = $this->security->xss_clean($data);
			$group = array(3);

			$view = 'email/user_register';
			if ($this->core_model->send_email($data, $view, 'Confirmação de email')) {
				if ($this->ion_auth->register($username, $password, $email, $data, $group)) {
					echo json_encode(array('status' => 'success', 'message' => 'Cliente cadastrado com sucesso'));
				} else {
					echo json_encode(array('status' => 'error', 'message' => 'Error, ao cadastrar o cliente'));
				}
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Email invalido'));
			}
		} else {
			$errors_validation = $this->form_validation->error_array();
			$array_keys = array_keys($errors_validation);
			$array_values = array_values($errors_validation);
			$errors = array_combine($array_keys, $array_values);
			echo json_encode(array('status' => 'error_validation', 'message' => 'error validation', 'error' => $errors));
		}
	}


	public function login_driver()
	{
		// $password = $this->security->xss_clean($this->input->post('password'));
		$password = $this->input->post('password');

		if (get_by_id('tax', ['access_code' => md5($password)])) {

			$tax = get_by_id('tax', ['access_code' => md5($password)]);
			$this->session->set_userdata('tax_code', $tax->code);
			$this->session->set_userdata('tax_id', $tax->id);

			setcookie("start",  $tax->code, time() + (30 * 24 * 60 * 60), "/");
			echo json_encode(array('ok' => true, 'message' => 'acesso garantido'));
		} else {
			echo json_encode(array('ok' => false, 'message' => 'password incorreta'));
		}
	}


	public function login()
	{
		$identity = $this->security->xss_clean($this->input->post('log_email'));
		$password = $this->security->xss_clean($this->input->post('log_password'));
		$remember = FALSE; // remember the user

		if (!filter_var($identity, FILTER_VALIDATE_EMAIL)) {
			$this->db->where('username', $identity);
			$this->db->limit(1);
			$result = $this->db->get('users')->row();
			$identity = $result ? $result->email : '';
		}

		if ($this->ion_auth->login($identity, $password, $remember)) {
			$user = get_user();
			$this->session->set_userdata('user_id', $user->id);
			$this->session->set_userdata('type_user',  $this->ion_auth->get_users_groups($user->id)->row()->id);

			echo json_encode(array('ok' => true, 'message' => 'acesso garantido', 'type_user' => $this->ion_auth->get_users_groups($user->id)->row()->id));
		} else {
			echo json_encode(array('ok' => false, 'message' => 'credenciais incorrectas'));
		}
	}

	public function logout()
	{
		$this->ion_auth->logout();
		redirect(base_url('/'));
	}
}
