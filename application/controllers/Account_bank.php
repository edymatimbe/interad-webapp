<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Account_bank extends CI_Controller
{
    protected $user_id;

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'your session has expired');
            redirect(base_url('auth'));
        }
        $this->user_id = $this->ion_auth->get_user_id();
    }
    function getAll()
    {
        $account_bank = $this->core_model->get_all('bank_account', null,  array('id', 'ASC'));
        echo $this->load->view('settings/account_bank/_table', array('account_bank' => $account_bank), true);
    }
    function index()
    {
        $data = array(
            'title' => 'Contas bancarias',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
                'css/croppie.css',
            ),
            'cdns_css' => array(),

            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
                'js/croppie.js',
                'assets/settings/bank_account.js'
            ),
            'cdns_js' => array(),
            'menu_active' => 'menu-system',
            'sub_menu_active' => 'account_bank',
            'account_bank' => $this->core_model->get_all('bank_account', null,  array('id', 'ASC')),
        );
        $this->load->view('settings/account_bank/index', $data);
    }

    public function create()
    {
        $data['banks'] = $this->core_model->get_all('bank', ['active' => 1], array('id', 'ASC'));
        echo $this->load->view('settings/account_bank/_create', $data, true);
    }

    public function save()
    {
        header('Content-Type: application/json');

        $action = $this->input->post('action'); //create or udate

        $data = elements(
            array(
                'number',
                'nib',
                'bank_id',
                'owner',
            ),
            $this->input->post()
        );


        if ($action == 'create') {
            $data['created_by'] = $this->user_id;
            $data['updated_by'] = $this->user_id;
            $data['active']     = 1;
            if ($this->core_model->insert('bank_account', $data)) {
                echo json_encode(array('status' => 'success', 'message' => $this->lang->line('bank_account') . ' ' . $this->lang->line('saved')));
            } else {
                echo json_encode(array('status' => 'error', 'message' => $this->lang->line('bank_account') . ' ' . $this->lang->line('saved')));
            }
        } else {
            // $data['updated_at'] = date("Y-m-d H:i:s");
            $data['updated_by'] = $this->user_id;
            $id = $this->input->post('id');

            if ($this->core_model->update('bank_account', $data, array('id' => $id))) {
                // echo json_encode(array('status' => 'success', 'message' => $this->lang->line('bank_account') . ' ' . $this->lang->line('updated')));
                echo json_encode(array('status' => 'success', 'message' => ' Numero é '. $id ));
            } else {
                echo json_encode(array('status' => 'error', 'message' => $this->lang->line('bank_account') . ' ' . $this->lang->line('saved')));
            }
        }
    }

    public function getBank()
    {
        $account_bank = $this->core_model->get_by_id('bank_account', array('id' => $_POST['id']));
        return array(
            'account_bank' => $account_bank
        );
    }



    public function edit()
    {
        $data = [
            'account'    => $this->core_model->get_by_id('bank_account', ['id' => $_POST['id']]),
            'banks'      =>  $this->core_model->get_all('bank', ['active' => 1], array('id', 'ASC'))
        ];
        echo $this->load->view('settings/account_bank/_edit', $data, true);
    }
}
