<?php 

class database{
 
	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "fandy";
 
	function __construct(){
        $con = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
        $this->con = $con;
    }
    
    function create_db(){
        $sql = "CREATE TABLE members(
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(50) NOT NULL,
            email VARCHAR(50) NOT NULL UNIQUE,
            birth_date VARCHAR(30) NOT NULL,
            country VARCHAR(50) NOT NULL,
            phone VARCHAR(30) NOT NULL,
            registration_date VARCHAR(30) NOT NULL,
            need_pickup VARCHAR(10) NOT NULL
        )";

        if(mysqli_query($this->con, $sql)){
            echo "Table created successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->con);
        }
         
        // Close connection
        mysqli_close($this->con);
    }

    function insert_data($values){
        $sql = "INSERT INTO members ( name, email, birth_date, country, 
        phone,registration_date,need_pickup ) VALUES".$values;
        mysqli_query($this->con, $sql);
    }

    function update_data($name, $email, $birth_date, $country, $phone, $registration_date, $need_pickup){
        $sql = "UPDATE members SET name='$name', birth_date='$birth_date', 
        country='$country', phone='$phone',registration_date='$registration_date',
        need_pickup='$need_pickup' WHERE email = '$email'";
        mysqli_query($this->con, $sql);
    }

    function cek_data($email){
        $sql = "SELECT * FROM members WHERE email = '$email'";
        $result = mysqli_query($this->con, $sql);
        if( mysqli_num_rows($result) > 0) {
            return true;
        } else{
            return false;
        }
    }
 
} 

