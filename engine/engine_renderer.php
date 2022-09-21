<?php

class Engine_renderer extends Engine_session
{

    public $view_params;
    public $pop_view_data=array("class"=>"","title"=>"", "message"=>"","contact"=>"");

    public function __construct($params=null)
    {

        $pop_view_data=[45345];
        $this->view_params=!empty($params)?$params:[];
        //-->check for pop errors or warnings
     //   echo "pass-1";
          if(array_key_exists( "display",$this->view_params))
            {
     //           echo "pass-2";
              $this->renderer_pop_up_type($this->view_params["display"],$this->renderer_pop_up($this->view_params["display"]));
            }
       // echo "pass-7";
    }
    public function render($view_name,$data)
    {

//        echo "the root 2";
        require "views/{$view_name}.php";
    }

    public function renderer_pop_up($type)
    {
        $session_data = new Engine_session();
       // echo "renderer_pop_up type : ". $type;

        return $session_data->session_temp_get_data($type)["data"];
    }

    public function renderer_view_data($data)
    {
          $data=array_merge($data,array("pop_data" => $this->pop_view_data));

       return $data;
    }


    public function renderer_pop_up_type($pop_type,$data)
    {
        if($pop_type=="error")
        {
            $this->pop_view_data["title"]="Error code: " .$data["data"]["error_code"];
            $this->pop_view_data["message"]=$data["error"];
            $this->pop_view_data["contact"]=$data["data"]["contact"];
            $this->pop_view_data["class"]="error-pop";

        }else{
            $this->pop_view_data["class"]="success-pop";
            $this->pop_view_data["title"]=$data["title"];
            $this->pop_view_data["message"]=$data["message"];
        }
    }


}