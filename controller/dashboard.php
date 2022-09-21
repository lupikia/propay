<?php


class dashboard extends Engine_renderer
{

    public $title="Home";
    public $page="home";
    private $engine_renderer;

    public function __construct($params=null)
    {
      //  echo "home is sweet";
        $this->engine_renderer = new Engine_renderer($params);

        if($this->engine_renderer->session_authenticate_view())
        {
            $user = $this->engine_renderer->session_temp_get_data("authenticated")["data"];

            $this->data["name"]=$user["name"];
        }
    }

    public function display_root($data=null)
    {
        $this->engine_renderer->render("dashboard",$data);
    }
    public function display_root_data($data)
    {
        return $this->engine_renderer->renderer_view_data($data);
    }
}