<?php
require("database.php");
$code=base64_decode($_POST["code"]);
$username=base64_decode($_POST["username"]);
$check_code="SELECT activation_code from user where username='$username' AND activation_code='$code' ";
$response=$db->query($check_code);
if($response->num_rows!=0){
    $update_status="UPDATE user SET status='active' where username='$username' AND activation_code='$code' ";
    if($db->query($update_status)){
        $get_id="SELECT id from user where username='$username'";
        $get_id_response=$db->query($get_id);
        $id_data=$get_id_response->fetch_assoc();
        $table_name="user_".$id_data['id'];
        $create_table="CREATE TABLE $table_name(
         id INT(11) NOT NULL AUTO_INCREMENT,
         image_name varchar(255),
         image_path varchar(255),
         image_size float,
         image_date DATETIME DEFAULT CURRENT_TIMESTAMP,
         primary key(id)
        )";
        if($db->query($create_table)){
            mkdir("../profile/gallary/".$table_name);
            echo "user verified";
            session_start();
            $_SESSION['username']=$username;
        }
    }
    else{
        echo "Activation failed";
    }
}
else{
    echo "Wrong Code";
}

?>