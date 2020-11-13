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
        $dataApi = $data[$i];
        
        $name = $dataApi['name'];
        $email = $dataApi['email'];
        $birth_date = $dataApi['birth_date'];
        $country = $dataApi['country'];
        $phone = $dataApi['phone'];
        $registration_date = $dataApi['registration_date'];
        $need_pickup = $dataApi['need_pickup'];

        $values = "('$name', '$email', '$birth_date', '$country', '$phone', '$registration_date', '$need_pickup')";
        
        $cek = $this->con->cek_data($email);
        // execute query from API
        if ($cek == TRUE) {
          $this->con->update_data($name, $email, $birth_date, $country, $phone, $registration_date, $need_pickup);
        } else {
          $this->con->insert_data($values);
        }
      }
    }
}