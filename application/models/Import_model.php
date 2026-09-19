<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Import_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}


	function cleanInput($val)
    {
        $value = strip_tags(html_entity_decode($val));
        $value = filter_var($value, FILTER_SANITIZE_STRIPPED);
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        return $value;
    }

    function get_client_ip()
    {
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if ($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if ($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if ($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if ($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
	public function importdata($data,$tablename) {
	$res = $this->db->insert_batch($tablename,$data);
		if($res){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function gettables(){
		$sql = "SELECT TABLE_NAME as tablenames FROM information_schema.tables where TABLE_NAME LIKE 'maxwell_self_%'";
        $query = $this->db->query($sql);
        return $qury = $query->result();
	}

	public function getcolumns($tablename){
		$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tablename'";
        $query = $this->db->query($sql);
        return $qury = $query->result_array();
	}

    public function savecreatetable($data){
    	$tablename = str_replace(" ","_",trim($this->cleanInput($data['userdefinedtable'])));
    	$table = 'maxwell_self_'.$tablename;
    	$tableid = $tablename.'_id';
    	$tablestatus = 'status_'.$tablename;
		try{
			$this->load->dbforge();
			$fields = array(
			  $tableid => array(
			    'type' => 'INT',
			    'constraint' => 11,
			    'unsigned' => TRUE,
			    'auto_increment' => TRUE
			  ),
			  $tablestatus => array(
                'type' =>'INT',
                'constraint' => 1,
                'default' => 1
        	  )
			);
			$this->db->db_debug = false;
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key($tableid, TRUE);
			$qry = $this->dbforge->create_table($table);
			$db_error = $this->db->error();
	        if (!empty($db_error['message']) && !empty($db_error['code'])) {
	            throw new Exception('Error: ' . $db_error['message']);
	        }
        } catch (Exception $e) {
      		$qry = $e->getMessage();
        }
        $this->db->db_debug = true;
        return $qry;
    }

    public function savecreatecolumns($data){
		$tablename = $this->cleanInput($data['tablename']);
		$userdefinedcolumns = str_replace(" ","_",trim($this->cleanInput(strtolower($data['userdefinedcolumns']))));
		try{
			$this->db->db_debug = false;
			$sql ="select $userdefinedcolumns from $tablename";
	        $query = $this->db->query($sql);
	        $db_error = $this->db->error();
	        if (!empty($db_error['message']) && !empty($db_error['code'])) {
	        	$sql ="ALTER TABLE $tablename ADD COLUMN $userdefinedcolumns text";
	        	$qry = $this->db->query($sql);
	        }else{
	            throw new Exception('Column Already Exists');
	        }
    	}catch (Exception $e) {
      		$qry = $e->getMessage();
        }
        $this->db->db_debug = true;
        return $qry;
    }

    public function filterlist($tablename){
    	$tb = str_replace("maxwell_self_","",$tablename);
    	$status = 'status_'.$tb;
    	$this->db->select('*');
        $this->db->from($tablename);
        $this->db->where($status,'1');
        $query = $this->db->get();
        $qry = $query->result_array();
        return $qry;
    }

}
?>