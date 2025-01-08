<?php
session_start();
require("../../php/database.php");
$table_name=$_SESSION['table_name'];
$username=$_SESSION['username'];
$path=$_POST['photo_path'];
$complete_path="../".$path;

$select_database="SELECT used_storage from user where username='$username'";
$response=$db->query($select_database);
$acc=$response->fetch_assoc();
$used_storage=$acc['used_storage'];
$select_img_size="SELECT image_size from $table_name where image_path='$complete_path'";
$img_response=$db->query($select_img_size);
$img_acc=$img_response->fetch_assoc();
$img_size=$img_acc['image_size'];
$update_storage=$used_storage-$img_size;

if(unlink($complete_path)){
    $delete_query="DELETE from $table_name where image_path='$complete_path'";
    $delete_response=$db->query($delete_query);
    if($delete_response){
        $query="UPDATE user SET  used_storage='$update_storage' where username='$username'";
        if($db->query($query)){
            echo "deleted";
        }
        
    }
    else{
        echo "failed to delete";
    }
}

?>

