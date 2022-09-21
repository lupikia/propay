<?php
class User extends Service_feature
{

    private $post_data;
    public $engine_validation;
    private $service_feature ;

    public function __construct($post, $get = null)
    {
        $this->engine_validation = new Engine_validation();
        $this->service_feature = new Service_feature();

        $this->post_data = $post;

    }

    public function authenticate()
    {

        try {

            $email = property_exists($this->post_data, "email") ? $this->post_data->email : "";
            $password = property_exists($this->post_data, "password") ? $this->post_data->password : "";


            if ($this->engine_validation->data_val_field("email", $email)) {
                if ($this->engine_validation->data_val_field("password", $password)) {
                    $data_select = new Data_select();
                    echo "\nauthentication process " . $this->post_data->email . " -and password-" . $this->post_data->password;

                    //-->attempt sign
                    $data_select->select_sign_in_attempt($this->post_data);


                }
            }
            throw new Exception_handler(6, "Incomplete form");

        } catch (Exception_handler $ex) {

            $ex->exception_handler_terminate();
        }

    }

    public function create()
    {
        try {

            $data = get_object_vars($this->post_data);
            $field_key = array_keys($data);
            foreach ($field_key as $key) {

                if (!$this->engine_validation->data_val_field($key, $this->post_data->$key)) {
                    throw new Exception_handler(12);
                };
            }
            $data_insert = new Data_insert();

            $request_success = $data_insert->insert_sign_up_cu($this->post_data, $field_key, "customer");
            if ($request_success["success"])
            {
                $this->service_feature->session_temp_create_data("message",["title"=>"Sign up","message"=>"You have successful Signed up, you can now start a new calculation"]);
                return $this->service_feature->service_feature_response(true, [], "");
            }
            throw new Exception_handler($request_success["data"]["error_code"], "Registration failed");

        } catch (Exception_handler $error) {

            $error->exception_handler_terminate();
            echo json_encode($error->exception_handler_error_stuc());
            exit;
        }

    }

}
