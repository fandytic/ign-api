<?php

class ignapi {

    function __construct(){
      include 'databases/mysql/connection.php';
      $db = new database();
      $this->con = $db;
    }
    
    function GetApi(){
      $content = file_get_contents("http://188.166.177.87/ignapi/");
      $content = utf8_encode($content);
      $result  = json_decode($content, true);
      return $result;
    }

    function InsertData(){
      $arr_count = sizeof($this->GetApi());
      $data = $this->GetApi();
      for ($i=0; $i < $arr_count; $i++) { 
        $test = $data[$i];
        
        $name = $test['name'];
        $email = $test['email'];
        $birth_date = $test['birth_date'];
        $country = $test['country'];
        $phone = $test['phone'];
        $registration_date = $test['registration_date'];
        $need_pickup = $test['need_pickup'];

        $values = "('$name', '$email', '$birth_date', '$country', '$phone', '$registration_date', '$need_pickup')";
        
        $this->con->insert_data($values);
      }
    }
}