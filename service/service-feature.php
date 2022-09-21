<?php
class Service_feature extends Engine_session
{
    public $response;

    public function __construct()
    {

        $this->response=array("success"=>false,"data"=>[],"message"=>[]);
    }

    public function service_feature_response($status,$data=[],$message=[])
    {
     return   $this->response=array("success"=>$status,"data"=>$data,"message"=>$message);
    }

}