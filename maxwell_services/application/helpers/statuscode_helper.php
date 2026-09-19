<?php
        //-------NEW BY SHABABU(21-12-2021)
        function get_header_status_response($status_flag = 401){

            if($status_flag == 401){
                /* 
                    *** 401 Unauthorized
                    # Although the HTTP standard specifies "unauthorized", semantically this response means "unauthenticated". 
                    # That is, the client must authenticate itself to get the requested response.
                */
                header("HTTP/1.1 401 Unauthorized");
            }else{
                /*
                    *** 200 OK
                    # The request succeeded. The result meaning of "success" depends on the HTTP method:

                    # GET: The resource has been fetched and transmitted in the message body.
                    # HEAD: The representation headers are included in the response without any message body.
                    # PUT or POST: The resource describing the result of the action is transmitted in the message body.
                    # TRACE: The message body contains the request message as received by the server.
                */
                header("HTTP/1.1 200 OK");
            }

        }

        function get_error_message($status = 0,$message,$error_code='',$data = array()){
            
            $errors_array = array(
                "100" => "Token Id Should Not Be Empty",
                "101" => "Invalid Token",
                "102" => "Please Pass The Token"
            );
            $response_data['status'] = $status;
            $response_data['message'] = $message;
            $response_data['error_code'] = $error_code;
            $response_data['data'] = $data;

            echo json_encode($response_data);exit;
        }
        //-------End NEW BY SHABABU(21-12-2021)
?>