<?php

class Engine_encryption
{

    function encryption_unique_id(){

        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
    function encryption_hash_string($algos_key,$value){

        return hash($algos_key?$algos_key :"md5",$value);
    }

    function encryption_decimal_get_char($decimal_search,$return_all=false){
    $decimal= array(
        "33"=>array("char"=>"!"),
        "34"=>array("char"=>'"'),
        "35"=>array("char"=>'#'),
        "36"=>array("char"=>"$"),
        "37"=>array("char"=>"%"),
        "38"=>array("char"=>"&"),
        "39"=>array("char"=>"'"),
        "40"=>array("char"=>"("),
        "41"=>array("char"=>")"),
        "42"=>array("char"=>"*"),
        "43"=>array("char"=>"+"),
        "44"=>array("char"=>","),
        "45"=>array("char"=>"-"),
        "46"=>array("char"=>"."),
        "48"=>array("char"=>"0"),
        "49"=>array("char"=>"1"),
        "50"=>array("char"=>"2"),
        "51"=>array("char"=>"3"),
        "52"=>array("char"=>"4"),
        "53"=>array("char"=>"5"),
        "54"=>array("char"=>"6"),
        "55"=>array("char"=>"7"),
        "56"=>array("char"=>"8"),
        "57"=>array("char"=>"9"),
        "58"=>array("char"=>":"),
        "64"=>array("char"=>"@"),
        "65"=>array("char"=>"A"),
        "66"=>array("char"=>"B"),
        "67"=>array("char"=>"C"),
        "68"=>array("char"=>"D"),
        "69"=>array("char"=>"E"),
        "70"=>array("char"=>"F"),
        "71"=>array("char"=>"G"),
        "72"=>array("char"=>"H"),
        "73"=>array("char"=>"I"),
        "74"=>array("char"=>"J"),
        "75"=>array("char"=>"K"),
        "76"=>array("char"=>"L"),
        "77"=>array("char"=>"M"),
        "78"=>array("char"=>"N"),
        "79"=>array("char"=>"O"),
        "80"=>array("char"=>"P"),
        "81"=>array("char"=>"Q"),
        "82"=>array("char"=>"R"),
        "83"=>array("char"=>"S"),
        "84"=>array("char"=>"T"),
        "85"=>array("char"=>"U"),
        "86"=>array("char"=>"V"),
        "87"=>array("char"=>"W"),
        "88"=>array("char"=>"X"),
        "89"=>array("char"=>"Y"),
        "90"=>array("char"=>"Z"),
        "91"=>array("char"=>"["),
        "93"=>array("char"=>"]"),
        "95"=>array("char"=>"_"),
        "97"=>array("char"=>"a"),
        "98"=>array("char"=>"b"),
        "99"=>array("char"=>"c"),
        "100"=>array("char"=>"d"),
        "101"=>array("char"=>"e"),
        "102"=>array("char"=>"f"),
        "103"=>array("char"=>"g"),
        "104"=>array("char"=>"h"),
        "105"=>array("char"=>"i"),
        "106"=>array("char"=>"j"),
        "107"=>array("char"=>"k"),
        "108"=>array("char"=>"l"),
        "109"=>array("char"=>"m"),
        "110"=>array("char"=>"n"),
        "111"=>array("char"=>"o"),
        "112"=>array("char"=>"p"),
        "113"=>array("char"=>"q"),
        "114"=>array("char"=>"r"),
        "115"=>array("char"=>"s"),
        "116"=>array("char"=>"t"),
        "117"=>array("char"=>"u"),
        "118"=>array("char"=>"v"),
        "119"=>array("char"=>"w"),
        "120"=>array("char"=>"x"),
        "121"=>array("char"=>"y"),
        "122"=>array("char"=>"z"),
        "123"=>array("char"=>"{"),
        "124"=>array("char"=>"|"),
        "125"=>array("char"=>"}")
        );

        if($return_all)
        {
            return $decimal;
        }
        else{
            if($this->check_index($decimal,$decimal_search)){

                return array("data"=> $decimal[$decimal_search],"index"=>array_search($decimal_search,array_keys($decimal))) ;
            }else{
                return null;
            }
        }
    }
    function encryption_char_get_code($char_search,$return_all=false){

    $char= array(
        "!"=>array("decimal"=>"21","bar_code"=>"222122"),
        '"'=>array("decimal"=>"22","bar_code"=>"222221"),
        "#"=>array("decimal"=>"23","bar_code"=>"121223"),
        "$"=>array("decimal"=>"24","bar_code"=>"121322"),
        "%"=>array("decimal"=>"25","bar_code"=>"131222"),
        "&"=>array("decimal"=>"26","bar_code"=>"122213"),
        "'"=>array("decimal"=>"27","bar_code"=>"122312"),
        "("=>array("decimal"=>"28","bar_code"=>"132212"),
        ")"=>array("decimal"=>"29","bar_code"=>"221213"),
        "*"=>array("decimal"=>"2A","bar_code"=>"221312"),
        "+"=>array("decimal"=>"2B","bar_code"=>"231212"),
        ","=>array("decimal"=>"2C","bar_code"=>"112232"),
        "-"=>array("decimal"=>"2D","bar_code"=>"122132"),
        "."=>array("decimal"=>"2E","bar_code"=>"122231"),
        "0"=>array("decimal"=>"30","bar_code"=>"123122"),
        "1"=>array("decimal"=>"31","bar_code"=>"123221"),
        "2"=>array("decimal"=>"32","bar_code"=>"223211"),
        "3"=>array("decimal"=>"33","bar_code"=>"221132"),
        "4"=>array("decimal"=>"34","bar_code"=>"221231"),
        "5"=>array("decimal"=>"35","bar_code"=>"213212"),
        "6"=>array("decimal"=>"36","bar_code"=>"223112"),
        "7"=>array("decimal"=>"37","bar_code"=>"312131"),
        "8"=>array("decimal"=>"38","bar_code"=>"311222"),
        "9"=>array("decimal"=>"39","bar_code"=>"321122"),
        ":"=>array("decimal"=>"3A","bar_code"=>"321221"),
        "@"=>array("decimal"=>"40","bar_code"=>"232121"),
        "A"=>array("decimal"=>"41","bar_code"=>"111323"),
        "B"=>array("decimal"=>"42","bar_code"=>"131123"),
        "C"=>array("decimal"=>"43","bar_code"=>"131321"),
        "D"=>array("decimal"=>"44","bar_code"=>"112313"),
        "E"=>array("decimal"=>"45","bar_code"=>"132113"),
        "F"=>array("decimal"=>"46","bar_code"=>"132311"),
        "G"=>array("decimal"=>"47","bar_code"=>"211313"),
        "H"=>array("decimal"=>"48","bar_code"=>"231113"),
        "I"=>array("decimal"=>"49","bar_code"=>"231311"),
        "J"=>array("decimal"=>"4A","bar_code"=>"112133"),
        "K"=>array("decimal"=>"4B","bar_code"=>"112331"),
        "L"=>array("decimal"=>"4C","bar_code"=>"132131"),
        "M"=>array("decimal"=>"4D","bar_code"=>"113123"),
        "N"=>array("decimal"=>"4E","bar_code"=>"113321"),
        "O"=>array("decimal"=>"4F","bar_code"=>"133121"),
        "P"=>array("decimal"=>"50","bar_code"=>"313121"),
        "Q"=>array("decimal"=>"51","bar_code"=>"211331"),
        "R"=>array("decimal"=>"52","bar_code"=>"231131"),
        "S"=>array("decimal"=>"53","bar_code"=>"213113"),
        "T"=>array("decimal"=>"54","bar_code"=>"213311"),
        "U"=>array("decimal"=>"55","bar_code"=>"213131"),
        "V"=>array("decimal"=>"56","bar_code"=>"311123"),
        "W"=>array("decimal"=>"57","bar_code"=>"311321"),
        "X"=>array("decimal"=>"58","bar_code"=>"331121"),
        "Y"=>array("decimal"=>"59","bar_code"=>"312113"),
        "Z"=>array("decimal"=>"5A","bar_code"=>"312311"),
        "["=>array("decimal"=>"5B","bar_code"=>"332111"),
        "]"=>array("decimal"=>"5D","bar_code"=>"221411"),
        "_"=>array("decimal"=>"5F","bar_code"=>"111224"),
        "a"=>array("decimal"=>"61","bar_code"=>"121124"),
        "b"=>array("decimal"=>"62","bar_code"=>"121421"),
        "c"=>array("decimal"=>"63","bar_code"=>"141122"),
        "d"=>array("decimal"=>"64","bar_code"=>"141221"),
        "e"=>array("decimal"=>"65","bar_code"=>"112214"),
        "f"=>array("decimal"=>"66","bar_code"=>"112412"),
        "g"=>array("decimal"=>"67","bar_code"=>"122114"),
        "h"=>array("decimal"=>"68","bar_code"=>"122411"),
        "i"=>array("decimal"=>"69","bar_code"=>"142112"),
        "j"=>array("decimal"=>"6A","bar_code"=>"142211"),
        "k"=>array("decimal"=>"6B","bar_code"=>"241211"),
        "l"=>array("decimal"=>"6C","bar_code"=>"221114"),
        "m"=>array("decimal"=>"6D","bar_code"=>"413111"),
        "n"=>array("decimal"=>"6E","bar_code"=>"241112"),
        "o"=>array("decimal"=>"6F","bar_code"=>"134111"),
        "p"=>array("decimal"=>"70","bar_code"=>"111242"),
        "q"=>array("decimal"=>"71","bar_code"=>"121142"),
        "r"=>array("decimal"=>"72","bar_code"=>"121241"),
        "s"=>array("decimal"=>"73","bar_code"=>"114212"),
        "t"=>array("decimal"=>"74","bar_code"=>"124112"),
        "u"=>array("decimal"=>"75","bar_code"=>"124211"),
        "v"=>array("decimal"=>"76","bar_code"=>"411212"),
        "w"=>array("decimal"=>"77","bar_code"=>"421112"),
        "x"=>array("decimal"=>"78","bar_code"=>"421211"),
        "y"=>array("decimal"=>"79","bar_code"=>"212141"),
        "z"=>array("decimal"=>"7A","bar_code"=>"214121"),
        "{"=>array("decimal"=>"7B","bar_code"=>"412121"),
        "|"=>array("decimal"=>"7C","bar_code"=>"111143"),
        "}"=>array("decimal"=>"7D","bar_code"=>"111341")
        );

        if($return_all)
        {
            return $char;
        }
        else {
            if ($this->check_index($char, $char_search)) {
                return array("data" => $char[$char_search], "index" => array_search($char_search, array_keys($char)));
            } else {
                return null;
            }
        }

    }

    private function check_index($service,$service_request){

      //  echo "<br> job search for " . $service_request . " type: ". gettype($service_request). " length: " . strlen($service_request);


       if(array_key_exists($service_request,$service))
       {

           return true;
       }
       else{

           return false;
       }
    }

    function encryption_password($string_value)
    {
        $validation = new Engine_validation();
        $new_password =null;
        $array_string= str_split($string_value);
        $temp=0;
        $change_set="";
        $checking_size="";

        //-->looping for encoding first 4 charachters
        for($r=0;$r<count($array_string);$r++)
        {

          //  echo "<br> checking string-->".$array_string[$r] . " and type is int: " . $validation->data_val_regx_test("int",$array_string[$r]) ;
            //-->single number characters
            if($validation->data_val_regx_test("int",$array_string[$r]))
            {

            //    echo "<br>found number is: ".$array_string[$r];
                //-->get decimal->char
                $standard_check = trim($array_string[$r] * 30);

                do
                {
                    if($standard_check>125)
                    {
                        $standard_check= trim(round(($standard_check/6.75) + 9));
                    }
                //    echo "<br> the standard check number ". $standard_check;
                    $temp=$this->encryption_decimal_get_char($standard_check);
                    $standard_check+=2;
                  //  echo "<br> temp size :" . gettype($temp);
                }while($temp==null);
                $search_index = $this->encryption_char_code_by_index($temp["index"])  ;

                $change_set=str_split($search_index["decimal"]);
                $checking_size= $temp["data"]["char"] .$change_set[0].$temp["index"].$change_set[1];

            }else{
                //-->single characters

                $temp=$this->encryption_char_get_code($array_string[$r]);

                $search_index = $this->encryption_get_decimal_by_index($temp["index"])  ;

                $change_set= str_split($temp["data"]["decimal"]  );


                $checking_size= $change_set[0].$search_index["char"].$change_set[1].$temp["index"];
            }

           //  echo "<br> R is :". $r ." and string size " . strlen($checking_size) ."-->".$checking_size;
            //-->first 3 characters
            if($r<=2)
            {
                if(strlen($checking_size)>=4)
                {
                    $new_password .= "-" . substr($checking_size, 0, 4);
                }else{
                    $new_password.="-". $checking_size;
                }
            }
            else if($r<=4 && $r>=3)
            {
                if(strlen($checking_size)>=4)
                {
                    $new_password.="-". substr($checking_size,0,3);
                }
            } else if($r==5)
            {
                if(strlen($checking_size)>=4)
                {
                    $new_password.="-". substr($checking_size,0,1);
                }
            }else{
                $new_password.="-". $checking_size;
            }
        }
       // echo "<br> char encryption ". $new_password;
        //-->base64 string
        return $this->encryption_base64($new_password);
    }

    private function encryption_char_code_by_index($search_index)
    {
     // echo "<br> index search :".$search_index;
        $search_array=$this->encryption_char_get_code(null,true);
        $new_search_index = array_keys($search_array)[$search_index];

        return $search_array[$new_search_index];
    }
    private function encryption_get_decimal_by_index($search_index)
    {
     // echo "<br> index search :".$search_index;
        $search_array=$this->encryption_decimal_get_char(null,true);
        $new_search_index = array_keys($search_array)[$search_index];

        return $search_array[$new_search_index];
    }

    private function encryption_base64($value)
    {
        return base64_encode($value);
    }

    public function Engine_encryption_validate_transaction_reference($creation_date)
    {
        $reference=$this->encryption_unique_id();



        return base64_encode($value);
    }
    public function Engine_session_token ($index)
    {
        //creating session token
        $temp=$this->encryption_unique_id();
        $session_temp = explode("-",$temp);
        $session_token = substr($session_temp[0],0,$index)  .  substr($session_temp[1],0,$index) . substr($session_temp[2],0,$index) . substr($session_temp[3],0,$index) . substr($session_temp[4],0,$index) ;
        return $session_token;
    }
}