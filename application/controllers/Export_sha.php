<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Export_sha extends CI_Controller {
    // construct
    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('Export_model', 'export');
    }    
 
    public function index() {
        $data['export_list'] = $this->export->exportList();
        $this->load->view('export', $data);
    }
    // create xlsx
    public function generateXls() {
        // create file name
        $fileName = 'data-'.time().'.xlsx';  
        // load excel library
        $this->load->library('excel');
        $listInfo = $this->export->exportList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'DOB');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Contact_No');       
        // set Row
        $rowCount = 2;
        foreach ($listInfo as $list) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list->first_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->last_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->dob);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list->contact_no);
            $rowCount++;
        }
        // $filename = "tutsmake". date("Y-m-d-H-i-s").".xlsx";
        // header('Content-Type: application/vnd.ms-excel'); 
        // header('Content-Disposition: attachment;filename="'.$filename.'"');
        // header('Cache-Control: max-age=0'); 
        // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');  
        // $objWriter->save('php://output'); 
        
        
        $filename='just_some_random_name.xls'; //save our workbook as this file name
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
            
//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
    }
     
    public function processexcel() {
        $fileName = 'data-'.time().'.xls';  
        $this->load->library('excel');
        $listInfo = $this->export->exportList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'DOB');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Contact_No');       
        // set Row
        $rowCount = 2;
        foreach ($listInfo as $list) {
            // print_r($list);exit;
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list['first_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list['last_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list['email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list['dob']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list['contact_no']);
            $rowCount++;
        }
            $folder = "uploads/dailylatecomming/";
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            $filename = rand();
            $file = ROOTDOCUMENT.$folder.$fileName;
        

$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
$objWriter->save($file);
    }
    
 public function action()
 {

$this->load->library('excel');
$workbook = new PHPExcel();
$worksheet = $workbook->getActiveSheet();
$worksheet->setCellValue('A1', 'ID');
$worksheet->setCellValue('B1', 'Name');
$worksheet->setCellValue('C1', 'Email');
$data = array(
    array('id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'),
    array('id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'),
    array('id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com'),
);

$row = 2;
foreach ($data as $item) {
    $worksheet->setCellValue('A' . $row, $item['id']);
    $worksheet->setCellValue('B' . $row, $item['name']);
    $worksheet->setCellValue('C' . $row, $item['email']);
    $row++;
}
$filename = 'data.xlsx';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($workbook, 'Excel2007');
$objWriter->save('php://output');


 }

     
}
?>