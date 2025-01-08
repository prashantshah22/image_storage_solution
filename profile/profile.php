<?php
session_start();
if (empty($_SESSION['username'])) {
  header("Location:../index.php");
  exit;
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
  <div class="upload_notice fixed-top"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 p-2 border">
        <div class="w-100 bg-white rounded-1 shadow-lg d-flex flex-column mb-5 p-2 justify-content-center align-items-center" style="min-height:200px;">
          <i class="fa fa-folder-open upload-icon" style="font-size: 100px;"> </i>
          <h1 class="upload_header">Upload files</h1>
          <span class="free_memory">
            <?php
                  $username = $_SESSION['username'];
                  $get_status = "SELECT storage,used_storage from user where username='$username'";
                  $response = $db->query($get_status);
                  $data = $response->fetch_assoc();
                  $total = $data['storage'];
                  $used = $data['used_storage'];
                  $free_sapce=$total-$used;
                  echo "FREE SPACE: ".$free_sapce."MB";
              ?>
          </span>
          <div class="progress upload_progress_con d-none my-2 w-50" role="progressbar" style="height:5px;">
            <div class="progress-bar progress_control progress-bar-striped progress-bar-animated  h-100"></div>
          </div>
          <div class="progress_detail d-none">
            <span class="progress_per"></span>
            <i class="fa fa-pause-circle"></i>
            <i class="fa fa-times-circle"></i>
          </div>
        </div>
        <div class="w-100 bg-white mb-5 p-1 rounded-1 shadow-lg d-flex flex-column justify-content-center align-items-center" style="min-height:200px;">
          <i class="fa fa-database " style="font-size: 100px;"> </i>
          <h1 style="font-size:18px;font-weight:900;text-transform:uppercase;">Memory Status</h1>
          <span class="used_memory">
            <?php
            $get_status = "SELECT storage,used_storage from user where username='$username'";
            $response = $db->query($get_status);
            $data = $response->fetch_assoc();
            $total = $data['storage'];
            $used = $data['used_storage'];
            echo $used . "MB/" . $total . "MB";
            $percentage = round(($used / $total) * 100, 2);
            $color = "";
            if ($percentage > 80) {
              $color = "bg-danger";
            } else {
              $color = "bg-primary";
            }
            ?>
          </span>
          <div class="progress my-2 w-50" role="progressbar" style="height:5px;">
            <div class="progress-bar memory-progress <?php echo $color; ?>" style="width:<?php echo $percentage . "%"; ?>"></div>
          </div>
        </div>
      </div>

      <div class="col-md-6">

      </div>
      <div class="col-md-3">
        <div class="w-100 p-3 bg-white rounded-1 shadow-lg d-flex flex-column justify-content-center align-items-center">
          <a href="gallary.php"><i class="fa fa-picture-o text-primary" style="font-size: 100px;"> </i></a>
          <h1>GALLERY</h1>
          <span class="count_pic">
            <?php 
              $get_id="SELECT id from user where username='$username'";
              $response=$db->query($get_id);
              $data=$response->fetch_assoc();
              $table_name="user_".$data['id'];
              $count_img="SELECT count(id) as total from $table_name";
              $response=$db->query($count_img);
              $data=$response->fetch_assoc();
              echo $data['total']." IMAGES"; 
              $_SESSION['table_name']=$table_name;
            ?>  
          </span>
        </div>

        <div class="w-100 p-3 mt-5 bg-white rounded-1 shadow-lg d-flex flex-column justify-content-center align-items-center">
          <a href="shop.php"><i class="fa fa-cart-plus text-dark" style="font-size: 100px;"> </i></a>
          <h1>Shop Now</h1>
          <span class="count_pic">STARTING FROM RS. 99/mo</span>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>