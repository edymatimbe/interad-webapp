<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Home extends CI_Controller
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


	public function get_chart()
	{
		$monthes = [];

		for ($i = 1; $i <=  intval(date('m')); $i++) {
			$month_character = $i;
			if (strlen($i) == 1)
				$month_character = '0' . $i;
			$chart = [
				'count_active' => 	count(get_all('controller', ['DATE_FORMAT(init_date,"%m")' => $month_character, 'status' => 'pago'])),
				'pendente' => 	count(get_all('controller', ['DATE_FORMAT(init_date,"%m")' => $month_character, 'status' => 'pendente'])),
				'expiry' => 	count(get_all('controller', ['DATE_FORMAT(init_date,"%m")' => $month_character, 'status' => 'expirou']))
			];
			array_push($monthes, $chart);
		}
		echo json_encode($monthes);
	}


	public function getDayOfWeekName($number)
	{
		switch ($number) {
			case 0:
				return 'Domingo';
				break;
			case 1:
				return 'Seg. feira';
				break;
			case 2:
				return 'Ter. feira';
				break;
			case 3:
				return 'Qua. feira';
				break;
			case 4:
				return 'Qui. feira';
				break;
			case 5:
				return 'Sex. feira';
				break;
			case 6:
				return 'Sábado';
				break;
			default:
				return '';
		}
	}


	public function index()
	{
		$data = array(
       
			'title' => $this->lang->line('dashboard'),
			'styles' => array(
				
				'assets/web/dist/css/demo.min.css?1684106062',
				'assets/web/dist/css/tabler-flags.min.css?1684106062',
				'assets/web/dist/css/tabler-payments.min.css?1684106062',
				'assets/web/dist/css/tabler-vendors.min.css?1684106062',

			),
			'location' =>  get_all('controller_tax'),
		);
		
			$this->load->view('home/index', $data);
		
	}



	public function sale()
	{
		$data = array(
			'title' => $this->lang->line('dashboard'),
			'scripts' => array(
				'vendor/moment/moment.js',
				'vendor/daterangepicker/daterangepicker.js',
				'vendor/chart.js/Chart.min.js',
				'assets/report/sale.js',
			),
		);;
		$this->load->view('home/sale', $data);
	}

	public function hr()
	{
		$data =[
            'title' => 'Dashboard',
            'vendor/chart.js/chart.min.js',
        ];

		$this->load->view('home/hr', $data);
	}

	public function homeCompany()
	{

	}

	//	index view
	public function filter_report_user()
	{
		header('Content-Type: application/json');
		$data = $this->report_model->filter_report();
	}

	public function get_sales()
	{
		header('Content-Type: application/json');
		$sales = $this->report_model->report_generate('amount', 'payment');
	}

	public function get_categories()
	{
		header('Content-Type: application/json');
		$categpries = $this->report_model->category_report();
	}

	public function dashboard_data()
	{
		echo json_encode($dashboard_report = $this->report_model->dashboard_s());
	}
}
