<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Africa/Maputo');

//include_once (dirname(__FILE__) . "/Invoice.php");
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require_once('vendor/autoload.php');
class Uploads extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'A sua sessão expirou');
            redirect(base_url('auth'));
        }
    }

    public function index()
    {
        $data = array(
            'title' => "Carregar ficheiro de presenças",
            'styles' => array(
                'vendor/daterangepicker/daterangepicker.css',
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/moment/moment.js',
                'vendor/daterangepicker/daterangepicker.js',
                'vendor/print-js/print.min.js',
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'employees' => get_all('employee', ['active' => 1, 'deleted' => 0], ['first_name', 'ASC']),
        );
        $this->load->view('upload/index', $data);
    }

    public function import_presences()
    {
        header('Content-Type: application/json;charset=UTF-8');

        $data = null;
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $allowedFileType = [
                'application/vnd.ms-excel',
                'text/xls',
                'text/xlsx',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];

            $status = 0;
            if (in_array($_FILES["file"]["type"], $allowedFileType)) {
                $Reader = new Xlsx();
                $spreadSheet = $Reader->load($path);
                $excelSheet = $spreadSheet->getActiveSheet();
                $spreadSheetAry = $excelSheet->toArray();
                $sheetCount = count($spreadSheetAry);

                if ($spreadSheetAry[0][1] == 'nome' && $spreadSheetAry[0][2] == 'barcode' && $spreadSheetAry[0][3] == 'venda') {

                    for ($row = 0; $row < $sheetCount; $row++) {

                        $code = $spreadSheetAry[$row][2];
                        // $name = $spreadSheetAry[$row][2];
                        $sale = $spreadSheetAry[$row][3];

                        $product = get_by_id('product', ['barcode' => $code]);

                        if ($product) {
                            $batch = get_by_id('batch', ['product_id' => $product->id, 'active' => 1]);
                            $price_ex_tax = $sale / 1.16;

                            $status = false;
                            $status = 10;
                          
                            if(update('batch',[
                                    'price_ex_tax' =>  $price_ex_tax,
                                    'price_inc_tax' => floatval($sale),
                                    'cost_price' =>  floatval($price_ex_tax - ($price_ex_tax * 0.05)),
                                    'mark_up' => 5
                                ],
                                ['id' => $batch->id]
                            ))
                            
                            {
                                $status = 1;
                            }else{
                               $status = 0;
                            }
                               
                        }
                    }

                            echo json_encode('true'. $status);

                } else {
                    echo json_encode('false'. $status);
                }
                die;

                // if (
                //     $spreadSheetAry[0][1] == 'nome' &&
                //     $spreadSheetAry[0][2] == 'barcode' &&
                //     $spreadSheetAry[0][3] == 'venda'
                // ) {
                // for ($row = 1; $row < $sheetCount; $row++) {

                //     $code = $spreadSheetAry[$row][1];
                //     $name = $spreadSheetAry[$row][2];
                //     $sale = $spreadSheetAry[$row][3];

                //     $product = get_by_id('product', ['barcode' => $code]);
                //     if ($product) {
                //         $batch = get_by_id('batch', ['product_id' => $product->id, 'active' => 1]);
                //         $price_ex_tax = $sale / 1.16;

                //         $status = false;

                //         if (update(
                //             'batch',
                //             [
                //                 'price_ex_tax' =>  $price_ex_tax,
                //                 'price_inc_tax' => floatval($sale),
                //                 'cost_price' =>  floatval($price_ex_tax - ($price_ex_tax / 0.05)),
                //                 'mark_up' => 5
                //             ],
                //             ['id' => $batch->id]
                //         )) {
                //             $status = true;
                // echo json_encode([
                //     'message' => $sheetCount,
                //     'status' => 'success',
                //     'ok' => true,
                // ]);
                //         } else {
                //             $status = false;
                //             echo json_encode([
                //                 'message' => "Error ao upload ",
                //                 'status' => 'error',
                //                 'ok' => false,
                //             ]);
                //         }
                //     }
                // }
                // }
                // echo json_encode([

                //     'message' => "Error ao careegar o ficheiro",
                //     'status' => 'error',
                //     'ok' => true,
                // ]);
            } else {
                echo json_encode([
                    'title' => "Ficheiro invalido",
                    'message' => "Carrega ficheiros Excel",
                    'status' => 'warning',
                    'ok' => false,
                ]);
            }
        }
    
    }
}
