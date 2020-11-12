<?php

class ignapi {

    function __construct(){
		  //include '../databases/mysql/connection.php';
    }
    
    function GetApi(){
      $content = file_get_contents("http://188.166.177.87/ignapi/");
      $content = utf8_encode($content);
      $result  = json_decode($content, true);
      //print_r( $result);
      return $result;
    }

    function InsertData(){
      $values = "";
      if (is_array($this->GetApi()) || is_object($this->GetApi()))
      {
      foreach ($this->GetApi() as $myp) {
      //    echo $myp["name"]."<br>";
          $name = $myp['name'];
          $email = $myp['email'];
          $birth_date = $myp['birth_date'];
          $country = $myp['country'];
          $phone = $myp['phone'];
          $registration_date = $myp['registration_date'];
          $need_pickup = $myp['need_pickup'];

          $values .= "('$name', '$email', '$birth_date', '$country', '$phone', '$registration_date', '$need_pickup'),";
      }
      //remove last comma
      $values = substr($values, 0,-1);

      //mysqli connection
      $conn = mysqli_connect("localhost", "root", "", "fandy");

      //sql query that insert the user info into the database
      $sql =  "INSERT INTO members ( name, email, birth_date, country, phone,registration_date,need_pickup )       
              VALUES".$values;
      $sqlSearch = "SELECT email FROM members where email = '$email'";
      $cek = mysqli_query($conn,$sqlSearch);
      $simpan = mysql_result($cek,0,"email");
      $simpan  = str_replace("|", " ", $simpan);
      if (in_array($simpan, $this->GetApi())) {
        //mysqli_query($conn, $sql) or die('Error: ' . mysqli_error($conn));
       die('datanya sudah ada');
      } else {
        die('datanya belum ada isinya');
      }
      //if the connection is sucessful, display regards message
      mysqli_query($conn, $sql) or die('Error: ' . mysqli_error($conn));
      echo "Thank you <br/>";
    }
    }
}