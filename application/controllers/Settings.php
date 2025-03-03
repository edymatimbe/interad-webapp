<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
    protected $company;
 
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'your session has expired');
            redirect(base_url('auth'));
        }
        $this->company = $this->core_model->get_by_id('company', array('id' => 1));
    }

    public function index()
    {
        if ($this->core_model->is_granted('config_read') || $this->core_model->is_granted('investment_read')) {
            $data = array(
                'title' => 'Configurações',
                'styles' =>
                array(
                    'vendor/croppier/croppie.css',
                    'vendor/dualbox/css.css',
                    'vendor/print-js/print.min.css',
                    // 'css/croppie.css',
                    'assets/settings/settings.css',
                ),

                'scripts' =>
                array(
                    'vendor/croppier/croppie.js',
                    'vendor/dualbox/js.js',
                    'vendor/print-js/print.min.js',
                    'vendor/stickside/sticky-kit.min.js',
                    'js/bootstrap-notify.min.js',
                    // 'js/croppie.js',
                    'assets/settings/settings.js',
                ),
            );

            $this->load->view('settings/index', $data);
        } else {
            redirect(base_url('home'));
        }
    }


    public function getIndex()
    {
        $target = $_POST['target'];

        switch ($target) {
            case 'config':
            case 'account': {
                    $data = array(
                        'setting' => $this->company,
                    );
                    break;
                }
            case 'general': {
                    $data = array(
                        'company' => $this->company,
                    );
                    break;
                }
            default: {
                    $data = array(
                        'setting' => $this->company,
                    );
                }
        }
        echo $this->load->view('settings/' . $target . '/_index', $data, true);
    }

    public function set_account()
    {
        $data = array(
            'setting' => $this->company,
        );
        echo $this->load->view('settings/account/_form', $data, true);
    }

    public function updateColumn()
    {
        $column = $_POST['column'];
        $data = array();
        if (isset($_POST['notify'])) {
            $data[$column] = json_encode($this->input->post('notify'), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        if (isset($_POST['value'])) {
            $data[$column] = $_POST['value'];
        }
        $data['company_id'] = $this->company->id;
        if (count($this->core_model->get_all('setting'))) {
            if ($this->core_model->update('setting', $data, array())) {
                echo true;
            } else {
                echo false;
            }
        } else {
            if ($this->core_model->insert('settings', $data)) {
                echo true . ' insert';
            }
        }
    }

    public function account_save()
    {
        header('Content-Type: application/json');

        $this->form_validation->set_rules('name', 'nome', 'required|min_length[3]|max_length[145]');
        //        $this->form_validation->set_rules('phone', 'celular', 'required|trim|exact_length[9]');
        $this->form_validation->set_rules('phone', 'celular', 'trim|exact_length[9]');
        $this->form_validation->set_rules('phone2', 'celular', 'trim|exact_length[9]');
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|max_length[100]');
        //        $this->form_validation->set_rules('nuit', 'nuit', 'required|exact_length[9]');
        $this->form_validation->set_rules('nuit', 'nuit', 'exact_length[9]');
        $this->form_validation->set_rules('address', 'endereço', 'required|max_length[250]');
        $this->form_validation->set_rules('city', 'Cidade', 'required|max_length[100]');

        $data = elements(
            array(
                'name',
                'nuit',
                'phone',
                'phone2',
                'telephone',
                'email',
                'address',
                'city',
                //                'country',
                //                'slogan',
                'province_id'
            ),
            $this->input->post()
        );

        $user_id = $this->ion_auth->get_user_id();

        if ($this->form_validation->run()) {
            $data = html_escape($data);

            if ($this->core_model->update('company', $data, array('id' => $this->company->id))) {
                echo json_encode(
                    array(
                        'status' => 'success',
                        'message' => 'dados actualizados com sucesso',
                    )
                );
            } else {
                echo json_encode(array('error' => 'error', 'message' => $this->lang->line('saved_error') . ' ' . $this->lang->line('company')));
            }
        } else {
            $errors_validation = $this->form_validation->error_array();
            $array_keys = array_keys($errors_validation);
            $array_values = array_values($errors_validation);
            $errors = array_combine($array_keys, $array_values);
            echo json_encode(array('status' => 'error_validation', 'message' => 'error validation', 'error' => $errors));
        }
    }

    // function set_image()
    // {
    //     header('Content-Type: application/json');

    //     $image_byte = $_POST['image'];
    //     $image = substr($image_byte, strpos($image_byte, ",") + 1);
    //     $decode = base64_decode($image);
    //     $fp = fopen('public/img/logo/logo.png', 'w+');
    //     fwrite($fp, $decode);

    //     echo json_encode(array(
    //         'ok' => true,
    //         'status' => 'success',
    //         'message' => 'imagem actualizada com sucesso',
    //     ));
    // }

    public function set_config()
    {
        $data['config'] = $this->company;
        echo $this->load->view('settings/config/_form', $data, true);
    }

    public function config_save()
    {
        header('Content-Type: application/json');

        $this->form_validation->set_rules('time_in', '', 'required|trim');
        $this->form_validation->set_rules('time_out', '', 'required|trim');
        $this->form_validation->set_rules('interval_begin', '', 'required|trim');
        $this->form_validation->set_rules('interval_end', '', 'required|trim');

        $data = elements(
            array(
                'time_in',
                'time_in_saturday',
                'time_out',
                'time_out_saturday',
                'interval_begin',
                'interval_end',
            ),
            $this->input->post()
        );

        if ($this->form_validation->run()) {
            $data = html_escape($data);
            if ($this->core_model->update('company', $data, array('id' => $this->company->id))) {
                echo json_encode(
                    array(
                        'status' => 'success',
                        'message' => 'Dados actualizados com sucesso',
                    )
                );
            } else {
                echo json_encode(array(
                    'error' => 'error',
                    'status' => 'error',
                    'message' => $this->lang->line('saved_error') . ' ' . $this->lang->line('company')
                ));
            }
        } else {
            $errors_validation = $this->form_validation->error_array();
            $array_keys = array_keys($errors_validation);
            $array_values = array_values($errors_validation);
            $errors = array_combine($array_keys, $array_values);
            echo json_encode(array('status' => 'error_validation', 'message' => 'error validation', 'error' => $errors));
        }
    }

    public function set_working_days()
    {
        $days = json_decode($_POST['days']);
        $counter = 1;
        $json = '[';
        foreach ($days as $item) {
            $line = '{"id":"' . $item . '"}' . (($counter !== count($days) ? ',' : ''));
            $json .= $line;
            $counter += 1;
        }
        $json .= ']';

        $data = [
            'working_days' => $json
        ];

        if ($this->core_model->update('company', $data, array('id' => $this->company->id))) :
            echo true;
        else:
            echo false;
        endif;
    }

    function set_currency_format()
    {
        header('Content-Type: application/json');

        $data = elements(
            array(
                'currency_decimals',
                'currency_dec_point',
                'currency_thousand_sep',
                'currency_code',
                'show_currency',
                'show_currency_code_symbol',
                'currency_code_position',
            ),
            $this->input->post()
        );

        $response = array();
        if ($_POST['action'] == 0) {
            $format = number_format(10000.87, intval($data['currency_decimals']), $data['currency_dec_point'], $data['currency_thousand_sep']);
            $currency = get_by_id('currency', ['code' => $data['currency_code']]);

            if ($data['show_currency_code_symbol'] == 'code') {
                $currency_code_symbol = $currency->code;
            } else {
                $currency_code_symbol = $currency->symbol;
            }

            if ($data['show_currency']) {
                if ($data['currency_code_position'] == 'start') {
                    $format = $currency_code_symbol . ' ' . $format;
                } else {
                    $format = $format . ' ' . $currency_code_symbol;
                }
            }
            $response['format'] = $format;
            $response['action'] = 0;
            $response['data'] = $data;
        } else {
            $response['action'] = 1;
            if ($this->core_model->update('company', $data, ['id' => get_company()->id])) {
                $response['status'] = "success";
                $response['message'] = "Formato monetário definido com sucesso";
            } else {
                $response['status'] = "error";
                $response['message'] = "Erro ao actualizar formato";
            }
        }
        echo json_encode($response);
    }



    public function save_multiplier(){
        if(update('setting', ['multiplier' => $_POST['multiplier']],['id' => 1])){
            echo json_encode(['status' =>1]);
        }else{
            echo json_encode(['status' =>0]);
        }
    }
}
