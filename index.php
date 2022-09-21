<?php

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

require "engine/engine_session.php";
require "engine/exception_handler.php";
require "engine/engine_validation.php";
require "engine/engine.php";
require "engine/engine_renderer.php";
require "service/service-feature.php";
require "engine/engine_encryption.php";
//-->model classes
require "model/Data_query_builder.php";
require "model/Data_select.php";
require "model/Data_insert.php";
require "model/Data_email.php";

$engine = new Engine();

//-->check if its home page request
$title="Page not found";
$page="general";
$description="";
$data=array("domain"=>$_SERVER['REQUEST_SCHEME'] ."://".$_SERVER['HTTP_HOST'],"show-calculation-nav"=>false);

if($engine->method== "GET" || $engine->method == "POST")
{

    //-->first step is to check if its a service or a page
    if($engine->engine_request_page()){

        require "controller/{$engine->request_url}.php";
        $class= ucfirst($engine->request_url);
        $class=str_replace("-","_",$class);

        //$class="calculate-usage-step-1";
       //echo "<br/>the class-->". $class . " url -->".$engine->request_url;
        $view = new $class($engine->request_query_params);

        //-->meta data stuff
        if(property_exists($view,"title"))
        {
            $title=$view->title;
        }
        if(property_exists($view,"page"))
        {
            $page=$view->page;
        }
        if(property_exists($view,"description"))
        {
            $description = $view->description;
        }

        if(property_exists($view,"data"))
        {
            $data= array_merge($data, $view->data);

        }

        require "views/partial/header.php";
        $data= $view->display_root_data($data);

        $view->display_root($data);
        //--> instantiate the class constructor
        require "views/partial/footer.php";
    }else{
    //-->section to make service calls


    }
}else
{
    //-->any other request we will render the home page

}


