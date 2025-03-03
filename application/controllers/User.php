<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
		$this->user = get_by_id('users', array('id' => $this->user_id));
		$this->company = get_by_id('company', array('id' => $this->session->userdata('company_id')));
		
		if($this->session->userdata('type_user')  == 3){
			redirect(base_url('advertiser'));
		}
	}

	public function index()
	{
		$data = array(
			'title' => $this->lang->line('users'),
			'styles' =>
			array(
				'vendor/datatables/dataTables.bootstrap4.min.css',
				'css/croppie.css',
			),
			'scripts' =>
			array(
				'vendor/datatables/jquery.dataTables.min.js',
				'vendor/datatables/dataTables.bootstrap4.min.js',
				'vendor/datatables/app.js',
				'js/croppie.js',
				'assets/user/user.js' 
			),
			'menu_active' => 'menu-user',
			//			'users' => $this->ion_auth->users()->result()
			'users' => $this->core_model->get_all('users' )
		);
		if ($this->ion_auth->in_group(array('admin', 'super admin'))) :
			$this->load->view('user/index', $data);
		else :
			redirect(base_url('home-sales')); 
		endif;
	}

	function email_check($email)
	{
		$id = $this->input->post('id');

		if ($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $id))) {
			$this->form_validation->set_message('email_check', 'This email already exist');
			return false;
		} else {
			return true;
		}
	}

	function username_check($username)
	{
		$id = $this->input->post('id');
		if ($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $id))) {
			$this->form_validation->set_message('username_check', 'This username already exist');
			return false;
		} else {
			return true;
		}
	}

	public function create()
	{
		$data = array(
			'groups' => $this->core_model->get_all_order('groups')
		);
		echo $this->load->view('user/_create', $data, true);
	}

	function save()
	{
		header('Content-Type: application/json');

	
		$this->form_validation->set_rules('first_name', '', 'trim|required');
		$this->form_validation->set_rules('last_name', '', 'trim|required');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'matches[password]');
		if ($_POST['action'] === 'create') {
			$this->form_validation->set_rules('username', 'Username', 'trim|is_unique[users.username]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'password', 'required|min_length[5]|max_length[255]');
		} else {
			$this->form_validation->set_rules('username', 'Username', 'trim|callback_username_check');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
			$this->form_validation->set_rules('password', 'password', 'trim|min_length[5]|max_length[255]');
		}

		if ($this->form_validation->run()) {
			$data = elements(
				array(
					'first_name',
					'last_name',
					'email',
					'username',
					'active',
					'nuit',
					'phone',
					'phone2',
					'address',
					'note',
					'position',
					'city',
					'active',
				),
				$this->input->post()
			);
			$user_id = $this->ion_auth->get_user_id();
			$data['updated_by'] = $user_id;
			$data['active'] = 1;

			$object_name = $this->lang->line('user');
			if ($_POST['from'] == 'profile') {
				$object_name = $this->lang->line('profile');
			}

			$imagePath = 'companies/users';

			if (!is_dir($imagePath)) {
				mkdir($imagePath, 0777, true);
			}

			if ($_POST['action'] === 'create') {
				$image_name = 'IMG_' . $this->core_model->code_generator('users') . '.jpg';
				$image_byte = $this->input->post('image');

				if ($image_byte) {
					$data['image'] = $imagePath . '/' . $image_name;
				}
				$data['created_by'] = $user_id;
				$username = $this->security->xss_clean($this->input->post('username'));
				$password = $this->security->xss_clean($this->input->post('password'));
				$email = $this->security->xss_clean($this->input->post('email'));

				$data = $this->security->xss_clean($data);
				$group = array($this->input->post('profile'));

				if ($this->ion_auth->register($username, $password, $email, $data, $group)) {
					if ($image_byte) {
						$image = substr($image_byte, strpos($image_byte, ",") + 1);
						$decode = base64_decode($image);
						$fp = fopen($imagePath . '/' . $image_name, 'w+');
						fwrite($fp, $decode);
					}

					echo json_encode(array('status' => 'success', 'message' => $object_name . ' ' . $this->lang->line('saved')));
				} else {
					echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . ' ' . $object_name));
				}
			} else {
				$id = $this->input->post('id'); //verifica se foi passado o password
				$password = $this->input->post('password'); //verifica se foi passado o password
				$s = 'nao';
				if ($password) {
					$s = 'sim';
					$data['password'] = $password;
				}
				$image_name = 'IMG_' . date('ymdHis') . '.jpg';
				$image_byte = $this->input->post('image');

				if ($image_byte) {
					$data['image'] = $imagePath . '/' . $image_name;
				}

				if ($this->ion_auth->update($id, $data)) {
					if ($image_byte) {
						$image = substr($image_byte, strpos($image_byte, ",") + 1);
						$decode = base64_decode($image);
						$fp = fopen($imagePath . '/' . $image_name, 'w+');
						fwrite($fp, $decode);
					}

					if (isset($_POST['profile'])) {
						
						$user_groups = $this->ion_auth->get_users_groups($id)->row();
						$profile_post = $this->input->post('profile');
						//					update the group
						if ($user_groups->id != $profile_post) {
							$this->ion_auth->remove_from_group($user_groups->id, $id); //revoke user in group
							$this->ion_auth->add_to_group($profile_post, $id); //add user in group
						}
						
					}

					echo json_encode(
						array(
							'status' => 'success',
							'message' => $object_name . ' ' . $this->lang->line('updated'),
							'profile' => $this->load->view(
								'user/profile/_profile',
								array('user' => $this->core_model->get_by_id('users', array('id' => $id))) //if update own profile
								,
								true
							)
						)
					);
				} else {
					echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . ' ' . $object_name));
					//					$this->session->set_flashdata('error', 'error when try update user');
				}
			}
		} else {
			$errors_validation = $this->form_validation->error_array();
			$array_keys = array_keys($errors_validation);
			$array_values = array_values($errors_validation);
			$errors = array_combine($array_keys, $array_values);
			echo json_encode(array('status' => 'error_validation', 'message' => 'error validation', 'error' => $errors));
		}
	}

	public function getAll()
	{
		$users = $this->core_model->get_all('users');
		echo $this->load->view('user/_table', array('users' => $users), true);
	}

	function show()
	{
		$id = $_POST['id'];
		$data = array(
			'user' => $this->core_model->get_by_id('users', array('id' => $id)),
			'products' => $this->core_model->get_all('product', array('created_by' => $id))
		);
		echo $this->load->view('user/_show', $data, true);
	}

	function edit()
	{
		$id = $_POST['id'];
		$data = array(
			'user' => $this->core_model->get_by_id('users', array('id' => $id)),
			'profile_or_user' => $this->lang->line('user')
		);
		if ($_POST['from'] == 'profile') {
			$data['profile_or_user'] = $this->lang->line('profile');
		}
		echo $this->load->view('user/_edit', $data, true);
	}


	public function profile()
	{
		$user_id = $this->ion_auth->get_user_id();

		$data = array(
			'title' => $this->lang->line('dd_profile'),
			'styles' =>
			array(
				'vendor/datatables/dataTables.bootstrap4.min.css',
				'assets/user/user.css'
			),

			'scripts' =>
			array(
				'vendor/datatables/jquery.dataTables.min.js',
				'vendor/datatables/dataTables.bootstrap4.min.js',
				'vendor/datatables/app.js',
				'assets/user/user.js'
			),
			'user' => $this->core_model->get_by_id('users', array('id' => $user_id))
		);
		$this->load->view('user/profile/index', $data);
	}


	function getIndex()
	{
		$target = $_POST['target'];

		switch ($target) {
			case 'user': {
					$data = array('users' => get_all('users', ['id !='=> 1], array('first_name', 'ASC')));
					echo $this->load->view('user/_index', $data, true);
					break;
				}
			case 'access': {
					$data = array(
						'groups' => $this->core_model->get_all('groups', array('id !=' => 1, 'active' => 1)),
						'models' => array(
							array('id' => 'tax', 'name' => 'Tax', 'capitalize' => true),
							array('id' => 'banner', 'name' =>'Publicidade', 'capitalize' => true),
							array('id' => 'config', 'name' => $this->lang->line('config'), 'capitalize' => true),
							array('id' => 'user', 'name' => $this->lang->line('user'), 'capitalize' => true),
							array('id' => 'access_management', 'name' => $this->lang->line('access_management'), 'capitalize' => false),
						),
						'all_groups' => $this->core_model->get_all('groups', array('id !=' => 1), array('name', 'ACS'))
					);
					echo $this->load->view('user/access/index', $data, true);
					break;
				}
		}
	}

	function setRoleGroup()
	{
		if ($this->ion_auth->in_group(array('admin', 'super admin')) || $this->core_model->is_granted('loan_read')) {
			$target = $this->input->post('target');
			$group = $this->input->post('group');
			$action = $this->input->post('action');
			$model = $this->input->post('model');
			$role_name = $model . '_' . $action;
			$role = $this->core_model->get_by_id('role', array('name' => $role_name));
			if ($role) {
				$role_group = array(
					'role_id' => $role->id,
					'group_id' => $group,
					'company_id' => $this->company->id,
				);

				$role_group_exist = $this->core_model->get_by_id('role_group', $role_group);
				if ($role_group_exist) {
					$data_update = array(
						'active' => $target,
						'updated_by' => $this->user_id,
						'updated_at' => date("Y-m-d H:i:s"),
					);
					if (!$role_group_exist->created_by) {
						$data_update['created_by'] = $this->user_id;
					}
					$this->core_model->update('role_group', $data_update, $role_group);
					echo 'updated' . $target . ' role_id =>' . $role->id;
				} else {
					$role_group['active'] = $target;
					$role_group['created_by'] = $this->user_id;
					$role_group['updated_by'] = $this->user_id;
					$this->core_model->insert('role_group', $role_group);
					echo 'created';
				}
			}
		} else {
			echo 'not authorized';
		}
	}

	function get_user_role()
	{
		$id = $_POST['id'];
		$data = array(
			'user' => $id,
			'models' => array(
				//                array('id' => 'parameter', 'name' => 'Parametros'),
				//                array('id' => 'entity', 'name' => 'Entidade'),
				//                array('id' => 'user', 'name' => 'Utilizador'),
			)
		);
		echo $this->load->view('user/access/_user_role_table', $data, true);
	}

	function setUserRole()
	{
		if ($this->ion_auth->in_group(array('admin', 'super admin'))) {
			$target = $this->input->post('target'); //1|0
			$user = $this->input->post('user');
			$action = $this->input->post('action');
			$model = $this->input->post('model');
			$role_name = $model . '_' . $action;
			$role = $this->core_model->get_by_id('role', array('name' => $role_name));
			if ($role) {
				$user_role = array(
					'role_id' => $role->id,
					'user_id' => $user
				);

				if ($this->core_model->get_by_id('user_role', $user_role)) {
					$this->core_model->update('user_role', array('active' => $target), $user_role);
					echo 'updated' . $target;
				} else {
					$user_role['active'] = $target;
					$this->core_model->insert('user_role', $user_role);
					echo 'created';
				}
			}
		} else {
			echo 'not authorized';
		}
	}


	public function name_check($name)
	{
		if ($_POST['action'] == 'create') {
			if ($this->core_model->get_by_id('groups', array('name' => $name))) {
				$this->form_validation->set_message('name_check', 'Já existe um perfil com esse nome');
				return false;
			} else {
				return true;
			}
		} else {
			$id = $this->input->post('id');
			if ($this->core_model->get_by_id('groups', array('name' => $name, 'id !=' => $id))) {
				$this->form_validation->set_message('name_check', 'Já existe um perfil com esse nome');
				return false;
			} else {
				return true;
			}
		}
	}

	public function save_profile()
	{
		header('Content-Type: application/json');
		if ($_POST['action'] == 'create') {
			$this->form_validation->set_rules('name', 'nome', 'required|min_length[2]|max_length[145]|callback_name_check');
		} else {
			$this->form_validation->set_rules('name', '', 'trim|required|min_length[3]|max_length[45]|callback_name_check');
		}

		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('name'),
		);
		if ($this->form_validation->run()) {
			if ($_POST['action'] == 'create') {
				if ($this->core_model->insert('groups', $data)) {

					echo json_encode(array(
						'status' => 'success',
						'message' => 'perfil registado com sucesso',
					));
				} else {
					echo json_encode(array('status' => 'error', 'message' => 'Error ao salvar perfil'));
				}
			} else {
				if ($this->core_model->update('groups', $data, array('id' => $_POST['id']))) {
					echo json_encode(array(
						'status' => 'success',
						'message' => 'perfil actualizado sucesso',
					));
				} else {
					echo json_encode(array('status' => 'error', 'message' => 'Error ao actualizar perfil'));
				}
			}
		} else {
			$errors_validation = $this->form_validation->error_array();
			$array_keys = array_keys($errors_validation);
			$array_values = array_values($errors_validation);
			$errors = array_combine($array_keys, $array_values);
			echo json_encode(array('status' => 'error_validation', 'message' => 'error validation', 'error' => $errors));
		}
	}

	public function set_profile()
	{
		$data = array();
		if ($_POST['id'] !== 0) {
			$data['profile'] = $this->core_model->get_by_id('groups', array('id' => $_POST['id']));
		}
		echo $this->load->view('user/access/_profileForm', $data, true);
	}

	public function del_profile()
	{
		header('Content-Type: application/json');

		$data = array('active' => 0);
		if ($this->core_model->update('groups', $data, array('id' => $_POST['id']))) {
			$table = $this->core_model->get_all('groups', array('id !=' => 1, 'active' => 1), array('name', 'ASC'));
			echo json_encode(array(
				'status' => 'success',
				'message' => 'perfil removido com sucesso',
			));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Error ao actualizar perfil'));
		}
	}
}
