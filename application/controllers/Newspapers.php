<?php
require FCPATH . 'vendor/autoload.php';
class Newspapers extends CI_Controller
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
    public function index()
    {
        $data = array(
            'title' => 'Listagem de Jornais',
            'styles' => array(
				'vendor/datatables/dataTables.bootstrap4.min.css',
				'css/croppie.css',
				'assets/bank/bank.css'
			),
			'cdns_css' => array(),

			'scripts' => array(
				'vendor/datatables/jquery.dataTables.min.js',
				'vendor/datatables/dataTables.bootstrap4.min.js',
				'vendor/datatables/app.js',
				'js/croppie.js',
				'assets/bank/bank.js'
			),
			'cdns_js' => array(),
			'menu_active' => 'menu-newspapers',
			
            'newspapers' => $this->db->order_by('publish_date', 'DESC')->get('newspapers')->result(),
        );
        $this->load->view('newspaper/index', $data);
    }

    public function form()
    {
        $this->load->view('newspaper/form');
    }


    public function save()
    {
        $action = $this->input->post('action'); // create or update

        $config['upload_path'] = './public/newspaper/';
        $config['allowed_types'] = 'pdf';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('pdf_file')) {
            echo json_encode(array('status' => 'error', 'message' => 'Erro ao carregar o PDF'));
        } else {
            $code = $this->core_model->code_generator('newspapers');
            // Caminho completo do arquivo PDF original
            $pdf_path = $this->upload->data('full_path');

            // Nome do arquivo original sem extensão
            $original_file_name = pathinfo($this->upload->data('file_name'), PATHINFO_FILENAME);

            // Novo nome para salvar a primeira página como PDF, concatenando com o código
            $new_file_name = 'newspaper_' . $code . '.pdf';
            $first_page_pdf_path = './public/newspaper/' . $new_file_name;

            // Usando FPDI para extrair a primeira página do PDF
            $pdf = new \setasign\Fpdi\Fpdi(); // Use o namespace correto
            $page_count = $pdf->setSourceFile($pdf_path);
            if ($page_count > 0) {
                $pdf->AddPage();
                $page_id = $pdf->importPage(1);
                $pdf->useTemplate($page_id, 10, 10, 200);
                $pdf->Output('F', $first_page_pdf_path);
            }

            // Salvar apenas o nome do arquivo no banco de dados, concatenado com o código
            $data = array(
                'name' => $this->input->post('name'),
                'code' => $code,
                'pdf_path' => $new_file_name, // Salva apenas o nome do novo PDF com a primeira página
                'publish_date' => $this->input->post('publish_date'),
            );

            if ($action == 'create') {
                $data['created_by'] = $this->user_id;
                $data['updated_by'] = $this->user_id;
                if ($this->db->insert('newspapers', $data)) {
                    echo json_encode(array('status' => 'success', 'message' => 'Jornal digital ' . $this->lang->line('saved')));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Jornal digital não ' . $this->lang->line('saved')));
                }
            } else {
                $data['updated_at'] = date("Y-m-d H:i:s");
                $data['updated_by'] = $this->user_id;
                $id = $this->input->post('id');

                if ($this->db->update('newspapers', $data, array('id' => $id))) {
                    echo json_encode(array('status' => 'success', 'message' => 'Jornal digital ' . $this->lang->line('updated')));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Jornal digital ' . $this->lang->line('updated')));
                }
            }
        }
    }

    function getAll()
	{
		// $taxes = get_all('tax', null,  array('id', 'DESC'));
		echo $this->load->view('newspaper/_table',[ 'newspapers' => $this->db->order_by('publish_date', 'DESC')->get('newspapers')->result()], true);
	}
}
