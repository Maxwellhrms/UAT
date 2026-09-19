<?php
if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Logscron extends CI_Controller {
    public function __construct() {
		parent::__construct();
// 		$this->load->library('input');
	}
//-------------DOWNLOAD LOG
	public function download_log(){
		if(isset($_REQUEST['submit'])){
			$file_name = "log-".$_REQUEST['date'].".php";
			$file_path = "application/logs/".$file_name;
			// echo $file_path;exit;
			if(file_exists($file_path)){//---->If File Exist subject and message
				header('Content-Type: application/octet-stream');  
				header("Content-Transfer-Encoding: utf-8");   
				header("Content-disposition: attachment; filename=\"" . basename($file_path) . "\"");   
				readfile($file_path);
			}else{
				$this->session->set_flashdata('msg', 'No File Found');
				// echo $this->session->flashdata('msg');exit;
			}
		}
		$this->load->view('download_log');
	}
	//-------------END DOWNLOAD LOG
}