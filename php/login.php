<?php
require("database.php");
require("mail.php");
$password=md5(base64_decode($_POST['password']));
$username=base64_decode($_POST['username']);
$check_username="SELECT username from user where username='$username' ";
$response=$db->query($check_username);
if($response->num_rows!=0){
    $check_password="SELECT username,password from user where username='$username' AND password='$password'";
    $pass_response=$db->query($check_password);
    if($pass_response->num_rows!=0){
        $check_status="SELECT status from user where username='$username' and password='$password' and status='active'";
        $status_reponse=$db->query($check_status);
        if($status_reponse->num_rows!=0){
            echo "login success";
            session_start();
            $_SESSION['username']=$username;
        }
        else{
            $get_code="SELECT activation_code from user where username='$username' AND password='$password'";
            $response_code=$db->query($get_code);
            $act_code=$response_code->fetch_assoc();
            $data=$act_code["activation_code"];
            if (sendActivationEmail($username, $data)) {
                echo "login pending";
            }

        }
    }
    else{
        echo "wrong password";
    }
}
else{
    echo "User Not found";
}

?>