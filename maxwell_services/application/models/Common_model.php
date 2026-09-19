<?php

error_reporting(0);
defined('BASEPATH') or exit('No Direct Script Acesses Allowed');

class Common_model extends CI_Model
{

    protected $imglink = 'uploads/';

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
    public function options_master($fieldname){
        $this->db->select('field_value,descr');
        $this->db->from('options_table');
        $this->db->where('field_name', $fieldname);
        $query = $this->db->get();
        $qry = $query->result();
        if(count($qry) > 0){
            foreach ($qry as $key => $value) {
            $options[$value->field_value] =  $value->descr;
            }
        }else{
         $options = array();   
        }
        return $options;
    }
   
    public function options_dropdown($fieldname){
        $this->db->select('field_value as value,descr as description');
        $this->db->from('options_table');
        $this->db->where('field_name', $fieldname);
        $this->db->where('options_status',1);
        $query = $this->db->get();
        $qry = $query->result();
        if(count($qry) > 0){
         $options = $qry;
        }else{
         $options = array();   
        }
        return $options;
    }
    
    
    public function validation_check_days($formdate,$to,$typename,$leavetype){
        // $options['status']= 1;
        // print_r($formdate); exit;
        $status =1;
        $this->db->select($typename);
        $this->db->from('maxwell_config');
        $query = $this->db->get();
        $qry = $query->result();
        // echo $this->db->last_query(); exit;
        $days= $qry[0]->$typename;
        if(strlen($days) == 1){
            $days = '0'.$days;
        }else{
          $days=$days;  
        }
        
        // $formdate = '2023-01-17';
        // $date_now = date("20230214"); 
        // $days = '07';
        // $cmth ='02';
        // $cntdtmth ='20230214'; 
        // $cntdtmth1 ='20230214';

        if(strlen(date('m')) == 1){
            $month = '0'.date('m');
        }else{
            $month=date('m');  
        }
        $frdate = date('Ymd',strtotime($formdate));
        $date_now = date("Ymd"); 
        $prevmtday='01';
        $frmth = date('ymd',strtotime($formdate));
        $cmth =date('ymd');
        
        if($frmth != $cmth){
            if($month == 01){
                // $prevmth = date('Y',strtotime($date_now)).'12';
                // $prevmth = date('Ym',strtotime($prevmth));
                
                $prevmth = date('Y',strtotime($date_now ." -1 year")).'12';
                $prevmth = date('Ym',strtotime($prevmth ." -1 year"));
            }else{
                $prevmth = date('Ym',strtotime($date_now." -1 month"));
                //  $prevmth = date('Ym',strtotime($date_now));
            }
            $premnthdays = $prevmth.$prevmtday;
            $premnthdays = date('Ymd',strtotime($premnthdays));
            //  print_r($premnthdays .' ===  '. $frdate) ; exit;
            if($premnthdays > $frdate){
                
                $options['message']='attendance closed previous';
                $options['status']= 0;
                $status =0;
                print_r($options); exit;
                return $status;
            }
        }
        
        // if($frmth > $cmth){
        //     $futmth = date('Ym',strtotime($date_now));
        //     $futmnthdays = $futmth.$days;
        //     $futmnthdays = date('Ymd',strtotime($futmnthdays));
        //     $cntdtmth =date('Ymd'); 
        //     if($futmnthdays <= $cntdtmth){
        //         $options['message']='attendance closed next';
        //         $options['status']= 0;
        //         $status=0;
        //         // return $status;
        //     }
        // }else
        
        if($frmth < $cmth){
            $futmth1 = date('Ym',strtotime($formdate." +1 month"));
            $futmnthdays1 = $futmth1.$days;
            $futmnthdays1 = date('Ymd',strtotime($futmnthdays1));
            $cntdtmth1 = date('Ymd'); 
            if($futmnthdays1 <= $cntdtmth1){
                $options['message']='attendance closed ffff';
                $options['status']= 0;
                $status =0;
                return $status;
            }
        }
        
        // $frdate = date('Ymd',strtotime($formdate));
        // $date_now = date("Ymd"); 
        // $futuremd = date('Ym',strtotime($date_now." +1 month"));
        // $futureymd = $futuremd.$days;
        // $futuremd = date('Ymd',strtotime($futureymd));
        
        // if( $futuremd <  $frdate ){
        //     $options['message']='attendance closed';
        //     $options['status']= 0;
        // }else{
        //      $options['message']='';
        //      $options['status']= 1;
        // }
       


        // if($frmth != $cmth){
        //     $futmth = date('Ym',strtotime($date_now." +1 month"));
        //     $premnthdays = $futmth.$days;
        //     if($premnthdays > $frdate){
        //         $options['message']='attendance closed future';
        //         $options['status']= 0;
        //         return $options;
        //     }else{
        //         $options['message']='';
        //         $options['status']= 1;
        //         return $options;
        //     }
        // }

    return $status;
    // print_r( $options); exit;
        
    } 
    
    
    public function api_get_assigned_auth_persons($employeeid)
    {
            $authar=[]; 
            $this->db->select("concat(mxemp_emp_fname,' ',mxemp_emp_lname) as employeename ,mxauth_auth_type,mxauth_reporting_head_emp_code as employeeid");
            $this->db->from('maxwell_emp_authorsations');
            $this->db->join('maxwell_employees_info','mxemp_emp_id = mxauth_reporting_head_emp_code','Inner');
            $this->db->where('mxauth_emp_code',$employeeid);
            $this->db->where('mxauth_status',1);
            $this->db->order_by('mxauth_auth_type','DESC');
            $query= $this->db->get();
            $result = $query->result_array();
            $ary = array('authfinal_empcode','authfinal_empname','auth1_empcode','auth1_empname','auth2_empcode','auth2_empname','auth3_empcode','auth3_empname','auth4_empcode','auth4_empname');
            foreach($ary as $k =>$arval){
                $authar[$arval]='';
            }
            foreach($result as $key =>$val){
                 if($key == 0){  
                    if($val['mxauth_auth_type'] == 3){
                        $authar['authfinal_empcode']=$val['employeeid'];
                        $authar['authfinal_empname']=$val['employeename'];
                    }else{
                        $authar['auth1_empcode'] = $val['employeeid'];
                        $authar['auth1_empname'] = $val['employeename'];
                    }
                }elseif($key ==1 ){
                    if($val['mxauth_auth_type'] == 3){
                        $authar['authfinal_empcode'] = $val['employeeid'];
                        $authar['authfinal_empname'] = $val['employeename'];
                    }else{
                        if($authar['auth1_empcode'] !=''){
                            $authar['auth2_empcode'] = $val['employeeid'];
                            $authar['auth2_empname'] = $val['employeename'];
                        }else{
                            $authar['auth1_empcode'] = $val['employeeid'];
                            $authar['auth1_empname'] = $val['employeename'];
                        }
                    }
                }elseif($key == 2){
                    if($val['mxauth_auth_type'] == 3){
                        $authar['authfinal_empcode']=$val['employeeid'];
                        $authar['authfinal_empname']=$val['employeename'];
                    }else{
                        if($authar['auth2_empcode'] != ''){
                            $authar['auth3_empcode'] = $val['employeeid'];
                            $authar['auth3_empname'] = $val['employeename'];
                        }else{
                            $authar['auth2_empcode'] = $val['employeeid'];
                            $authar['auth2_empname'] = $val['employeename'];
                        }
                    }
                }elseif($key == 3){
                    if($val['mxauth_auth_type'] == 3){
                        $authar['authfinal_empcode']=$val['employeeid'];
                        $authar['authfinal_empname']=$val['employeename'];
                    }else{
                        if($authar['auth3_empcode'] != ''){
                            $authar['auth4_empcode'] = $val['employeeid'];
                            $authar['auth4_empname'] = $val['employeename'];
                        }else{
                            $authar['auth3_empcode'] = $val['employeeid'];
                            $authar['auth3_empname'] = $val['employeename'];
                        }
                    }
                }
            }
            return $authar;
        }
   
}