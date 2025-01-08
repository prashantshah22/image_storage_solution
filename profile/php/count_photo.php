<?php
session_start();
require("../../php/database.php");
$username=$_SESSION['username'];
$get_id = "SELECT id from user where username='$username'";
$response = $db->query($get_id);
$data = $response->fetch_assoc();
$table_name = "user_" . $data['id'];
$count_img = "SELECT count(id) as total from $table_name";
$response = $db->query($count_img);
$data = $response->fetch_assoc();
echo $data['total'] . " IMAGES";
$_SESSION['table_name'] = $table_name;

?>
