<?php

class Data_select extends Data_query_builder
{

    private $response;
    private $fields;

    public function __construct(){

        $this->response=array("success"=>false,"error"=>"none","data"=>"none");
        $this->fields="*";
        $this->query_db = new Data_query_builder( );

    }


    public function select_sign_in($form_data,$table,$auto_login=false)
    {
        $engine_encryption = new Engine_encryption();

        $email = strtolower($form_data->email);

        //-->calling column names from table
        $fields = "id,email,name";
        $where = "WHERE email='{$email}'";
        if(!$auto_login)
        {
            $where.= " AND password= '{$engine_encryption->encryption_password($form_data->password)}'";
        }

        $request_success = $this->query_db->data_query_builder_select_general($table, $fields, null, $where, "one");

        if ($request_success["success"]) {
            //-->create user session token
            $engine_session = new Engine_session();
            $user= $request_success["data"];

            $request_success_1 = $engine_session->session_sign_in();

            if ($request_success_1["success"])
            {
                //-->save data to database as a signed in user
                $data_insert = new Data_insert();
                $session_info=$request_success_1["data"];

                $request_success_2=$data_insert->insert_session($user["id"],$session_info["original_token"],"session");
                if($request_success_2["success"])
                {
                    $session_data=array("name"=>$user["name"],"fake_token"=>$session_info["fake_token"],"id"=>$request_success_2["data"]["id"],"customer_id"=>$user["id"]);

                   $engine_session->session_temp_create_data("authenticated",$session_data);

                    return $this->response(true, null, null, null);
                }
            }
            return $this->response(false, null, null, null);
        }
    }



    /**
     * select_signed_in_check: is for checking
     * a customer exist
     */
    public function select_signed_in_check($user_id,$id,$table)
    {
        $fields= " * ";
        $where="WHERE customer_id='{$user_id}' AND id={$id}";

        $request_success=$this->query_db->data_query_builder_select_general($table,$fields,null,$where,"one" );

        return $this->response($request_success["success"],null);
    }

    //server eternal use
    public function select_customer($user_id,$table,$email=null)
    {
        $fields = "id,email,name";

        $where = "WHERE email='{$email}' OR id= '{$user_id}'";

        $request_success = $this->query_db->data_query_builder_select_general($table, $fields, null, $where, "one");

        return $this->response($request_success["success"],$request_success["data"]);
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