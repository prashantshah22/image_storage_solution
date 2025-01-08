<?php
    $host="localhost";
    $username="root";
    $password="root";
    $database="ravi";
    $port=3306;
    $db=new mysqli($host,$username,$password,$database,$port);
    if($db->connect_error){
        die("Connection failed".$db->connect_error);
    }    
?>