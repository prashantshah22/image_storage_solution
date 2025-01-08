<?php
//alternate code for delete.php
session_start();
require("../../php/database.php");

$table_name = $_SESSION['table_name'];
$username = $_SESSION['username'];
$path = $_POST['photo_path'];
$complete_path = "../" . $path;

if (unlink($complete_path)) {
    $img_size_query = "SELECT image_size FROM $table_name WHERE image_path='$complete_path'";
    $response = $db->query($img_size_query);
    $row = $response->fetch_assoc();
    $img_size = $row['image_size'];

    $delete_query = "DELETE FROM $table_name WHERE image_path='$complete_path'";
    if ($db->query($delete_query)) {
        $select_storage = "SELECT used_storage, storage FROM user WHERE username='$username'";
        $storage_response = $db->query($select_storage);
        $data_space = $storage_response->fetch_assoc();
        $used_space = $data_space['used_storage'] - $img_size;

        $update_query = "UPDATE user SET used_storage='$used_space' WHERE username='$username'";
        if ($db->query($update_query)) {
            echo "deleted";
        } else {
            echo "failed";
        }
    } else {
        echo "Delete failed";
    }
} else {
    echo "File deletion failed";
}
?>
