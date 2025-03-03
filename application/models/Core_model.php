<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Core_model extends CI_Model
{
	function send_email($user, $view, $subject)
	{
		$from_email = 'no-reply@41bc.net';
		$to_email = $user['email'];
		//load email library
		$this->load->library('email');
		$this->email->from($from_email, 'PUBLICITA');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($this->load->view($view, ['user' => $user], true));
		// Send Email
		if ($this->email->send()) {
			return true;
		} else {
			return false;
		};
	}


	function get_user()
	{
		return $this->get_by_id('users', ['id' => $this->ion_auth->get_user_id()]);
	}


	function users_groups($condition)
	{
		$this->db->select([
			'users.id as user_id',
			'groups.id as group_id',
			'CONCAT(users.first_name, " ", users.last_name) AS name',
		]);
		$this->db->join('users', 'users.id = users_groups.user_id', 'LEFT');
		$this->db->join('groups', 'groups.id = users_groups.group_id', 'LEFT');

		if (is_array($condition)) {
			$this->db->where($condition);
		}

		return $this->db->get('users_groups')->result();
	}

	function get_user_id()
	{
		return $this->ion_auth->get_user_id();
	}

	private function get_company_id()
	{
		return $this->session->userdata('company_id');
	}

	function get_company()
	{
		return  get_by_id('company', array('id' =>  $this->session->userdata('company_id')));
	}


	public function count_all($table, $condition = null)
	{
		if ($table) {
			if ($this->session->userdata('company_id')) {
				if ($table != 'payment_method' && $table != 'company' && $table != 'currency') {
					$this->db->where('company_id', $this->get_company_id());
				}
			}
			if (is_array($condition)) {
				$this->db->where($condition);
			}
			return $this->db->get($table)->num_rows();
		} else {
			return false;
		}
	}

	public function get_all_data($table, $limit, $start, $condition = null)
	{
		if ($table) {
			if (is_array($condition)) {
				$this->db->where($condition);
			}

			if ($this->session->userdata('company_id')) {
				if ($table != 'payment_method' && $table != 'company' && $table != 'currency') {
					$this->db->where('company_id', $this->get_company_id());
				}
			}
			$this->db->limit($limit, $start);
			return $this->db->get($table)->result();
		} else {
			return false;
		}
	}

	function search_data($table, $limit, $start, $search, $condition = null)
	{
		if (is_array($condition)) {
			$this->db->where($condition);
		}
		$this->db->where('company_id', $this->get_company_id());
		if ($table === 'product' && !empty($search)) {
			$this->db->group_start();
			$this->db->like('product.barcode', $search, 'both');
			$this->db->or_like('product.name', $search, 'both');
			$this->db->or_like('product.sku', $search, 'both');
			$this->db->or_like('product.description', $search, 'both');
			$this->db->group_end();
		}

		if ($limit != -1) {
			$this->db->limit($limit, $start);
		}
		$query = $this->db->get($table);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}

	function search_data_count($table, $search, $condition = null)
	{
		if (is_array($condition)) {
			$this->db->where($condition);
		}
		$this->db->where('company_id', $this->get_company_id());
		if ($table === 'product' && !empty($search)) {
			$this->db->group_start();
			$this->db->like('product.barcode', $search, 'both');
			$this->db->or_like('product.name', $search, 'both');
			$this->db->or_like('product.sku', $search, 'both');
			$this->db->or_like('product.description', $search, 'both');
			$this->db->group_end();
		}
		return  $this->db->get($table)->num_rows();
	}

	public function get_all($table = null, $condition = null, $sort = null, $distinct = null, $limit = null)
	{
		// if ($table) {
		// 	if (is_array($condition)) {
		// 		$this->db->where($condition);
		// 	}

		// 	// if ($this->session->userdata('company_id')) {
		// 	// 	if ($table != 'payment_method' && $table != 'company' && $table != 'currency') {
		// 	// 		$this->db->where('company_id', $this->get_company_id());
		// 	// 	}
		// 	// }
		// 	if ($sort) {
		// 		$this->db->order_by('id', 'DESC');
		// 	}
		// 	if ($distinct) {
		// 		$columns = $this->db->list_fields($table);
		// 		if (($key = array_search($distinct, $columns)) !== false) {
		// 			unset($columns[$key]);
		// 			array_unshift($columns, 'DISTINCT(' . $distinct . ')');
		// 		}
		// 		$this->db->select($columns);
		// 		$this->db->group_by($distinct);
		// 	}
		// 	$this->db->limit($limit);
		// 	return $this->db->get($table)->result();
		// } else {
		// 	return false;
		// }

		if ($table) {
			if (is_array($condition)) {
				$this->db->where($condition);
			}
			if ($sort && is_array($sort)) {
				$this->db->order_by($sort[0], isset($sort[1]) ? $sort[1] : 'ASC');
			}

			if ($distinct) {
				$this->db->distinct();
				//                $this->db->select($distinct);
				$this->db->group_by($distinct);
			}
			return $this->db->get($table)->result();
		} else {
			//            return false;
			return [];
		}
	}

	public function get_all_order($table = null, $condition = null, $distinct = null)
	{
		if ($table) {
			if (is_array($condition)) {
				$this->db->where($condition);
			}
			if ($this->session->userdata('company_id')) {

				if ($table == 'zone' && $table == 'province' && $table == 'district') {
					$this->db->where('company_id', 0);
				} else {
					if ($table != 'payment_method' && $table != 'company' && $table != 'currency') {
						$this->db->where('company_id', $this->get_company_id());
					}
				}
			}
			if ($distinct) {
				$columns = $this->db->list_fields($table);
				if (($key = array_search($distinct, $columns)) !== false) {
					unset($columns[$key]);
					array_unshift($columns, 'DISTINCT(' . $distinct . ')');
				}
				$this->db->select($columns);
				$this->db->group_by($distinct);
			}
			$this->db->order_by('name', 'ASC');
			return $this->db->get($table)->result();
		} else {
			return false;
		}
	}


	public function get_by_id($table = null, $condition = null)
	{
		if ($table && is_array($condition)) {
			$this->db->where($condition);
			$this->db->limit(1);

			return $this->db->get($table)->row();
		} else {
			return false;
		}
	}

	public function get_setting()
	{
		$setting = $this->get_by_id('setting', array('id' => 1));
		return $setting;
	}

	public function insert($table = null, $data = null)
	{
		$return = false;
		if ($table && is_array($data)) {
	
			$this->db->insert($table, $data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', $table . ' saved successfully');
				$this->session->set_userdata('last_id', $this->db->insert_id());

				$return = true;
			} else {
				$this->session->set_flashdata('error', 'error when try save ' . $table);
				$return = false;
			}
		}
		return $return;
	}
	public function insert_batch($table = null, $data = null)
	{
		$return = false;
		if ($table && is_array($data)) {
			$this->db->insert_batch($table, $data);
			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', $table . ' saved successfully');
				$return = true;
			} else {
				$this->session->set_flashdata('error', 'error when try save ' . $table);
				$return = false;
			}
		}
		return $return;
	}

	public function update($table = null, $data = null, $condition = null)
	{
		$return = false;

		if ($table && is_array($data) && is_array($condition)) {
			if ($table != 'company') {
				$data['company_id'] = $this->get_company_id();
			}
			if ($this->db->update($table, $data, $condition)) {
				$this->session->set_flashdata('success', $table . ' updated successfully');
				$return = true;
			} else {
				$this->session->set_flashdata('error', 'error when try update ' . $table);
				$return = false;
			}
		}
		return $return;
	}

	public function delete($table, $condition)
	{
		$this->db->db_debug = false;
		if ($table && is_array($condition)) {
			$status = $this->db->delete($table, $condition);
			$error = $this->db->error();

			if (!$status) {
				foreach ($error as $code) {
					if ($code == 1451) {
						$this->session->set_flashdata('error', 'this object is used in other table');
					}
				}
			} else {
				$this->session->set_flashdata('success', $table . ' deleted successfully');
			}
			$this->db->db_debug = true;
			return true;
		} else {
			return false;
		}
	}

	public function code_generator($table, $condition = null)
	{

		
		if (is_array($condition)) {
			$this->db->where($condition);
		}
		$length = strval($this->db->get($table)->num_rows() + 1);
		$code = '';
		for ($i = strlen($length); $i <= 3; $i++) {
			$code .= '0';
		}
		return $code . $length;
	}

	public function generate_unique_code($table = NULL, $type_of_code = NULL, $size_of_code, $field_search)
	{

		do {
			$code = random_string($type_of_code, $size_of_code);
			$this->db->where($field_search, $code);
			$this->db->from($table);
		} while ($this->db->count_all_results() >= 1);

		return $code;
	}


	public function code_generator_number($num)
	{
		$length = strval($num + 1);
		$code = '';
		for ($i = strlen($length); $i <= 3; $i++) {
			$code .= '0';
		}
		return $code . $length;
	}

	public static function removerFormatacaoNumero($strNumero)
	{

		$strNumero = trim(str_replace("R$", null, $strNumero));

		$vetVirgula = explode(",", $strNumero);
		if (count($vetVirgula) == 1) {
			$acentos = array(".");
			$resultado = str_replace($acentos, "", $strNumero);
			return $resultado;
		} else if (count($vetVirgula) != 2) {
			return $strNumero;
		}

		$strNumero = $vetVirgula[0];
		$strDecimal = mb_substr($vetVirgula[1], 0, 2);

		$acentos = array(".");
		$resultado = str_replace($acentos, "", $strNumero);
		$resultado = $resultado . "." . $strDecimal;

		return $resultado;
	}

	public function por_extenso($valor = 0, $bolExibirMoeda = true, $bolPalavraFeminina = false)
	{

		$valor = self::removerFormatacaoNumero($valor);

		$singular = null;
		$plural = null;

		if ($bolExibirMoeda) {
			$singular = array("centavo", "metical", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
			$plural = array("centavos", "meticais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões");
		} else {
			$singular = array("", "", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
			$plural = array("", "", "mil", "milhões", "bilhões", "trilhões", "quatrilhões");
		}

		$c = array("", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
		$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa");
		$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove");
		$u = array("", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");

		if ($bolPalavraFeminina) {
			if ($valor == 1)
				$u = array("", "uma", "duas", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");
			else
				$u = array("", "um", "duas", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");

			$c = array("", "cem", "duzentas", "trezentas", "quatrocentas", "quinhentas", "seiscentas", "setecentas", "oitocentas", "novecentas");
		}

		$z = 0;

		$valor = number_format($valor, 2, ".", ".");
		$inteiro = explode(".", $valor);

		for ($i = 0; $i < count($inteiro); $i++)
			for ($ii = mb_strlen($inteiro[$i]); $ii < 3; $ii++)
				$inteiro[$i] = "0" . $inteiro[$i];

		// $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
		$rt = null;
		$fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);
		for ($i = 0; $i < count($inteiro); $i++) {
			$valor = $inteiro[$i];
			$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
			$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
			$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

			$r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
			$t = count($inteiro) - 1 - $i;
			$r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
			if ($valor == "000")
				$z++;
			elseif ($z > 0)
				$z--;

			if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
				$r .= (($z > 1) ? " de " : "") . $plural[$t];

			if ($r)
				$rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? (($i < $fim) ? ", " : " e ") : " ") . $r;
		}

		$rt = mb_substr($rt, 1);

		return ($rt ? trim($rt) : "zero");
	}

	public function get_debt($id)
	{
		$this->db->select_sum('total_paid');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->where('invoice_id', $id);
		$totalPaid = $this->db->get('payment')->row()->total_paid;

		$invoice = $this->get_by_id(array('invoice.id' => $id))[0];
		return $invoice->total - $totalPaid;
	}


	function is_role_group($role_name, $group)
	{
		$role = $this->get_by_id('role', array('name' => $role_name));
		if ($role) {
			return $this->get_by_id('role_group', array(
				'role_id' => $role->id,
				'group_id' => $group,
				'active' => 1,
				'company_id' => $this->session->userdata('company_id')
			)) ? true : false;
		} else {
			if ($this->insert('role', array('name' => $role_name))) {
				$this->is_role_group($role_name, $group);
			} else {
				return false;
			}
		}
	}

	function is_user_role($role_name, $user)
	{
		$role = $this->get_by_id('role', array('name' => $role_name));
		if ($role) {
			return $this->get_by_id('user_role', array(
				'role_id' => $role->id,
				'user_id' => $user,
				'active' => 1
			)) ? true : false;
		} else {
			return false;
		}
	}

	function is_granted($role_name)
	{
		if ($this->ion_auth->in_group(array('admin', 'super admin'))) {
			return true;
		} else {
			$user_group = $this->ion_auth->get_users_groups($this->get_user_id())->result()[0]; //role_grou
			$is_role_group = $this->is_role_group($role_name, $user_group->id); //is is_role_group
			return $is_role_group;
		}
	}
	public function get_sum($table, $column, $condition = null)
	{
		$this->db->select_sum($column);
		if (is_array($condition)) {
			$this->db->where($condition);
		}
		return $this->db->get($table)->row()->$column;
	}

	function get_tasks()
	{
		$this->db->select(['title', 'start', 'end', 'color', 'id']);
		return $this->db->get('events')->result();
	}
}
