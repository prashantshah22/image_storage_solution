<?php
session_start();
require("../../php/database.php");
$username = $_SESSION['username'];
$get_status = "SELECT storage,used_storage from user where username='$username'";
$response = $db->query($get_status);
$data = $response->fetch_assoc();
$total = $data['storage'];
$used = $data['used_storage'];
$free_sapce=$total-$used;
$percentage = round(($used / $total) * 100, 2);
$response=[$used . "MB/" . $total . "MB",$free_sapce,$percentage];
echo json_encode($response);


$color = "";
if ($percentage > 80) {
  $color = "bg-danger";
} else {
  $color = "bg-primary";
}
?>