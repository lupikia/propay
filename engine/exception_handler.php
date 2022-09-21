<?php

class Exception_handler extends Exception
{

    private $response;
    public $code;

    public function __construct($code,$error=null){
        $this->response=array(
            "success"=>false,
            "error"=>"",
            "type"=>0,
            "type_call"=>"ser_exc_form",
            "data"=>array("contact"=>"For any technical issues please email us at support","error_code"=>"0"));
        $this->code=$code;
        $this->exception_handler_mail_dev($code,$error);
    }

    public function exception_handler_terminate($data=null){

        switch ($this->code) {
            case 0 :
                $this->exception_handler_no_msg();
                break;
            case 1 :
                $this->exception_handler_failed_query_msg();
                break;
            case 2 :
                $this->exception_handler_failed_validation_msg($data);
                break;
            case 3 :
                $this->exception_handler_timeout_msg();
                break;
            case 4 :
                $this->exception_handler_failed_service();
                break;
            case 5 :
                $this->exception_handler_failed_execution();
                break;
            case 6 :
                $this->exception_handler_failed_sign_in();
                break;
            case 7 :
                $this->exception_handler_step_1_incomplete();
                break;
            case 9 :
                $this->exception_handler_email_failed();
                break;
            case 10 :
                $this->exception_handler_sign_in_incomplete();
                break;
            case 11 :
                $this->exception_handler_access_denied();
                break;
            case 12 :
                $this->exception_handler_incorrect_form_field();
                break;
            case 14 :
                $this->exception_handler_service_method_invalid();
                break;
            case 16 :
                $this->exception_handler_no_email();
                break;
            case 17 :
                $this->exception_handler_no_user_session();
                break;
            case 20 :
                $this->exception_handler_failed_service_response();
                break;
            case 21 :
                $this->exception_handler_not_valid();
                break;
            case 22 :
                $this->exception_handler_operation_failed();
                break;
            case 24 :
                $this->exception_handler_email_send_failed($data);
                break;
            case 29 :
                $this->exception_handler_token_nonexistent($data);
                break;
            case 33 :
                $this->exception_handler_password_attempt_fail_email_not_matching($data);
                break;
            case 1364 :
            case 1062 :
            case 1146 :
            case 1064 :
            case 1054 :
            case 1110 :
            case 1136 :
            case 1452 :
            case 0101 ://not a valid error code for failed query
            case 1366 ://not a valid error code for failed query
                $this->exception_handler_failed_query($this->code);
                break;
            case 1046 ://not a valid error code for failed query
                $this->exception_handler_db_selection_failed($this->code);
                break;
        }
     //   echo json_encode( $this->response);
       // exit();
    }

    private function exception_handler_mail_dev($code,$error){
        //mailing the developers

    }

    /*Start ------------------------------code 0------------------------------*/
    private function exception_handler_failed_query_msg(){

        $this->response["success"]=false;
        $this->response["error"]="Data not accepted";
    }
    /*END ------------------------------code 0------------------------------*/
    /*Start ------------------------------code 1------------------------------*/
    private function exception_handler_no_msg(){

        $this->response["success"]=false;
        $this->response["error"]="Data not accepted";
    }
    /*END ------------------------------code 1------------------------------*/

    /*Start ------------------------------code 2------------------------------*/
    private function exception_handler_failed_validation_msg($data){

        $this->response["success"]=false;
        $this->response["error"]="Data not accepted";
        $this->response["data"]=$data;
    }
    /*END ------------------------------code 2------------------------------*/

    /*Start ------------------------------code 3------------------------------*/
    private function exception_handler_timeout_msg(){

        $this->response["success"]=false;
        $this->response["error"]="Request not complete";
    }
    /*END ------------------------------code 3------------------------------*/

    /*Start ------------------------------code 4------------------------------*/
    private function exception_handler_failed_service(){

        $this->response["success"]=false;
        $this->response["error"]="Service not available";
        $this->response["data"]["error_code"]=$this->code;

    }
    /*END ------------------------------code 4------------------------------*/
    /*Start ------------------------------code 5------------------------------*/
    private function exception_handler_failed_execution(){

        $this->response["success"]=false;
        $this->response["error"]="System failure";
        $this->response["data"]["error_code"]=$this->code;

    }
    /*END ------------------------------code 5------------------------------*/
    /*Start ------------------------------code 6------------------------------*/
    private function exception_handler_failed_sign_in(){

        $this->response["success"]=false;
        $this->response["error"]="Incorrect credentials";
        $this->response["data"]["error_code"]=$this->code;
    }
    /*END ------------------------------code 6------------------------------*/

    /*Start ------------------------------code 7------------------------------*/
    private function exception_handler_step_1_incomplete()
    {

        $this->exception_handler_message("error-pop","Some of your data is incomplete, please enter complete data");
    }
    /*END ------------------------------code 7------------------------------*/

    /*Start ------------------------------code 8------------------------------*/
    private function exception_handler_email_failed(){

        $this->response["success"]=false;
        $this->response["error"]="Mail failed";
    }
    /*END ------------------------------code 9------------------------------*/
    /*Start ------------------------------code  10------------------------------*/
    private function exception_handler_sign_in_incomplete()
    {
        $this->exception_handler_message(null,"Email and password must be provided");
    }
    /*END ------------------------------code 10------------------------------*/

    /*Start ------------------------------code  11------------------------------*/
    private function exception_handler_access_denied(){

        $this->exception_handler_message(null,"Service request invalid");
    }
    /*END ------------------------------code 11------------------------------*/

    /*Start ------------------------------code  12------------------------------*/
    private function exception_handler_incorrect_form_field(){

        $this->response["success"]=false;
        $this->response["error"]="Incorrect Submitted data";
        $this->response["data"]["error_code"]=$this->code;

    }
    /*END ------------------------------code 12------------------------------*/
    private function exception_handler_service_method_invalid(){

        $this->exception_handler_message(null,"Service method invalid");

    }
    /*END ------------------------------code 14------------------------------*/

    /*Start ------------------------------code  15------------------------------*/
    private function exception_handler_no_email()
    {
        $this->exception_handler_message(null,"Email does not exist");
    }
    /*END ------------------------------code 15------------------------------*/

    private function exception_handler_no_user_session(){

        $this->response["success"]=false;
        $this->response["error"]="Sign in and attempt again";
        $this->response["data"]["error_code"]=$this->code;

    }
    private function exception_handler_history_compare(){

        $this->exception_handler_message(null,"No record found to compare");

    }
    /*START ------------------------------code 19------------------------------*/
    private function exception_handler_no_history(){

        $this->exception_handler_message("error-pop","You don't have any saved calculations, please save a calculation.");
    }
    /*END ------------------------------code 19------------------------------*/


    private function exception_handler_failed_service_response(){

        $this->response["success"]=false;
        $this->response["error"]="No response available!";
        $this->response["data"]["error_code"]=$this->code;

    }

    private function exception_handler_operation_failed(){

        $this->response["success"]=false;
        $this->response["error"]="Operation terminated";
        $this->response["data"]["error_code"]=$this->code;

    }

    /*START ------------------------------code 21------------------------------*/
         private function exception_handler_not_valid(){
        $this->response["success"]=false;
        $this->response["error"]="Invalid";
        $this->response["data"]["error_code"]=$this->code;
        /*End ------------------------------code 19------------------------------*/
    }

    /*END ------------------------------code 21------------------------------*/

    /*Start ------------------------------code  24------------------------------*/
    private function exception_handler_email_send_failed()
    {

        $this->exception_handler_message(null,"Email failed to send, please try again later");
    }
    /*END ------------------------------code 24------------------------------*/

    /*Start ------------------------------code  33------------------------------*/
    private function exception_handler_password_attempt_fail_email_not_matching($data)
    {
        $this->exception_handler_message("ser_exc_pop_form","That email does not exist,please type correct email.");

    }
    /*END ------------------------------code 33------------------------------*/

    /*Start ------------------------------code  1046------------------------------*/
    private function exception_handler_db_selection_failed(){

        $this->response["success"]=false;
        $this->response["error"]="Service failed";
    }
    /*END ------------------------------code 1046------------------------------*/


    /*Start ------------------------------Query error code ------------------------------*/

    /*1062->Unique duplicate insert
     *
     *
     *
     */
    private function exception_handler_failed_query($code){
        $error_code=array(
            "1062"=>"Data already exists!",
            "1146"=>"Request corrupted,try again later!",
            "1136"=>"Data failed to save!",//columns don't match table in db
            "1064"=>"Request corrupted,try again later!",//values format not formatted correctly
            "1054"=>"Request not completed!",
            "1110"=>"Request not completed!", //duplicate specified column during insert
            "1452"=>"Request is incomplete!", //duplicate specified column during insert
            "0101"=>"Data failed to update!", //failed update in table
            "1364"=>"Data table structure not updated!", //column constrain issues
            "1366"=>"Request miss match!" //column constrain issues
        );

        $this->exception_handler_message(false,$error_code[$code]);

    }
    public function exception_handler_message($handler=null,$error_message=null){

        $this->response["error"]=$error_message!==null? $error_message  : "Internal error";
        $this->response["data"]["error_code"]=$this->code;
        $this->response["type_call"]=$handler!==null? $handler  : "ser_exc_form";
    }
    public function exception_handler_error_stuc(){

       return $this->response;
    }


}