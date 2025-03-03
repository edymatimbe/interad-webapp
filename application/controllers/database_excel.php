<?php

defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

//include_once (dirname(__FILE__) . "/Invoice.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once('vendor/autoload.php');
class Database_excel extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'your session has expired');
            redirect(base_url('auth'));
        }
        $this->setting = $this->core_model->get_by_id('setting', array('id' => 1));

        $this->user_id = $this->ion_auth->get_user_id();
        $this->user = $this->core_model->get_by_id('users', array('id' => $this->user_id));
        $this->company = $this->core_model->get_by_id('company', array('id' => $this->session->userdata('company_id')));
    }


    function insert_product()
    {
        $inputFileName = 'public/excel/computadores.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

        $datas = $spreadsheet->getActiveSheet()->toArray();

        //relação nominal de campos na base de dados
        $keys = $datas[0];

        //variavel para excluir a primeira linha do ficheiro na inserção
        $controle = 0;
        $product = [];

        //Variavel para controlar se as insercoes foram bem sucedidas;
        $sucess = true;

        foreach ($datas as $data) {

            if ($controle) {

                foreach ($data as $key => $value) {
                    if ($keys[$key]) {
                        $product[$keys[$key]] = $value;
                    }
                }

                $category = $this->core_model->get_all('category', ['name' => $product['category_id']]);

                if (count($category) > 0) {
                    $product['category_id'] = $category[0]->id;
                }else{

                    $category['name'] =  $product['category_id'];
                    $category['active'] = 1;
                    $category['is_service'] = 0;
                    $category['in_invoice'] = 0;
                    $category['company_id'] = $this->session->userdata('company_id');
                    $category['created_by'] = $this->ion_auth->get_user_id();
                    $category['updated_by'] = $this->ion_auth->get_user_id();
                    $category['created_at'] =  date("Y-m-d H:i:s");
                    $category['updated_at'] =  date("Y-m-d H:i:s");

                    $this->core_model->insert('category', $category);
                    $product['category_id'] =  $this->session->userdata('last_id');
                }


                if ($product['brand_id']) {

                    $brand = $this->core_model->get_all('brand', ['name' => $product['brand_id']]);

                    if (count($brand) > 0) {
                        $product['brand_id'] = $brand[0]->id;
                    } else {
                        $this->user_id = $this->ion_auth->get_user_id();
                        $this->user = $this->core_model->get_by_id('users', array('id' => $this->user_id));
                        $this->company = $this->core_model->get_by_id('company', array('id' => $this->session->userdata('company_id')));

                        $b = [
                            'name' => $product['brand_id'],
                            'active' => 1,
                            'company_id' => $this->session->userdata('company_id'),
                            'created_by' => $this->ion_auth->get_user_id(),
                            'updated_by' => $this->ion_auth->get_user_id(),
                        ];

                        if ($this->core_model->insert('brand', $b)) {
                            $product['brand_id'] = $this->session->userdata('last_id');
                        }
                    }
                } else {
                    $brand = $this->core_model->get_all('brand', ['name' => 'mixed']);

                    if (count($brand) > 0) {
                        $product['brand_id'] = $brand[0]->id;
                    } else {
                        $this->user_id = $this->ion_auth->get_user_id();
                        $this->user = $this->core_model->get_by_id('users', array('id' => $this->user_id));
                        $this->company = $this->core_model->get_by_id('company', array('id' => $this->session->userdata('company_id')));

                        $b = [
                            'name' => 'Mixed',
                            'active' => 1,
                            'company_id' => $this->session->userdata('company_id'),
                            'created_by' => $this->ion_auth->get_user_id(),
                            'updated_by' => $this->ion_auth->get_user_id(),
                            'created_at' =>  date("Y-m-d H:i:s"),
                            'updated_at' =>  date("Y-m-d H:i:s"),
                        ];

                        if ($this->core_model->insert('brand', $b)) {
                            $product['brand_id'] = $this->session->userdata('last_id');
                        }
                    }
                }


                $exist = $this->core_model->get_all('product', ['name' => $product['name']]);

                if (!(count($exist) > 0)) {
                    $product['active'] = 1;
                    $product['barcode'] = '1';
                    $product['is_service'] = 0;
                    $product['company_id'] = $this->session->userdata('company_id');
                    $product['created_by'] = $this->ion_auth->get_user_id();
                    $product['updated_by'] = $this->ion_auth->get_user_id();
                    $product['created_at'] =  date("Y-m-d H:i:s");
                    $product['updated_at'] =  date("Y-m-d H:i:s");
                    

                    $cost_price = $product['cost_price'];
                    $sale_price = $product['sale_price'];
                    
                    unset($product['cost_price']);
                    unset($product['sale_price']);

                    if ($this->core_model->insert('product', $product)) {
                        $product_id = $this->session->userdata('last_id');
                        $this->product_purchase($product_id, $cost_price, $sale_price);
                    } else {
                        $sucess = false;
                    }
                }
            }

            $controle++;
        }

        if ($sucess) {
            echo "Dados adicionados com sucesso";
        } else {
            echo "Erro ao tentar adicionar";
        }
    }



    function product_purchase($id, $cost_price, $sale_price)
    {
        //purchase product

        $cost_price = $cost_price;
        $price_ex_tax = $sale_price;
        $price_inc_tax = $price_ex_tax + $price_ex_tax * 0.16;
        $mark_up = $price_ex_tax - $cost_price;

        $batch = [
            'stock' => 1,
            'stock_min' => 1,
            'cost_price' =>  $cost_price,
            'mark_up' =>  $mark_up,
            'price_ex_tax' =>  $price_ex_tax,
            'price_inc_tax' =>  $price_inc_tax,
            'product_id' => $id,
            'purchase_id' => 0,
            'quantity_purchased' => 1,
            'active' => 1,
            'company_id' => $this->session->userdata('company_id'),
            'created_by' => $this->ion_auth->get_user_id(),
            'updated_by' => $this->ion_auth->get_user_id(),
            'unit_measurement_id' => 1,
            'cost_price_tax' => 0,
        ];

        $this->core_model->insert('batch', $batch);
    }


    function insert_category()
    {
        $inputFileName = 'public/excel/category.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

        $datas = $spreadsheet->getActiveSheet()->toArray();

        //relação nominal de campos na base de dados
        $keys = $datas[0];

        //variavel para excluir a primeira linha do ficheiro na inserção
        $controle = 0;
        $category = [];

        //Variavel para controlar se as insercoes foram bem sucedidas;
        $sucess = true;

        foreach ($datas as $data) {

            if ($controle) {

                foreach ($data as $key => $value) {
                    $category[$keys[$key]] = $value;
                }

                $exit = $this->core_model->get_all('category', ['name' => $category['name']]);
                if (!(count($exit) > 0)) {

                    $category['active'] = 1;
                    $category['is_service'] = 0;
                    $category['in_invoice'] = 0;
                    $category['company_id'] = $this->session->userdata('company_id');
                    $category['created_by'] = $this->ion_auth->get_user_id();
                    $category['updated_by'] = $this->ion_auth->get_user_id();
                    $category['created_at'] =  date("Y-m-d H:i:s");
                    $category['updated_at'] =  date("Y-m-d H:i:s");

                    if (!$this->core_model->insert('category', $category)) {
                        $sucess = false;
                    }
                }
            }

            $controle++;
        }

        if ($sucess) {
            echo "Dados adicionados com sucesso";
        }
    }

    function insert_brand()
    {
        $inputFileName = 'public/excel/brand.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

        $datas = $spreadsheet->getActiveSheet()->toArray();

        //relação nominal de campos na base de dados
        $keys = $datas[0];

        //variavel para excluir a primeira linha do ficheiro na inserção
        $controle = 0;
        $brand = [];

        //Variavel para controlar se as insercoes foram bem sucedidas;
        $sucess = true;

        foreach ($datas as $data) {

            if ($controle) {

                foreach ($data as $key => $value) {
                    if ($keys[$key]) {
                        $brand[$keys[$key]] = $value;
                    }
                }

                $exit = $this->core_model->get_all('brand', ['name' => $brand['name']]);

                if (!(count($exit) > 0)) {
                    $brand['company_id'] = $this->session->userdata('company_id');
                    $brand['created_by'] = $this->ion_auth->get_user_id();
                    $brand['updated_by'] = $this->ion_auth->get_user_id();

                    if (!$this->core_model->insert('brand', $brand)) {
                        $sucess = false;
                    }
                }
            }

            $controle++;
        }

        if ($sucess) {
            echo "Dados adicionados com sucesso";
        } else {
            echo "Erro ao tentar adicionar";
        }
    }
}
