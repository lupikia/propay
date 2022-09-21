<?php

class Error_404 extends Engine_renderer
{

    public $title="Page not found";
    public $engine_renderer;
    public $page="404";

    public function __construct($params=null)
    {

        $this->engine_renderer = new Engine_renderer();
    }
    public function display_root()
    {
        $data["name"]="Sign Up";
        Engine_renderer::render("Error-404",$data);
    }
    public function display_root_data($data)
    {
        return $this->engine_renderer->renderer_view_data([]);
    }

}