<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        //------NEW BY SHABABU(13-02-2022)
        $this->load->library('Authorization_Token');
        $this->load->helper(array('url','statuscode'));
        //------END NEW BY SHABABU(13-02-2022)
        #Validate Token  
        // $this->validate_token(); 
        #End Validate Token  
    }

    public function api_decode(){
        header('Content-type: application/json'); //Common For GET/POST-Methods
        $json = file_get_contents('php://input'); //Post-method
        return $obj = json_decode($json); //Post-method
    }
    
    public function api_encode($user_data,$user_desc=null){  
        if(count($user_data)>0){
            $message="Success";
            $statuscode="200";
            $desc=$user_desc;
        }else{
            $message="Failed";
            $statuscode="500";
            $desc=$user_desc;
        }
        $data[]=array("status"=>$statuscode,"msg"=>$message,"description"=>$desc);
        $data[]=$user_data;
     return "{\"userdata\": " .json_encode($data,JSON_UNESCAPED_UNICODE) . "}";
    }
    
    // -------------- added 14-02-2021 ----------------------
    public function api_encodecheck($user_data){  
        // if(empty($user_data)){
        //      $message="Failed";
        //             $statuscode="500";
        //             $desc = "No Data Exist";
        //             $data['status']=$statuscode;
        //             $data['msg']=$message;
        //             $data['description']='';
        // }
            $resp = json_encode($user_data,JSON_UNESCAPED_UNICODE);
            return $resp;
    }
    // --------------end added 14-02-2021 -----------------
    
    
    // --------------------added 06-02-2021 -----------------
     public function api_encode1($user_data,$user_desc=null){  
            if(count($user_data)>0){
                $message="Success";
                $statuscode="200";
                $desc=$user_desc;
            }else{
                $message="Failed";
                $statuscode="500";
                $desc=$user_desc;
            }
            // $d[] = array(
            //     "status" => $statuscode,
            //     "msg" => $message,
            //     "description" => $desc
            // );
           // $data1['userdata'] =$d;
            $data1['userdata'] = array(
                "status" => $statuscode,
                "msg" => $message,
                "description" => $desc
            );
            $data =array_merge($data1,$user_data);
            $resp = json_encode($data,JSON_UNESCAPED_UNICODE);
            //$resp .= json_encode($user_data,JSON_UNESCAPED_UNICODE);
            return $resp;
        }


// ----------------------- end --------------------------
    
    
    public function cleanInput($val){
        $value = strip_tags(html_entity_decode($val));
        $value = filter_var($value, FILTER_SANITIZE_STRIPPED);
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        return $value;
    }
    
    public function options_master($field_name){
        return $this->Common_model->options_master($field_name);
    }
    
    public function options_dropdown($field_name){
        return $this->Common_model->options_dropdown($field_name);
    }
    
    function date_rangewith_days($fromdate,$todate){
        $begin = new DateTime( $fromdate );
        $end   = new DateTime( $todate );
        $dayscount=0;
        $result=array();
        $dates = array();
        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            array_push($result,$i->format("Y-m-d"));
            $dayscount+=1;
        }
        $dates['noofday'] = $dayscount;
        $dates['attnddates'] = $result;
        return $dates;
    }
    
    //-------NEW BY SHABABU(13-02-2022)
    #JWT TOKEN VALIDATION
     public function validate_token(){
         
        $headers = $this->input->request_headers(); 
        # NEW FOR WEB NO TOKEN VALIDATION OF APIS
        // print_r($headers);exit;
        if(is_array($headers) && isset($headers['Accesstype']) && $headers['Accesstype'] == "web"){
            return 1;
        }
        
        
        #For Below api list in array We Ignore Token Validation
        $ignore_array = array("api_logincheck");
        
        if(in_array($this->uri->segment(2), $ignore_array)){            
            return 1;
        }      
        #End For Below api list in array We Ignore Token Validation        

        // print_r($headers);exit;
        
        # If Headers Not Contain Authorisation Key
		if(is_array($headers) && isset($headers['Authorization'])){ 
			$token_id = $headers['Authorization'];   
			
            # If Token Id Is Empty
            if(empty($token_id)){               
                Get_header_status_response(401);
                get_error_message(0,'Invalid Token',100);          
            }else{ # Main Code Starts From Here
                
                $decodedToken_data = $this->authorization_token->validateToken($token_id); 
                $emp_id = $decodedToken_data['data']->mxemp_emp_id;
                
                $where_array = array(
                    "mxemp_emp_status"=>1,
                    "mxemp_emp_jwt_token"=>$token_id,
                    "mxemp_emp_id"=>$emp_id,
                );
                $this->db->select("mxemp_emp_id");
                $this->db->from("maxwell_employees_info");
                $this->db->where($where_array);                
                $results = $this->db->get()->row();
                if(count($results)<=0){                     
                    Get_header_status_response(401);
                    get_error_message(0,'Invalid Token',101);          
                }
            }
		}else{# If Headers Not Contain authorisation Key     
            Get_header_status_response(401);
            get_error_message(0,'Invalid Token',102);
        }
    }
    #END JWT TOKEN VALIDATION
    //-------END NEW BY SHABABU(13-02-2022)
    
}
