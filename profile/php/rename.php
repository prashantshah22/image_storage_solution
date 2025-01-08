<?php 
session_start();
require("../../php/database.php");
$name = $_POST['photo_name'];
$path = $_POST['photo_path'];
$pathinfo = pathinfo($path);
$name = trim($name);  
$path = trim($path);  
$dirname = trim($pathinfo['dirname']); 
$extension = $pathinfo['extension'];
$new_path = "../" . $dirname . "/" . $name . "." . $extension;
$new_path=trim($new_path);
$old_path = "../" . $path;
if (file_exists($new_path)) {
    echo "already exist";
} else {
    if (rename($old_path, $new_path)) {
        $img_name = $name . "." . $extension;
        $img_name = trim($img_name);
        $table_name = $_SESSION['table_name'];
        $update_table = "UPDATE $table_name SET image_path = '$new_path', image_name = '$img_name' WHERE image_path = '$old_path'";
        if ($db->query($update_table)) {
            echo "success";
        } else {
            echo "failed";
        }
    } else {
        echo "rename failed";
    }
}
?>
