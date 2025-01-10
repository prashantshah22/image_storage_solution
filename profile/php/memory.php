<?php
session_start();
require("../../php/database.php");
$username = $_SESSION['username'];
$get_status = "SELECT plans,storage,used_storage from user where username='$username'";
$response = $db->query($get_status);
$data = $response->fetch_assoc();
$total = $data['storage'];
$used = $data['used_storage'];
$free_sapce=$total-$used;
$plan=$data['plans'];
if($plan=="starter"||$plan=="free"){
$percentage = round(($used / $total) * 100, 2);
$response=[$used . "MB/" . $total . "MB",$free_sapce."MB",$percentage];
echo json_encode($response);

$color = "";
if ($percentage > 80) {
  $color = "bg-danger";
} else {
  $color = "bg-primary";
}
}
else{
  $response=["USED: ".$data['used_storage']."MB","UNLIMITED",0];
  echo json_encode($response);
}

?>