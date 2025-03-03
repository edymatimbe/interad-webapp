<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Local extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'your session has expired');
            redirect(base_url('auth'));
        }
    }

    function index()
    {
        $data = array(
            'title' => 'Divisão administrativa',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),

            'scripts' =>
                array(
                    'vendor/datatables/jquery.dataTables.min.js',
                    'vendor/datatables/dataTables.bootstrap4.min.js',
                    'vendor/datatables/app.js',
                ),
            'provinces' => get_all('province',null,['position', 'ASC'])
        );
        echo $this->load->view('local/index', $data, true);
    }

    function get_districts(){
        echo  $this->load->view('local/_districts', ['districts' => get_all('district',['province_id'=>$_POST['id']],['name','ASC'])], true);
    }

    function get_zones(){
        echo  $this->load->view('local/_zones', ['zones' => get_all('zone',['district_id'=>$_POST['id']],['name','asc'])], true);
    }

    function form_zone(){
        $data = null;
        if (isset($_POST['id'])) {
            $zone = get_by_id('zone', ['id' => $_POST['id']]);
            $data['zone'] = $zone;
        }
        if($_POST['other']){
            $data['from_district'] = $_POST['other'];
        }
        echo $this->load->view('local/_form', $data, true);
    }

    public function save_zone()
    {
        header('Content-Type: application/json');

        if ($_POST['action'] == 'create') {
            $this->form_validation->set_rules('name', 'Nome', 'trim|required|min_length[3]|is_unique[zone.name]');
        } else {
            $this->form_validation->set_rules('name', 'Nome', 'trim|required|min_length[3]|callback_name_check');
        }

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    'name',
                    'district_id',
                    'active'
                ),
                $this->input->post()
            );

            $district_name = get_by_id('district', ['id'=>$_POST['district_id']]);

            if ($_POST['action'] == 'create') {
                unset($data['active']);
                if ($this->core_model->insert('zone', $data)) {
                    echo json_encode(array('status' => 'success', 'message' => $this->lang->line('zone') . ' ' . $this->lang->line('saved'), 'district_id' => $_POST['district_id'], 'district_name'=> $district_name));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . ' ' . $this->lang->line('zone')));
                }
            } else {
                $id = $this->input->post('id');
                if ($this->core_model->update('zone', $data, array('id' => $id))) {
                    echo json_encode(array('status' => 'success', 'message' => $this->lang->line('zone') . ' ' . $this->lang->line('updated'), 'district_id' => $_POST['district_id'], 'district_name'=> $district_name));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . ' ' . $this->lang->line('zone')));
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

    function name_check($name)
    {
        $id = $this->input->post('id');
        if ($this->core_model->get_by_id('zone', array('name' => $name, 'id !=' => $id))) {
            $this->form_validation->set_message('name', 'Já existe uma zona com esse nome');
            return false;
        } else {
            return true;
        }
    }

    public function edit()
    {
        $this->form_zone();
    }
}
