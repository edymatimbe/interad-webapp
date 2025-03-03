<?php

use phpDocumentor\Reflection\DocBlock\Description;

defined('BASEPATH') or exit('No direct script access allowed');

class Parameter extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'your session has expired');
            redirect(base_url('auth'));
        }
    }

    public function index_doc_type()
    {
        $data = array(
            'title' => 'Tipos de documentos',
            'styles' =>
            array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),

            'scripts' =>
            array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'doc_types' => $this->core_model->get_all('document_type', null, array('id', 'ASC')),
        );
        $this->load->view('parameter/doc_type/index', $data);
    }


    function getAll_docs()
    {
        echo $this->load->view(
            'parameter/doc_type/_table',
            array('doc_types' => $this->core_model->get_all('document_type', null, ['id', 'DESC'])),
            true
        );
    }

    public function name_doc_check($name)
    {
        $id = $this->input->post('id');
        if ($this->core_model->get_by_id('document_type', array('name' => $name, 'id !=' => $id))) {
            $this->form_validation->set_message('name_check', 'Já existe um tipo de documento com esse nome');
            return false;
        } else {
            return true;
        }
    }

    public function form_doc()
    {
        $id = $_POST['id'];
        $data = null;
        if ($id != 0) {
            $data['doc_type'] = $this->core_model->get_by_id('document_type', array('id' => $id));
        }
        echo $this->load->view('parameter/doc_type/_form', $data, true);
    }

    public function save_doc()
    {
        header('Content-Type: application/json');
        $action = $_POST['action'];

        $this->form_validation->set_rules('character', 'número de caraters', 'trim|required');
        if ($action == 'create') {
            $this->form_validation->set_rules('name', 'nome', 'trim|required|is_unique[document_type.name]');
        } else {
            $this->form_validation->set_rules('name', '', 'trim|required|min_length[3]|max_length[45]|callback_name_doc_check');
        }

        $data = elements(
            array(
                'character',
                'name',
            ),
            $this->input->post()
        );

        if ($this->form_validation->run()) {
            $data = html_escape($data);
            if ($action == 'create') {
                $saved = $this->core_model->insert('document_type', $data);
                if ($saved) {
                    echo json_encode(array(
                        'status' => 'success',
                        'message' => 'Tipo de documento ' . $this->lang->line('saved'),
                    ));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . '  Tipo de documento '));
                }
            } else {
                $data['active'] = $this->input->post('active');
                $update = $this->core_model->update('document_type', $data, array('id' => $_POST['id']));
                if ($update) {
                    echo json_encode(array(
                        'status' => 'success',
                        'message' => 'Tipo de documento actualizado com sucesso',
                    ));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . '  Tipo de documento '));
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

    function get_all_docs()
    {

        echo $this->load->view(
            'parameter/doc_type/_table',
            array('doc_types' => $this->core_model->get_all('document_type', null, array('id', 'ASC')),),
            true
        );
    }
}
