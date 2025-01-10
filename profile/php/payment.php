<?php 
session_start();
require("../../instamojo/Instamojo.php");
$email=$_SESSION['username'];
$name=$_SESSION['fullname'];
$authType = "app/user" ;
$amount=$_GET['amount'];
$plan=$_GET['plan'];
$storage=$_GET['storage'];
$api = Instamojo\Instamojo::init($authType,[
        "client_id" =>  'XXXXXQAZ',
        "client_secret" => 'XXXXQWE',
        "username" => 'FOO',
        "password" => 'XXXXXXXX'

    ],true); 

    try {
        $response = $api->createPaymentRequest(array(
            "purpose" => "ISS plans",
            "amount" => $amount,
            "send_email" => true,
            "buyer_name"=>$name,
            "email" => $email,
            "redirect_url" => "http://localhost/profile/php/update_storage.php?plan=".$plan."&storage=".$storage,
            ));
        // print_r($response);
        $payment_url=$response['longurl'];
        header("Location:$payment_url");
    }
    catch (Exception $e) {
        print('Error: ' . $e->getMessage());
    }

?>