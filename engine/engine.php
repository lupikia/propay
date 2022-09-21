<?php

class Engine extends Exception_handler
{
    private $url_management;
    public $method;
    public $request_method;
    public $request_url;
    public $request_params=[];
    public $request_query_params=[];
    public $engine_validation;
    public $request_type="view";
    public function __construct()
    {
        $this->engine_validation= new Engine_validation();
        $this->url_management=$_SERVER['REQUEST_URI'];

        $temp= explode("?", ltrim( $this->url_management,"/"));
        $url_components= parse_url($this->url_management);

        if(array_key_exists("query",$url_components))
        {
            parse_str($url_components['query'], $this->request_query_params);
        }

        $this->method=$_SERVER['REQUEST_METHOD'] ;
        $temp_method=explode("/",$temp[0]);

        if(count($temp_method)>=3)
        {
            $this->request_method=$temp_method[2];
        }else{
            $this->request_method=null;
        }

        if(count($temp_method)>=3)
        {
            $this->request_params=array_slice( $temp_method,3) ;
        }
        if($temp_method[0]=="")
        {
            $this->request_url="sign-in";
        }else
        {
            for($z=0; $z<count($temp_method); $z++)
            {
                if($z<=2)
                {
                    $this->request_url.=$temp_method[$z]."/";
                }
            }
            $this->request_url =substr_replace($this->request_url, "", -1);
        }

    }

    public function engine_request_page()
    {
       return $this->engine_request_check();

    }
    private function engine_request_check()
    {
        if($this->engine_validation->data_val_regx_test("service",$this->request_url))
        {
            $this->engine_approved_service();
            $this->request_type="service";

          return false;
        }else{

            if(file_exists("controller/".$this->request_url.".php"))
            {

            }else{
                $this->request_url="Error_404";
            }
            return true;
        }
    }

    private function engine_approved_service()
    {
       $service_name=array(
           "service/user/create"=>array("active"=>true,"type"=>"POST","class"=>"User"),
           "service/user/reset"=>array("active"=>true,"type"=>"POST","class"=>"User"),
           "service/user/resetPassword"=>array("active"=>true,"type"=>"POST","class"=>"User")
       );

    try{
            if(array_key_exists($this->request_url,$service_name)){
                $service =$service_name[$this->request_url];
                if($service["type"]==$this->method)
                {
                    $class= $service["class"];
                    require "service/{$class}.php";
                    $Request_data = json_decode(file_get_contents("php://input"));

                    $service_call = new $class($Request_data,json_decode(json_encode( array_merge($this->request_params,$this->request_query_params))));

                    if(method_exists($service_call,$this->request_method))
                    {
                        $temp_method=$this->request_method;
                        $request_success= $service_call->$temp_method();
                        if($request_success["success"])
                        {
                            echo json_encode($request_success);
                            exit;
                        }else{
                            throw new Exception_handler(8);
                        }
                    }else
                    {
                        throw new Exception_handler(14);
                    }

                }else{

                    throw new Exception_handler(14);
                }

        }
            throw new Exception_handler(11);

        }catch (Exception_handler $error)
        {
            $error->exception_handler_terminate();
            echo json_encode($error->exception_handler_error_stuc());
            exit;
        }
    }
}