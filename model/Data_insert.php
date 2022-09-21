<?php

class Data_insert extends Data_query_builder
{
    private $response;
    private $request_success;

    public function __construct(){

        $this->response=array("success"=>"","error"=>"","data"=>"","crawler"=>"");
        $this->request_success = new Data_query_builder( );
    }

    private function get_insert_value_key($field_key,$form_data,$exclude)
    {
        $value=null;
        for($x=0; $x< count($field_key);++$x)
        {

            if(!in_array($field_key[$x] ,$exclude))
            {

                if($x<(count($field_key)-1) ){

                    $key_index=$field_key[$x];
                    $value.="'{$form_data->$key_index}',";

                }else{
                    $key_index=$field_key[$x];
                    $value.="'{$form_data->$key_index}'";

                }
            }
        }


        if(substr($value,-1)== "," )
        {
            $value=substr_replace($value,"", -1);
        }

        return  $value;
    }

    private function get_insert_Field_key($field_key,$exclude){
        $field="";
        $counter=count($field_key);
        //echo "fat-size " . count($field_key);

        foreach($field_key  as $key_field){

            if(!in_array($key_field ,$exclude)){


                if($counter>1){
                    $field.=$key_field."," ;
                }else{
                    $field.=$key_field ;
                }
                $counter--;

            }else{

                $counter--;
            }

        }

       // echo "the fields ". $field;
        return $field ;
    }


    public function insert_sign_up_cu($form_data,$field_key,$table){

        $Engine_encryption = new Engine_encryption();


        $email=strtolower($form_data->email);
        //-->create the values section of the insert statement
        $values = "'{$form_data->name}','{$form_data->surname}','{$form_data->mobile}','{$form_data->language}','{$email}','{$Engine_encryption->encryption_password($form_data->password)}'";

        //-->return a string for the column names
        $field=$this->get_insert_Field_key($field_key,[]);
        $request_success=$this->request_success->data_query_builder_insert_general($table ,$values,$field);

        if($request_success["success"])
        {
            return $this->response(true, array("id"=> $request_success["data"]["row_id"]),"insert_sign_up_cu",$request_success["data"]) ;

        }else{

            return $request_success;
        }
    }
    
    public function insert_session($user_id,$token,$table)
    {
        $values = "'{$user_id}','{$token}'";
        $field="customer_id,session_token";

        //inserting in the table
        $request_success=$this->request_success->data_query_builder_insert_general($table,$values,$field);

        //getting session_id tied to user
        return $this->response($request_success["success"],array("id"=>$request_success["data"]["row_id"]),null,null) ;
    }


    private function response($success,$data=null,$from=null,$crawler=null)
    {

        if($from!=null)
        {
            $this->response["crawler"]=array("from"=>$from,"data"=>$crawler);
        }

        $this->response["data"]=$data;
        $this->response["success"]=$success;

       return $this->response;
    }
}