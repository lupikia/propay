<?php

class Sign_up extends Engine_renderer
{
    private $engine_renderer;
    public $title="Sign up";
    public $data=[];
    public function __construct($params=null)
    {
        $this->engine_renderer = new Engine_renderer($params);

        $this->data["step"] = 0;
        if (isset($_GET["redirect"])) {
            $this->data["redirect"] = $_GET["redirect"];
        } else {
            $this->data["redirect"] = null;
        }
        $data["show-calculation-nav"] = false;

        if($this->engine_renderer->session_authenticate_view())
        {
            header("Location:/dashboard");
        }

    }

    public function display_root($data)
    {
        Engine_renderer::render("sign-up",$data);

    }
    public function display_root_data($data)
    {
        return $this->engine_renderer->renderer_view_data($data);
    }
}