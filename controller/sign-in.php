<?php

class Sign_in extends Engine_renderer
{
    private $engine_renderer;
    public $title="Sign in";
    public $data=[];


    public function __construct($params=null)
    {
        $this->engine_renderer = new Engine_renderer($params);
        $this->data["redirect"]=null;
        if(isset($_GET["redirect"]) )
        {
            $this->data["redirect"]="?redirect=".$_GET["redirect"];
        }
        if($this->engine_renderer->session_authenticate_view())
        {
            header("Location:/dashboard");
        }
    }

    public function display_root($data)
    {
        $this->engine_renderer->render("sign-in",$data);
    }
    public function display_root_data($data)
    {
       return $this->engine_renderer->renderer_view_data($data);
    }
}