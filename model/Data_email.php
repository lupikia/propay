<?php

class Data_email
{
    private $response;
    private $envelope;
    private $template;

    public function __construct(){

        $this->response=array("success"=>false,"error"=>"","data"=>"");
        $this->envelope=array("message"=>"",
            "headers"=>"","subject"=>"","recipient"=>'');
    }

    public function email_sign_up ($data,$token){

        $template_data="Hi ". $data["name"]. ", click on the link to reset password: " .$_SERVER['REQUEST_SCHEME'] ."://".$_SERVER['HTTP_HOST']."/reset-old-password?token=".$token;

        $this->envelope["headers"]= $this->email_html_header("noreply.co.za");
        $this->envelope["subject"]="You have signed up to propay";
        $this->envelope["recipient"]=$data["email"];

        $this->envelope["message"]=$template_data;
        $this->response["success"]=$this->email_send();
        return $this->response;
    }

    private function email_send()
    {
         try
         {
            if( mail( $this->envelope["recipient"], $this->envelope["subject"] , $this->envelope["message"],$this->envelope["headers"]))
            {
              return true;
            }else{
                throw new Exception();
            }
         }catch (Exception $ex)
         {
             return false;
         }
    }

    private function email_html_header($email){

        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: ". $email. "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        return $headers;

    }

}