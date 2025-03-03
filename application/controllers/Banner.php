<?php

defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require_once('vendor/autoload.php');

class Banner extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'your session has expired');
            redirect(base_url('auth'));
        }
        
		if($this->session->userdata('type_user')  == 3){
			redirect(base_url('advertiser'));
		}
    }
    public function index($id = null)
    {

        $data = [
            'title' => 'Publicidade',
            'styles' => [
                'vendor/datatables/dataTables.bootstrap4.min.css',
                'vendor/daterangepicker/daterangepicker.css',
                'css/croppie.css',
            ],

            'scripts' => [
                'vendor/moment/moment.js',
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
                'vendor/daterangepicker/daterangepicker.js',
                'js/croppie.js',
            ],
        ];


        if ($id != null)
            $data['tax_id'] = $id;


        // if ($this->core_model->is_granted('banner_read')) :
        return $this->load->view('banner/index', $data);
        // else :
        //     redirect(base_url('/home'));
        // endif;
    }
    public function save()
    {
        header('Content-Type: application/json');



        $this->form_validation->set_rules('description', 'descrição', 'trim|required');
        $this->form_validation->set_rules('link', 'link', 'trim|required');

        $this->form_validation->set_rules('title', 'titulo', 'trim|required');

        if ($_POST['action'] == 'create')
            $this->form_validation->set_rules('image', 'Image do banner', 'trim|required');

        if ($this->form_validation->run()) {
            
            $data = elements(
                array(
                    'description',
                    'link',
                    'title',
                    'tax_id',
                ),
                $this->input->post()
            );

            $code =   $this->core_model->code_generator('banner');
            // if ($this->input->post('video_name')) {
                //file upload destination
                $upload_path = 'upload/';
                $config['upload_path'] = $upload_path;
                //allowed file types. * means all types
                $config['allowed_types'] = 'wmv|mp4|avi|mov';
                //allowed max file size. 0 means unlimited file size
                $config['max_size'] = '0';
                //max file name size
                $config['max_filename'] = 255;
                //whether file name should be encrypted or not
                $config['encrypt_name'] = FALSE;
                //store video info once uploaded
                // $code.'_'.substr(md5(time()), 0, 8)
                $video_data = array();
                //check for errors
                $is_file_error = FALSE;
                //check if file was selected for upload
                if (!$_FILES) {
                    echo json_encode(array('status' => 'error', 'message' => 'selecione o video'));
                    die;
                }
                //if file was selected then proceed to upload
                if (!$is_file_error) {
                    //load the preferences
                    $this->load->library('upload', $config);
                    //check file successfully uploaded. 'video_name' is the name of the input
                    if (!$this->upload->do_upload('video_name')) {
                        //if file upload failed then catch the errors

                        echo json_encode(array('status' => 'error', 'message' => 'Error ao carregar o ficheiro'));
                        die;
                        // $this->handle_error($this->upload->display_errors());

                    } else {
                        //store the video file info
                        $video_data = $this->upload->data();
                    }
                }
                // There were errors, you have to delete the uploaded video
                if ($is_file_error) {
                    if ($video_data) {
                        $file = $upload_path . $video_data['file_name'];
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }
                } else {
                    // $data['video_name'] = $video_data['file_name'];
                    $data['path'] = $upload_path . '/' . $video_data['file_name'];
                    $data['type'] = $video_data['file_type'];
                }


                // echo json_encode($data);
                // die();
                // }
                // $video_path . '/' . $video_name
                // load the error and success messages
                // $data['errors'] = $this->error;
                // $data['success'] = $this->success;
                //load the view along with data
                // $this->load->view('video_upload', $data);
            // }


            $image_byte = $this->input->post('image');
            $code =   $this->core_model->code_generator('banner');
            if ($_POST['action'] == 'update')
                $code = get_by_id('banner', ['id' => $_POST['id']])->code;

            $image_name = 'IMG_' . $code . '.jpg';
            $imagePath = 'folders/banner/' . str_replace(' ', '_', $code) . '/imagem';

            if (!is_dir($imagePath)) {
                mkdir($imagePath, 0777, true);
            }

            if ($image_byte) {
                $data['image'] = $imagePath . '/' . $image_name;
            }

            $user_id = $this->ion_auth->get_user_id();



            if ($_POST['action'] == 'create') {
                $data['code'] =  $code;
                $data['created_by'] = $user_id;
                $data['updated_by'] = $user_id;




                if (insert('banner', $data)) {

                    if ($image_byte) {
                        $image = substr($image_byte, strpos($image_byte, ",") + 1);
                        $decode = base64_decode($image);
                        $fp = fopen($imagePath . '/' . $image_name, 'w+');
                        fwrite($fp, $decode);
                    }

                    echo json_encode(array('status' => 'success', 'message' =>  'Novo  banner' . $this->lang->line('saved')));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . 'banner'));
                }
            } else {
                $id = $this->input->post('id');
                if (update('banner', $data, array('id' => $id))) {
                    $image = substr($image_byte, strpos($image_byte, ",") + 1);
                    $decode = base64_decode($image);
                    $fp = fopen($imagePath . '/' . $image_name, 'w+');
                    fwrite($fp, $decode);
                    echo json_encode(array('status' => 'success', 'message' => 'Banner actualizado com sucesso' . ' ' . $this->lang->line('updated')));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => $this->lang->line('saved_error') . ' ao actualizar banner'));
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
        echo $this->load->view('banner/_table', ['banner' => get_all('banner')], true);
    }

    public function form()
    {
        $data = array();

        if (!empty($_POST['id'])) {
            $data['banner'] = get_by_id('banner', ['id' => $_POST['id']]);
        }
        if (!empty($_POST['contest_id'])) {
            $banner = get_by_id('banner', ['contest_id' => $_POST['contest_id']]);
            if ($banner) {
                $data['banner'] = $banner;
            }
            $data['contest_id'] = $_POST['contest_id'];
        }


        echo json_encode($this->load->view('banner/_form', $data, true));
    }
}
