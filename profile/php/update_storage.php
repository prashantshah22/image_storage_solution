<?php
session_start();
require("../../php/database.php");
$username = $_SESSION['username'];
$plan = $_GET['plan'];
$storage = $_GET['storage'];
$purchase_date = date("Y-m-d");
$cal_date=new DateTime($purchase_date);
$cal_date->add(new DateInterval("P30D"));
$expiry_date=$cal_date->format("Y-m-d");

$select_storage = "SELECT storage from user where username='$username'";
$response = $db->query($select_storage);
if($response){
    $data = $response->fetch_assoc();
}
else{
    exit("Error fetching user data from the database.");
}

if ($plan == "starter") {
    $final_storage = $data['storage'] + $storage;
    $update_storage = "UPDATE user set storage='$final_storage',purchase_date='$purchase_date',expiry_date='$expiry_date',plans='$plan' where username='$username'";
    if ($db->query($update_storage)) {
        header("Location:../profile.php");
    } else {
        echo "failed";
    }
}
else{
    $final_storage = 0;
    $update_storage = "UPDATE user set storage='$final_storage',plans='$plan',expiry_date='$expiry_date',purchase_date='$purchase_date' where username='$username'";
    if ($db->query($update_storage)) {
        header("Location:../profile.php");
    } else {
        echo "failed";
    }
}
?>