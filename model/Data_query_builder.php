<?php

class Data_query_builder
{

    private $u;
    private $p;
    private $h;
    private $d;
    private $con;
    private $response;
    public function __construct(){

        $this->response=array("success"=>false,"data"=>null);
        $this->u="root";
        $this->p="";
        $this->h="localhost";
        $this->d="propay";
    }

    private function data_query_lupi_db_open(){
       //     echo "\nserver in use " .  $this->h . " the database " .$this->d;

        $this->con= mysqli_connect($this->h,$this->u,$this->p,$this->d)or die("No such user");
    }

    private function data_query_builder_lupi_db_close(){

       mysqli_close($this->con);

    }
    public function data_query_builder_insert_general($TABLE,$VALUES,$FIELDS){

        //-->open connection to the database
        $this->data_query_lupi_db_open();
        try{

            $q="INSERT INTO {$TABLE} ({$FIELDS}) VALUES({$VALUES})";
            $query= mysqli_query($this->con,"INSERT INTO {$TABLE} ({$FIELDS}) VALUES({$VALUES})");
            //check if entry was successful
            if($query){

                $last_id = $this->con->insert_id;

                $this->response["success"]=true;
                $this->data_query_builder_lupi_db_close();

                $this->response["data"]=array("row_id"=>$last_id);

                return  $this->response;
            }else{
                $code=$query.mysqli_errno($this->con);
                $message=$query.mysqli_error($this->con) ;

                throw new Exception_handler($code,$message);
            }
        }catch (Exception_handler $error){

            $this->data_query_builder_lupi_db_close();
            $error->exception_handler_terminate();
            return  $error->exception_handler_error_stuc();
        }
    }

    public function data_query_builder_select_general($TABLE,$FIELDS,$JOIN,$WHERE,$rows){
        $this->data_query_lupi_db_open();
        try{
            $q="SELECT {$FIELDS} FROM {$TABLE} {$JOIN} {$WHERE}";

            $query= mysqli_query($this->con,"SELECT {$FIELDS} FROM {$TABLE} {$JOIN} {$WHERE}");
            //check if entry was successful
            if($query){

                if(mysqli_num_rows($query)>0)
                {
                        $data=null;
                        if($rows=="one"){

                            $data= $query->fetch_assoc();

                        }elseif($rows=="many"){

                            $data= mysqli_fetch_all($query,MYSQLI_ASSOC);
                        }
                        $this->data_query_builder_lupi_db_close();
						
                    return  $this->response_db(true,$data);

                }else{
                    return $this->response_db(false,null);
                }

            }else{

                throw new Exception_handler($query.mysqli_errno($this->con),$query.mysqli_error($this->con));
            }
        }catch (Exception_handler $error){

            $this->data_query_builder_lupi_db_close();
            $error->exception_handler_terminate();
            return  $error->exception_handler_error_stuc();
        }
    }


    private function response_db($success=false,$data=null)
    {
        $this->response["data"]=$data;
        $this->response["success"]=$success;
        return $this->response;
    }

    public function data_query_current_date($format=null){

        $date=new DateTime(); //this returns the current date time
        $result = $date->format($format!=null?$format:'Y-m-d H-i-s');
        return $result;
    }

}