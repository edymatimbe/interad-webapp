<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

class Website extends CI_Controller
{

	public function index()
	{
		$this->load->view('index', null);
	}

	public function pricing()
	{
		$this->load->view('website/prining', null);
	}

	public function homepage()
	{
		if (isset($_COOKIE['start']) && !empty($_COOKIE['start'])) {
			$tax = get_by_id('tax', ['code' => $_COOKIE['start']]);

			// if(!empty($_SESSION["tax_id"]) && !empty($_SESSION["tax_code"])){
			$this->session->set_userdata('tax_code', $_COOKIE['start']);
			$this->session->set_userdata('tax_id', $tax->id);
			// }

			$this->load->view('website/homepage');
		} else {
			if (!empty($_SESSION["tax_code"]) && isset($_SESSION["tax_code"])) {
				$this->load->view('website/homepage');
			} else {
				redirect(base_url('auth'));
			}
		}
	}

	public function get_ads()
	{
		$this->db->select(['banner.*']);
		$this->db->where('controller.status', 'pago');
		$this->db->join('controller', 'controller.banner_id = banner.id', 'LEFT');
		$this->db->order_by('banner.id', 'RANDOM');
		if (!empty($_POST['district'])){
		    	$this->db->where('controller.district', $_POST['district']);
		}else{
		    	$this->db->where('controller.id',3);
		}

		
		
		$restult = $this->db->get('banner')->result();

		echo json_encode($restult);
	}

	public function news(){

		$data = array(
            'title' => 'Listagem de Jornais',
            'newspapers' => $this->db->order_by('publish_date', 'DESC')->get('newspapers')->result(),
        );
        $this->load->view('website/news', $data);
        // echo $this->load->view('website/news',null,true);
    }
    public function view_news($id){
		$news = get_by_id('newspapers', ['id' =>$id]);
        echo $this->load->view('website/view_news',['news' => $news->pdf_path],true);
    }

    public function game(){
     
        echo $this->load->view('website/game',null,true);
    }

    public function playing_game($game){
     
        echo $this->load->view('website/playing_game',['game' => $game],true);
    }
    public function weather(){
        echo $this->load->view('website/weather',null,true);
    }

	public function mymuze()
	{
		$this->load->view('website/mymuze/index', null);
	}

	

	// public function count_loaded()
	// {

	// 	setcookie("start", $_COOKIE['start'], time() + (30 * 24 * 60 * 60), "/");
	// 	if (empty($_POST['latitude']) || empty($_POST['currentDistrict']) || empty($_POST['controller_id'])) {
	// 		echo json_encode('false, dados não completos');
	// 	} else {


	// 		$banner_id    	= $_POST['controller_id'];
	// 		$controller 	= get_by_id('controller', ['banner_id' => $banner_id]);
	// 		$data = [
	// 			'tax_id' => $this->session->userdata('tax_id'),
	// 			'controller_id' => $controller->id,
	// 		];
	// 		$check = get_by_id('controller_tax', $data);


	// 		$location = [
	// 			'lat' => floatval($_POST['latitude']),
	// 			'lng' => floatval($_POST['longitude'])
	// 		];
	// 		if ($check == true) {

	// 			$get_location = unserialize($check->location);
	// 			$get_location[] = $location;

	// 			$status['location'] = serialize($get_location);
	// 			$data['views'] = $check->views + 1;
	// 			if (update('controller_tax', $data, ['id' => $check->id])) {
	// 				echo json_encode($get_location);
	// 			} else {

	// 				echo json_encode('false');
	// 			}
	// 		} else {
	// 			// echo json_encode('create');
	// 			$get_location[] = $location;
	// 			$data['location'] = serialize($location);
	// 			$data['views'] = 1;
	// 			$data['created_by'] = $controller->created_by;
	// 			$data['updated_by'] = $controller->updated_by;
	// 			if (insert('controller_tax', $data)) {
	// 				echo json_encode('Isert');
	// 			} else {
	// 				echo json_encode('false');
	// 			}
	// 		}
	// 	}
	// }
	public function count_loaded()
	{

		setcookie("start", $_COOKIE['start'], time() + (30 * 24 * 60 * 60), "/");

		if (empty($_POST['latitude']) || empty($_POST['currentDistrict']) || empty($_POST['controller_id'])) {
			echo json_encode('false, dados não completos');
		} else {

			$this->session->set_userdata('tax_code', $_COOKIE['start']);
			$this->session->set_userdata('tax_id', $this->session->userdata('tax_id'));

			$banner_id    	= $_POST['controller_id'];
			$controller 	= get_by_id('controller', ['banner_id' => $banner_id]);

			$data = [
				'tax_id' => $this->session->userdata('tax_id'),
				'controller_id' => $controller->id,
			];

			$status = [];




			$check = get_by_id('controller_tax', $data);
			$data['active'] = 1;

			if ($check) {

				if (isset($_POST['latitude'])) {
					$location = [
						'lat' => floatval($_POST['latitude']),
						'lng' => floatval($_POST['longitude'])
					];

					if (!empty($check->location)) {
						$get_location = unserialize($check->location);
						$get_location[] = $location;
					} else {
						$get_location = [];
						$get_location[] = $location;
					}

					unset($data['views']);
					$data['location'] = serialize($get_location);
					$status['location'] = $get_location;
				} else {
					$data['views'] = $check->views + 1;
					if (empty($_COOKIE['new_location'])) {
						setcookie("new_location", $_POST['district'], time() + (86400 * 30), "/");
						$status['length'] =  true;
					} else {
						if ($_COOKIE['new_location'] != $_POST['district']) {
							setcookie("new_location", $_POST['district'], time() + (86400 * 30), "/");

							$status['new_location'] =  false;
						} else {
							$status['new_location'] =  true;
						}
					}
				}


				$data['created_by'] = $controller->created_by;
				$data['updated_by'] = $controller->updated_by;
				if (update('controller_tax', $data, ['id' => $check->id]))
					$status['db'] = 'update';
			} else {
				$data['views'] = 1;
				$data['created_by'] = $controller->created_by;
				$data['updated_by'] = $controller->updated_by;
				if (insert('controller_tax', $data))
					$status['db'] = 'insert';

				if (empty($_COOKIE['new_location'])) {
					setcookie("new_location", $_POST['district'], time() + (86400 * 30), "/");
					$status['new_location'] = true;
				}
			}


			echo json_encode($status);
		}
	}


	public function save_avaliations()
	{
		$banner_id = $_POST['video_id'];
		$controller_id 	= get_by_id('controller', ['banner_id' => $banner_id])->id;
		$data = [
			'tax_id' => $this->session->userdata('tax_id'),
			'controller_id' => $controller_id,
		];


		$check = get_by_id('controller_tax', $data);

		$status = 'error';

		if ($check) {
			unset($data['tax_id']);
			unset($data['controller_id']);


			if ($_POST['action'] == 'like') {
				$data['like'] = $check->like + 1;
			} else {
				$data['deslike'] = $check->deslike + 1;
			}

			if (update('controller_tax', $data, ['id' => $check->id]))
				$status = $_POST['action'];
		}
		echo json_encode($status);
	}
}
