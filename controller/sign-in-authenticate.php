<?php

class Sign_in_authenticate extends Engine_renderer
{

    private $post_data;
    private $post_get;
    private $url="/dashboard";
    private $redirect_url=null;
    public $engine_renderer;

    public function __construct($params=null)
    {
       //-->get post data
        $this->post_data=json_decode(json_encode($_POST));
        $this->get_data=$_GET;

        //-->check for redirects
        if(isset($this->get_data['redirect'])){
            $this->url=$this->get_data['redirect'];
            $this->redirect_url="&redirect=".$this->get_data['redirect'];
        }

        //-->save the data post bt customer using a form
        $this->engine_renderer = new Engine_renderer();
        $this->engine_renderer->session_temp_create_data("sign-in",$_POST);

        $this->sign_in_authenticate_validate();

    }

    public function sign_in_authenticate_validate()
    {
        $engine_validation = new Engine_validation();

      //   echo "\n We inside sign_in_authenticate_validate";
        try {

            //-->check if email and password isset
            if(property_exists($this->post_data,"email") && property_exists($this->post_data,"password") )
            {

                if($engine_validation->data_val_regx_test("email",$this->post_data->email) &&
                    $engine_validation->data_val_regx_test("string",($this->post_data->password)))
                {
                    $data_select= new Data_select();

                 //   echo "\nauthentication process " . $this->post_data->email . " -and password-" . $this->post_data->password;

                    //-->attempt sign
                    $request_success=$data_select->select_sign_in($this->post_data,"customer");


                  //  exit;
                    if($request_success["success"])
                    {
                        header("Location:{$this->url}");

                    }else
                    {
                        throw new Exception_handler(6);

                    }
                }else
                {
                    throw new Exception_handler(10);
                }
            }else
            {
                throw new Exception_handler(10);
            }

        } catch (Exception_handler $error)
        {
              //  echo "the error ". $this->redirect_url;
                //redirect user to sign in
                $error->exception_handler_terminate();
                $this->engine_renderer->session_temp_create_data("error",$error->exception_handler_error_stuc());
                header("Location:/sign-in?display=error".$this->redirect_url);
        }


    }
}