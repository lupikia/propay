<?php

function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}

// Example
if ( is_session_started() === FALSE ){
    session_start();

}

class Engine_session
{
    private $response;
    private $session_token;
    private $encryption;

    public function __construct(){

        //must only store user ID or email
        $this->response=array("success"=>false,"error"=>"none","data"=>[]);
        $this->encryption= new Engine_encryption();
    }

    public function session_sign_in ()
    {
        //creating session token
        $temp=$this->encryption->encryption_unique_id();
        $session_temp = explode("-",$temp);
        $session_token = substr($session_temp[0],0,1)  .  substr($session_temp[1],0,1) . substr($session_temp[2],0,1) . substr($session_temp[3],0,1) . substr($session_temp[4],0,1) ;

        $this->response["success"]=true;
        $this->response["data"]=array("original_token"=>$temp,"fake_token"=>$session_token);

        return $this->response;
    }


    public function session_temp_create_data ($identifier, $session_data){

        $_SESSION["{$identifier}"]=$session_data;

        return true;
    }

    public function session_temp_data_destroy ($identifier){

        if(isset($_SESSION["{$identifier}"]))
        {
            unset($_SESSION["{$identifier}"]);
        }

        return $this->response;
    }

    public function session_temp_get_data ($identifier)
    {
        if(isset($_SESSION["{$identifier}"]))
        {
           // echo "pass-5";
            $this->response["success"]=true;
            $this->response["data"]=$_SESSION["{$identifier}"];

        }else{
            $this->response["success"]=false;
        }
        return $this->response;
    }

    public function session_destroy(){

        if(session_destroy()){
            $this->response["success"]=true;
            return $this->response;
        }
        return $this->response;
    }

    public function session_authenticate_view()
    {
        $session_success= $this->session_temp_get_data("authenticated");
        if($session_success["success"])
        {
            //-->check is user actually signed in
            $data_select = new Data_select();

            $user =$session_success["data"];
            $session_success_1=$data_select->select_signed_in_check($user["customer_id"],$user["id"],"session");
           return true;
        }
        return false;
    }

    public function session_notification ($customer_data,$message,$template,$priority){



        $this->session_send($this->envelope);
        return $this->response;
    }

}