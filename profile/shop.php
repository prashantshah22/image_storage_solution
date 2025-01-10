<?php
session_start();
require("../php/database.php");
$username=$_SESSION['username'];
if (empty($_SESSION['username'])) {
  header("Location:../index.php");
  exit();}
  $starter='<ul class="list-group text-center ">
        <li class="list-group-item bg-primary">
            <h1 class="bg-primary fw-1 fx-1 text-light font">STARTER PLAN</h1>
        </li>
        <li class="list-group-item font_size">1 GB Storage</li>
        <li class="list-group-item disable font_size">24/7 TECHNICAL SUPPORT</li>
        <li class="list-group-item disable font_size">INSTANT EMAIL SOLUTION</li>
        <li class="list-group-item disable font_size">DATA SECURITY</li>
        <li class="list-group-item disable font_size">SEO SERVICE</li>
        <li class="list-group-item bg-primary">
            <h3 class="bg-primary fw-1 fx-1 text-light font buy_btn"amount="99" plan="starter" storage="1024">Rs. 99/Mo</h3>
        </li>
        </ul>';
$exclusive='<ul class="list-group text-center ">
        <li class="list-group-item bg-success">
            <h1 class=" fw-1 fx-1 text-white font">EXCLUSIVE PLAN</h1>
        </li>
        <li class="list-group-item font_size">Unlimited</li>
        <li class="list-group-item font_size">24/7 TECHNICAL SUPPORT</li>
        <li class="list-group-item font_size">INSTANT EMAIL SOLUTION</li>
        <li class="list-group-item font_size">DATA SECURITY</li>
        <li class="list-group-item font_size">SEO SERVICE</li>
        <li class="list-group-item bg-success">
            <h3 class="bg-success fw-1 fx-1 text-light font buy_btn" amount="500" plan="exclusive" storage="unlimited">Rs. 500/Mo</h3>
        </li>
        </ul>';

        $select_plans = "SELECT plans from user where username='$username'";
        $response = $db->query($select_plans);
        $data = $response->fetch_assoc();
        $plan=$data['plans'];

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
  <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer">
  <script src="script/upload.js"></script>
    <style>
        .disable{
            color:#ddd !important;
        }
        .font{
            font-family: "Black Ops One", serif;
        }
        .font_size{
            font-size:18px;
            font-family: "Orbitron", serif;
            font-weight: 600;
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
      $_SESSION['fullname']=$name['fullname'];
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
  <div class="container-fluid">
    <div class="row p-4 p-md-2">
        <div class="col-md-6  mt-md-0 mt-5">
        <?php 
              if($plan=="free"){
                echo $starter;
              }
              else if($plan=="starter"){
                echo '<button class="btn btn-warning shadow-lg p-5"><h1>You Are currently using starter plan</h1></button>';

              }
            ?>
        </div>
        <div class="col-md-6 mt-5 mt-md-0">
        <?php 
              if($plan=="free" || $plan="exclusive"){
                echo $exclusive;
              }
            ?>
        </div>
    </div> 
    </div>
  </div>
  </div>
  <script>
    $(document).ready(function(){
        $(".buy_btn").each(function(){
            $(this).click(function(){
                var amt=$(this).attr("amount");
                var plan=$(this).attr("plan");
                var storage=$(this).attr("storage");
                location.href=`php/payment.php?amount=${amt}&plan=${plan}&storage=${storage}`;
            })
        })
    })
  </script>
</body>

</html>