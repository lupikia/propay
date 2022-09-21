<?php

class Engine_validation extends Exception_handler
{

    private $response;

    public function __construct(){

     $this->response=array("success"=>true,"error_msg"=>null);
    }

    public function data_val_field($field,$key_field){

        $data_type=array(

            "name"=>"string",
            "surname"=>"string",
            "email"=>"email",
            "password"=>"string",
            "interest"=>"string",
            "language"=>"string",
            "mobile"=>"mobile"
        );

            if(array_key_exists($field, $data_type))
            {

                if($data_type[$field] != "array")
                {
                        $success=$this->data_val_regx_test($data_type[$field],$key_field);

                        return $success;
                }else{

                    for($x =0;$x < count($key_field); $x++ )
                    {

                        $tem_key_field = json_decode(json_encode($key_field[$x]), True);
                        $keys = array_keys($tem_key_field);
                        foreach ($keys as $item) {

                            if (array_key_exists($item, $data_type)) {

                                if ($this->data_val_regx_test($data_type[$item], $tem_key_field[$item]))
                                {

                                    return true;

                                } else {

                                    return false;
                                }
                            }
                        }
                    }

                    return true;
                }
            }

        return false;
    }
    public function data_val_regx_test($data_type,$field){

            if (preg_match($this->data_val_regx($data_type), $field)) {

                return true;
            } else {

                return false;
            }
    }

    public function data_val_regx($data_type){

        $reg_type=array(
            "string"=>"/^[a-zA-Z0-9]/",
            "service"=>"/^service/",
            "int"=>"/^[0-9]/",
            "mobile"=>"/^[0-9]/",
            "email"=>"/^[^@\s<&>]+@([-a-z0-9]+\.)+[a-z]{2,}$/i",
        );
        return $reg_type[$data_type];
    }
    public function data_val_clean($field_value){
        try{
                if(gettype($field_value) == "array"){

                    return ["cleaned"=>true,"cleaned_value"=> $field_value];
                }

        }catch(Exception $e){


            return false;
        }
    }
}