<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Common.php';
class Dashboard extends Common {    
    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboardmodel');       
    }


    public function excel_generate($data,$name){
        array_walk($data, function (&$data) { unset($data['image']); });
        $list = json_decode(json_encode($data), true);
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Maxwell_HRMS_'.substr($name,0,11));
       
        $cou=1;
        $cou_1=2;
        $apl_arr=array();
        $apl_arr1=array();
    
            for ($i = 'a'; $i <= 'zz'; $i++) {
                $apl_arr1[$cou]=$i.$cou_1;
                $apl_arr[$cou]=$i;
                $cou++;
            }
            if (count($list)>0) {
                $array_keys1=array_keys($list[0]);
            }
    
            $array_keys=array();
            $array_keys1=$array_keys1;
    
            foreach ($array_keys1 as $key) {
                $t=str_replace('_1_', '(', $key);
                $t=str_replace('_2_', ')', $t);
                $t=str_replace('_3_', '/', $t);
                $t=str_replace('_4_', '#', $t);
                $t=str_replace('_', ' ', $t);
                $t=str_replace('$', '', $t);
                $array_keys[]=trim($t);
            }
            $this->excel->getActiveSheet()->mergeCells('A1:AZ1');
            $this->excel->getActiveSheet()->setCellValue('A1',' MAXWELL LOGISTICS PRIVATE LIMITED ');
            for ($i=0; $i < count($array_keys); $i++) {
                $this->excel->getActiveSheet()->getColumnDimension($apl_arr[$i+1].'2')->setWidth(25);
                $this->excel->getActiveSheet()->setCellValue($apl_arr1[$i+1], strtoupper($array_keys[$i]));
            }
    
            $this->excel->getActiveSheet()->getRowDimension('1') -> setRowHeight(22);
            $this->excel->getActiveSheet()->fromArray($list, null, 'A3');
    
            $filename = $name.time() . '.' . 'xls';
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); // live
            $objWriter->save('php://output');
    }
    
    public function verifylogin()
    {
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'admin/logout');
            die();
        }
    }

    public function index(){
	    $this->verifylogin();
		$this->header();
		$data['att_summary'] = $this->Dashboardmodel->dashboardsummary();
		$data['controller'] = $this;
		$this->load->view('dashboard/dashboard',$data);
		$this->footer();
    }
    
    public function exporttoexcel(){
        $this->verifylogin();
        $userdata = $this->input->get();
        $name=$userdata['name'];
        $mdfn =  $userdata['mdfn'];
        $data = $this->Dashboardmodel->$mdfn();
        
        $this->excel_generate($data,$name);
    }
    
    public function prepareformailingsendmail(){
        $this->verifylogin();
        $userdata = $this->input->post();
        $data['list'] = $this->Dashboardmodel->prepareformailingsendmail($userdata);
            foreach ($data['list'] as $ltkey => $ltval) {
                foreach ($ltval as $xkey => $xval) {
                    if(in_array($xkey, array('mxemp_emp_division_code','email_division','email_title','email_subject','email_body','email_cc','email_bc','branchemail'))){ continue; }
                   $tags['{'.$xkey.'}'] = $xval;
                }
                $data['list'][$ltkey]->templateinfo = rendertags($tags,$data['list'][$ltkey]->templateinfo,'');
                $tags = array();
            }
        #bulid mail formate
        foreach ($data['list'] as $key => $tval) {
            if(!empty($tval->email_cc)){$cc = explode(',',$tval->email_cc);}else{$cc = array();}
            if(!empty($tval->email_bc)){$bcc = explode(',',$tval->email_bc);}else{$bcc = array();}
            if(!empty($tval->branchemail)){
            array_push($cc,$tval->branchemail);
            }
            $senddata = array(
                "type" => $userdata['type'],
                "id" => $tval->templateid,
                'to' => array($tval->email),
                'cc' => $cc,
                'bcc' => $bcc,
                'subject' => $tval->email_subject,
                'body' => $tval->templateinfo,
                'attachments' => '',
                'createdby' => $this->session->userdata('user_name'),
                'createdempcode' => $this->session->userdata('user_id'),
            );
            // print_r($senddata);
            sendmails($senddata);
        }
        #build mail fromate
    }

}
?>