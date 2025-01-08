<?php 
require("../../php/database.php");
    session_start();
    $username=$_SESSION['username'];
    $get_id="SELECT id from user where username='$username'";
    $get_response=$db->query($get_id);
    $data=$get_response->fetch_assoc();
    $folder_name="../gallary/user_".$data['id']."/";
    $file=$_FILES['data'];
    $user_path=$file['tmp_name'];
    $file_name = strtolower(basename($file['name']));
    $file_size=round($file['size']/1024/1024,2);
    $table_name="user_".$data['id'];
    $destination = $folder_name . $file_name;

    //check free space

    $check_sapce="SELECT storage,used_storage from user where username='$username'";
    $response=$db->query($check_sapce);
    $space_data=$response->fetch_assoc();
    $total=$space_data['storage'];
    $used=$space_data['used_storage'];
    $free=$total-$used;
    if($file_size<=$free){
        if(file_exists($folder_name.$file_name)){
            echo "file exist rename ";
        }
        else{
            if (move_uploaded_file($user_path, $destination)) {
                $store_data="INSERT into $table_name(image_name,image_path,image_size)
                values(' $file_name','$destination','$file_size')";
                if($db->query($store_data)){
                    $select_storage="SELECT used_storage from user where username='$username'";
                    $storage_response=$db->query($select_storage);
                    $data_space=$storage_response->fetch_assoc();
                    $used_space=$data_space['used_storage']+$file_size;
                    $update_query="UPDATE user set used_storage='$used_space' where username='$username'";
                    if($db->query($update_query)){
                        echo "success";
                    }
                }
                else{
                    echo "Metadata failed";
                }
            } else {
                echo "Failed to move the uploaded file.";
            }
        }
    }
    else{
        echo "Please upgrade File too large";
    }
?>  