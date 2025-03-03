<?php

defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Payment extends CI_Controller
{
    protected $invoice_controller;
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
        $this->user = $this->core_model->get_by_id('users', array('id' => $this->user_id));
    }

    public function index()
    {
        $data = array(
            'title' => $this->lang->line('payments'),
            'styles' => array(
                'vendor/daterangepicker/daterangepicker.css',
                'vendor/datatables/dataTables.bootstrap4.min.css',
                'assets/payment/payment.css',
            ),

            'scripts' => array(
                'vendor/moment/moment.js',
                'vendor/print-js/print.min.js',
                'vendor/daterangepicker/daterangepicker.js',
                'vendor/print-js/print.min.js',
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'payments' => $this->setting_model->get_payment(array('DATE_FORMAT(payment.created_at,"%Y-%m-%d")' => date('Y-m-d')))
        );
        $this->load->view('payment/index', $data);
    }

    public function create()
    {
        $data = array(
            'title' => $this->lang->line('new') . ' ' . $this->lang->line('payment'),
            'styles' => array(
                'vendor/bootstrap-datepicker/bootstrap-datepicker.min.css'
            ),

        );
        $this->load->view('payment/create', $data);
    }

    public function getPendingInvoice()
    {
        $customer_id = $_POST['id'];

        $controller = get_by_id('controller', ['created_by' => $_POST['id'], 'status !=' => 'pago']);

        if (!empty($customer_id) && !empty( $controller)) {
            $data = array(
                'controller' =>  $controller,
                'customer_id' =>$_POST['id'],
            );
            echo $this->load->view('payment/_create', $data, true);
        } else {
            echo $this->load->view('payment/_create', array(), true);
        }
    }


    public function save()
    {
        header('Content-Type: application/json');
        $code = $this->core_model->code_generator('payment');
        $method = $_POST['method_id'];
        // $controller = get_by_id('controller', array('id' => $_POST['controller_id']));
        $amount = $_POST['amount'];
        $array_payment = array(
            'amount' => floatval($amount),
            'method_id' => intval($method),
            'receipt' => $code,
            'controller_id' =>  intval($_POST['controller_id']),
            // 'created_at' => $_POST['payment_date']
        );

        if ($method == 1) {
            $array_payment['total_paid'] = floatval($_POST['total_paid']);
            $array_payment['change'] =floatval( $_POST['change']);
        }
        // cheque e transferencia
        if (isset($_POST['is_bank'])) {
            $array_payment['check_number'] = $_POST['check_number'];
            $array_payment['check_bank'] = $_POST['check_bank'];
            $array_payment['holder'] = $_POST['mobile_holder'];
            $array_payment['account'] = $_POST['check_account'];
            $array_payment['nib'] = $_POST['check_nib'];
        }

        // mobile service
        if (isset($_POST['is_mobile'])) {
            $array_payment['mobile_number'] = $_POST['mobile_number'];
            $array_payment['reference'] = $_POST['reference'];
            $array_payment['holder'] = $_POST['holder'];
        }
        $status = '';

        // echo json_encode($array_payment);
        // die;

        if (insert('payment', $array_payment)) {
            update('controller', ['status' =>'pago'], ['id' => intval($_POST['controller_id'])]);
            echo json_encode(array(
                'ok' => true,
                'status' => 'success',
                'message' => 'pagamento salvo com sucesso',
                'status__' => $status
            ));
        } else {
            echo json_encode(array('ok' => false, 'status' => 'error', 'message' => 'not saved'));
        }
    }

    public function get_details()
    {
        $payments = $this->loan_model->get_payment(['payment.id' => $_POST['id']]);
        echo $this->load->view('payment/_details', $payments ? $payments[0] : null, true);
    }

    public function getP()
    {
        $payments = $this->loan_model->get_payment(['payment.id' => 1921]);
        echo "<pre>";
        print_r($payments);
        echo "</pre>";
    }

    function get_receipt_data( $condition = null)
	{

		$this->db->select(array(
			'payment.*',
			'users.id as customer_id',
			'controller.id as invoice_id',
			'controller.code as invoice_number',
			'controller.cost as invoice_total',
			'payment_method.name as pay_method',
			'CONCAT(users.first_name, " ", users.last_name) AS seller',
		));
	
		$this->db->join('controller', 'controller.id = payment.controller_id', 'LEFT');
		$this->db->join('payment_method', 'payment_method.id = payment.method_id', 'LEFT');
		$this->db->join('users', 'users.id = controller.created_by', 'LEFT');
	
		if (is_array($condition)) {
			$this->db->where($condition);
		}
		return $this->db->get('payment')->result();
	}



    public function getReceipt()
    {
        header('Content-Type: application/json');
        $result = $this->setting_model->get_payment(array('payment.id' => $_POST['id']))[0];
        $id = $_POST['id'];
        $data = [
			'company'  		=> get_by_id('company', ['id' => 1]),
			'customer' 		=> get_by_id('users', ['id' => $result->created_by]),
			
			'number' 	=> $result->receipt,
			'code' 	=> $result->receipt,
			'type' => 'saved',
			'created_at' => $result->created_at,
			'id' =>$_POST['id'],
            'method_id' => $result->method_id,
            'invoices' => $this->get_receipt_data( ['payment.id' => $result->id]),
            'total' =>$result->amount
			
		];
       
       
      
        $b64Doc = $this->cart_model->drawPDF($data, 'payment', $id, false);

        echo json_encode(array('modal' => $this->load->view('layout/doc_modal', $data, true), 'pdf' => $b64Doc, 'result' => $this->get_receipt_data( ['payment.id' => $result->id])));
    }

    public function getInputs()
    {
        $id = $_POST['id'];
        if ($id == 3) {
            echo $this->load->view('payment/input_check', null, true);
        } elseif ($id == 12) {
            echo $this->load->view('payment/input_transference', null, true);
        } elseif ($id == 13) {
            echo $this->load->view('payment/input_deposit', null, true);
        }
    }

    public function get_payment()
    {
        $this->db->select(array(
            'payment.*',
            'controller.code',
            'users.id as users_id',
           
            'payment_method.name as pay_method_name',
            'payment_method.id as pay_method',
            'payment_method.parent_id',
            'CONCAT(users.first_name, " ", users.last_name) AS seller'
        ));
        $this->db->join('controller', 'controller.id = payment.controller_id', 'LEFT');
        $this->db->join('payment_method', 'payment_method.id = payment.method_id', 'LEFT');
        $this->db->join('users', 'users.id = payment.created_by', 'LEFT');
        $this->db->where('payment.active', 1);

    }

    public function count_all()
    {
        $this->get_payment();
        return $this->db->get('payment')->num_rows();
    }

    public function search_data($limit, $start, $condition = null)
    {
        $this->get_payment();
        if (is_array($condition)) {
            $this->db->where($condition);
        }
        if ($limit != -1) {
            $this->db->limit($limit, $start);
        }

        $this->db->order_by('payment.id', 'DESC');
        $query = $this->db->get('payment');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function search_data_count($condition = null)
    {
        $this->get_payment();
        if (is_array($condition)) {
            $this->db->where($condition);
        }
        return $this->db->get('payment')->num_rows();
    }

    public function filter()
    {
        $limit = $this->input->post('length');
        $start = $this->input->post('start');

        $totalData = $this->count_all();

        $data = array(
            'DATE_FORMAT(payment.created_at,"%Y-%m-%d")>=' => $_POST['init_date'],
            'DATE_FORMAT(payment.created_at,"%Y-%m-%d")<=' => $_POST['final_date'],
        );
        if ($_POST['payment_method']) {
            $data['payment_method.id'] = $_POST['payment_method'];
        }

        if ($_POST['customer']) 
            $data['users.id'] = $_POST['customer'];
        

        $payments = $this->search_data($limit, $start, $data);
        $totalFiltered = $this->search_data_count($data);
        $result = array();

        if (!empty($payments)) {
            $counter = $start + 1;
            foreach ($payments as $payment) {
                $nestedData['counter'] = "<label class='w-100 text-center'>" . $counter . "</label>";
                $nestedData['receipt'] = $payment->receipt;
                $nestedData['customer'] = $payment->seller;
                $nestedData['pay_method_name'] = $payment->pay_method_name;
                $nestedData['amount'] = "<label class='w-100 text-right'>" . number_format($payment->amount, 2) . "</label>";
                $nestedData['created_at'] = "<label class='w-100 text-center'>" . date_format(date_create($payment->created_at), 'd-m-Y H:i') . "</label>";
                $nestedData['action'] = $this->get_actions($payment);
                $counter++;
                $result[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $result,
            "start" => $start,
            "limit" => $limit
        );
        echo json_encode($json_data);
    }

    public function get_actions($payment)
    {
        return $this->load->view('payment/template/_actions', array('payment' => $payment), true);
    }

    public function cancel_payment()
    {
        header('Content-Type: application/json');
        $payment_id = $_POST['payment_id'];
        echo json_encode($this->cancel_payment_inner($payment_id));
    }

    public function cancel_payment_inner($payment_id, $can_delete = null)
    {
        $payment = get_by_id('payment', ['id' => $payment_id]);
        $fine_payments = get_all('fine_payment', ['payment_id' => $payment_id, 'active' => 1]);

        foreach ($fine_payments as $fine_payment) {
            update('fine_payment', ['active' => 0], ['payment_id' => $payment_id, 'fine_id' => $fine_payment->fine_id]);
            $fine = get_by_id('fine', ['id' => $fine_payment->fine_id]);
            if ($fine) {
                update('fine', ['debt' => $fine->value, 'amount_paid' => 0], ['id' => $fine->id]);
            }
            if ($can_delete) {
                delete('fine_payment', ['payment_id' => $payment_id, 'fine_id' => $fine_payment->fine_id]);
            }
        }

        $instalment_payments = get_all('instalment_payment', ['payment_id' => $payment_id, 'active' => 1]);

        foreach ($instalment_payments as $instalment_payment) {
            update('instalment_payment', ['active' => 0], ['payment_id' => $payment_id, 'instalment_id' => $instalment_payment->instalment_id]);
            $instalment = get_by_id('instalment', ['id' => $instalment_payment->instalment_id]);
            if ($instalment) {
                update('instalment', ['status' => 'pendente'], ['id' => $instalment->id]);
            }
            if ($can_delete) {
                delete('instalment_payment', ['payment_id' => $payment_id, 'instalment_id' => $instalment_payment->instalment_id]);
            }
        }

        if ($can_delete) {
            update('instalment', ['status' => 'pendente'], ['loan_id' => $payment->loan_id]);
        }

        update('payment', ['active' => 0], ['id' => $payment_id]);
        $response['message'] = 'done';
        return $response;
    }

    public function fix_payment_inner($loan_id)
    {
        ini_set('max_execution_time', 0);

        $loan = get_by_id('loan', ['id' => $loan_id]);
        foreach (get_all('payment', ['loan_id' => $loan_id, 'active' => 1]) as $key => $payment) {
            $this->cancel_payment_inner($payment->id, true);
            update('payment', ['active' => 1], ['id' => $payment->id]); // activo porque desactivo no cancel payment
            $value_total = $payment->amount;
            $payment_id = $payment->id;

            $fines = get_all(
                'fine',
                [
                    'loan_id' => $loan_id,
                    'active' => 1,
                    'debt !=' => 0,
                    'DATE_FORMAT(created_at,"%Y-%m-%d") <=' => simple_date($payment->created_at, 'Y-m-d'),
                ],
                ['date', 'ASC']
            );

            foreach ($fines as $fine) {
                $debt_fine = $this->loan_model->get_debt_fine_only($fine->id);

                if ($value_total > 0 && $debt_fine > 0) {
                    if ($value_total >= $debt_fine) {
                        $value_total -= $debt_fine;
                        $amount_paid = $debt_fine;
                    } else {
                        $amount_paid = $value_total;
                        $value_total = 0;
                    }
                    insert(
                        'fine_payment',
                        array(
                            'fine_id' => $fine->id,
                            'payment_id' => $payment_id,
                            'amount' => $amount_paid,
                            'created_at' => $payment->created_at,
                            'updated_at' => $payment->updated_at
                        )
                    );
                    $debt_fine_update = $this->loan_model->get_debt_fine_only($fine->id);
                    update('fine', ['debt' => $debt_fine_update], ['id' => $fine->id]);
                }
            }

            $instalments = get_all('instalment', ['status !=' => 'paga', 'loan_id' => $loan_id, 'active' => 1], ['due_date', 'ASC']);
            foreach ($instalments as $key_ins => $instalment) {
                $debt = $this->loan_model->get_debt_instalment($instalment);
                if ($debt > 0 && $value_total > 0) {
                    if ($debt > $value_total) {
                        $to_pay = $value_total;
                        $value_total = 0;
                    } else {
                        $to_pay = $debt;
                        $value_total -= $to_pay;
                    }

                    insert('instalment_payment', [
                        'payment_id' => $payment->id,
                        'instalment_id' => $instalment->id,
                        'amount' => $to_pay,
                        'created_at' => $payment->created_at,
                        'updated_at' => $payment->updated_at
                    ]);
                }
            }
        }

        foreach (get_all('instalment', ['status !=' => 'paga', 'loan_id' => $loan_id, 'active' => 1]) as $instalment_check) {
            if ($this->loan_model->get_debt_instalment($instalment_check) <= 0) {
                update('instalment', ['status' => 'paga'], ['id' => $instalment_check->id]);
            }
        }
        $this->ion_auth->logout();
        redirect(base_url('login'));
    }

    public function generate_payment()
    {
        //        foreach (get_all('loan', ['status !=' => 'fechado']) as $loan) {
        //            $value_total = 0;
        //            foreach (get_all('payment', array('loan_id' => $loan->id)) as $key => $payment) {
        //                $value_total += $payment->amount;
        //                $instalments = get_all('instalment', ['status !=' => 'paga', 'loan_id' => $loan->id], array('id', 'ASC'));
        //                foreach ($instalments as $key_ins => $instalment) {
        //                    $debt = $this->loan_model->get_debt_instalment($instalment, $loan);
        //                    if ($debt > 0 && $value_total > 0) {
        //                        if ($debt > $value_total) {
        //                            $to_pay = $value_total;
        //                            $value_total = 0;
        //                        } else {
        //                            $to_pay = $debt;
        //                            $value_total -= $to_pay;
        //                        }
        //
        //                        $min_fine = array(
        //                            'payment_id' => $payment->id,
        //                            'instalment_id' => $instalment->id,
        //                            'amount' => $to_pay
        //                        );
        //                        insert('instalment_payment', $min_fine);
        //
        //                        if ($this->loan_model->get_debt_instalment($instalment, $loan) <= 0) {
        //                            update('instalment', array('status' => 'paga'), array('id' => $instalment->id));
        //                        }
        //                    }
        //                }
        //            }
        //        }
        echo 'done';
    }

    function gets()
    {
        echo "<pre>";
        //        $this->fix_payment_inner(29);
        //        print_r(get_all('instalment', array('status !=' => 'paga', 'loan_id' => 29), array('due_date', 'ASC')));
        echo "</pre>";
    }

    function fix_payment()
    {
        if (isset($_GET['id'])) {
            $loan_id = $_GET['id'];
            $this->fix_payment_inner($loan_id);
        } else {
            echo 'HAHAHAHAHHA....';
        }
    }

    function fix_loan()
    {
        if (isset($_GET['id'])) {

            $loan = get_by_id('loan', ['id' => $_GET['id']]);
            $instalments = $this->loan_model->generate_simulation($loan->pay_type, $loan->amount_borrowed, $loan->instalments, $loan->interest_rate / 100, $loan->signature_date, $loan->customer_id);

            $amount_month = $instalments['total']['debt_month'];
            $capital_period = $instalments['total']['capital_period'];
            update('loan', array(
                'capital_period' => $capital_period,
                'amount_month' => $amount_month,
                'amount_total' => $instalments['total']['total_debt'],
            ), array('id' => $loan->id));

            foreach ($instalments['data'] as $item) {
                $instalment = array(
                    'capital_period' => $item['capital_period'],
                    'interest_period' => $item['interest_period'],
                    'due_date' => $item['due_date'],
                    'amount_total' => $item['debt'],
                    'interest_rate' => $item['interest_rate'],
                    'loan_id' => $loan->id,
                    'amount' => $instalments['total']['debt_month']
                );
                //                if (!get_by_id('instalment', ['loan_id' => $loan->id, 'due_date' => $item['due_date']])) {
                //                    insert('instalment', $instalment);
                //                }
                update('instalment', $instalment, ['loan_id' => $loan->id, 'due_date' => $item['due_date']]);
            }
            //            $this->ion_auth->logout();
            //            redirect(base_url('login'));
        } else {
            echo 'HAHAHAHAHHA....';
        }
    }

    function filter_export()
    {
        header('Content-Type: application/json');

        $data = array(
            'DATE_FORMAT(payment.created_at,"%Y-%m-%d")>=' => $_POST['init_date'],
            'DATE_FORMAT(payment.created_at,"%Y-%m-%d")<=' => $_POST['final_date'],
        );
        if ($_POST['payment_method']) {
            $data['payment_method.id'] = $_POST['payment_method'];
        }

        if ($_POST['customer']) {
            $data['customer.id'] = $_POST['customer'];
        }

        $this->get_payment();
        $this->db->where($data);
        $result = $this->db->get('payment')->result();

        if ($result) {
            $action = 'excel';
            $file = '';
            if ($_POST['action'] == 'excel') {
                $file = $this->generate_excel_payments($_POST['init_date'], $_POST['final_date'], $result);
            } else {
                $action = 'pdf';
                $file = $this->generate_pdf_payments($_POST['init_date'], $_POST['final_date'], $result);
            }
            echo json_encode(['ok' => true, 'action' => $action, 'file' => $file, 'message' => 'Dados exportados com sucesso']);
        } else {
            echo json_encode(['ok' => false, 'message' => 'Sem dados para serem exportados']);
        }
    }

    function generate_excel_payments($init_date, $final_date, $data)
    {
        try {
            $mySpreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
            $mySpreadsheet->removeSheetByIndex(0);
            $worksheet1 = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($mySpreadsheet, "Pagamentos");
            $mySpreadsheet->addSheet($worksheet1, 0);
            $header = [
                '#',
                'Recibo',
                'Cliente',
                'Forma de pagamento',
                'Valor pago',
                'Data'
            ];
            $body = [];
            foreach ($data as $counter => $payment) {
                $line = [
                    $counter + 1,
                    $payment->receipt,
                    $payment->customer,
                    $payment->pay_method_name,
                    number_format($payment->amount, 2),
                    simple_date($payment->created_at, 'd-m-Y H:i')
                ];
                array_push($body, $line);
            }
            $sheet1Data = [
                $header,
            ];

            foreach ($body as $line) {
                array_push($sheet1Data, $line);
            }
            $worksheet1->fromArray($sheet1Data);
            $worksheets = [$worksheet1];

            foreach ($worksheets as $worksheet) {
                foreach ($worksheet->getColumnIterator() as $column) {
                    $worksheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
                }
            }
            $file_path = 'public/report';
            if (!is_dir($file_path)) {
                mkdir($file_path, 0777, true);
            }
            set_cookie('file_path', $file_path, time() + 3600);
            $file_name = 'Pagamentos-' . $init_date . '-' . $final_date . '.xlsx';
            $file_path .= '/' . $file_name;

            $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($mySpreadsheet);
            $writer->save($file_path);
            set_cookie('file_excel', $file_name, time() + 3600);
            return $file_name;
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            return false;
        }
    }

    function generate_pdf_payments($init_date, $final_date, $data)
    {
        $this->pdf->load_view('payment/pdf', ['payments' => $data, 'init_date' => $init_date, 'final_date' => $final_date]);
        $options = $this->pdf->getOptions();
        $options->setIsRemoteEnabled(true);
        $this->pdf->setOptions($options);

        $this->pdf->render();
        $canvas = $this->pdf->getCanvas();
        $fontMetrics = new \Dompdf\FontMetrics($canvas, $options);
        $font = $fontMetrics->getFont('Nunito');
        $canvas->page_text(534, 765, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 7, array(0, 0, 0));
        $output = $this->pdf->output();

        $invoicePath = 'public/report';
        if (!is_dir($invoicePath)) {
            mkdir($invoicePath, 0777, true);
        }
        $invoicePath .= '/pagamento-' . $init_date . '-' . $final_date . '.pdf';

        $fp = fopen($invoicePath, 'w+');
        if (fwrite($fp, $output)) {
            return chunk_split(base64_encode(file_get_contents(base_url($invoicePath))));
        } else {
            return false;
        }
    }
}


//Andrade
