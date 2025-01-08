<?php
session_start();
if (empty($_SESSION['username'])) {
  header("Location:../index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/themes/base/jquery-ui.min.css" integrity="sha512-TFee0335YRJoyiqz8hA8KV3P0tXa5CpRBSoM0Wnkn7JoJx1kaq1yXL/rb8YFpWXkMOjRcv5txv+C6UluttluCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/jquery-ui.min.js" integrity="sha512-MSOo1aY+3pXCOCdGAYoBZ6YGI0aragoQsg1mKKBHXCYPIWxamwOE7Drh+N5CPgGI5SA9IEKJiPjdfqWFWmZtRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link href="https://fonts.googleapis.com/css2?family=Sixtyfour&display=swap" rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer">
  <script src="script/upload.js"></script>
  <script src="script/edit_photo.js"></script>
  <script src="script/view_modal.js"></script>
    <style>
        span:focus{
            outline:2px dashed red;
            padding:2px;
            box-shadow:0px 0px 5px grey;
        }
    </style>
  <title>Profile</title>
</head>

<body style="background:#FCD0CF;">
  <nav class="nav navbar navbar-md-expland navbar-dark bg-dark px-2">
    <a class="navbar-brand" href="#">
      <?php
      require("../php/database.php");
      $username = $_SESSION['username'];
      $get_name = "SELECT fullname from user where username='$username'";
      $response = $db->query($get_name);
      $name = $response->fetch_assoc();
      echo "Mr. " . strtoupper($name['fullname']);
      ?>
    </a>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <a class="nav-link text-white p-2" aria-current="page" href="php/logout.php">
          <i class="fa fa-sign-out pe-2" style="font-size:18px; color:gray;"></i><span style="font-size:18px; color:gray;">Log Out</span></a>
      </li>
    </ul>
  </nav>
  <br>
  <div class="container-fluid mt-5">
    <div class="row ">
    <?php 
        $table_name=$_SESSION['table_name'];
        $get_img_path="SELECT * from $table_name";
        $response=$db->query($get_img_path);
        while($data=$response->fetch_assoc()){
            $image_name=pathinfo($data['image_name']);
            $image_name= $image_name['filename'];
           $path=str_replace("../","",$data['image_path']);
           echo "<div class='col-md-3 mb-2'> 
           <div class='card shadow-lg'>
           <div class='card-header'>
           <img src=".$path."  width='100%' height='200' class='pic' >
           </div>
           <div class='card-footer d-flex align-items-center justify-content-around'>
            <span>".$image_name."</span>
            <i class='fa fa-save save-icon d-none' data-bs-location=".$path."></i>
            <i class='fa fa-spinner fa-spin loader d-none' data-bs-location=".$path."></i>
            <i class='fa fa-edit edit-icon' data-bs-location=".$path."></i>
            <i class='fa fa-download download-icon' data-bs-location=".$path." file-name=".$image_name."></i>
            <i class='fa fa-trash delete-icon' data-bs-location=".$path."></i>
           </div>
           </div>
           </div>";
        }
    ?>
  </div>
  </div>
  </div>
  <div class="modal animate__animated animate__bounceIn" id="modal-view">
    <div class="modal-dialog">
    <i class="fa fa-times-circle float-end text-light" data-bs-dismiss="modal"></i>
      <div class="modal-content">
        <div class="modal-body">
        </div>
      </div>
    </div>

  </div>
</body>

</html>