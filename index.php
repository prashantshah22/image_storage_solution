<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Storage System</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/themes/base/jquery-ui.min.css" integrity="sha512-TFee0335YRJoyiqz8hA8KV3P0tXa5CpRBSoM0Wnkn7JoJx1kaq1yXL/rb8YFpWXkMOjRcv5txv+C6UluttluCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/jquery-ui.min.js" integrity="sha512-MSOo1aY+3pXCOCdGAYoBZ6YGI0aragoQsg1mKKBHXCYPIWxamwOE7Drh+N5CPgGI5SA9IEKJiPjdfqWFWmZtRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sixtyfour&display=swap" rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="js/ajax_pass.js" defer></script>
    <script src="js/ajax_user_check.js" defer></script>
    <script src="js/ajax_signup.js" defer></script>
    <script src="js/main.js" defer></script>
    <script src="js/ajax_login.js" defer></script>
    <script src="js/ajax_activate.js" defer></script>
</head>

<body style="background:#FCD0CF;">
    <div class="container-fluid w-100">
        <div class="row">
            <div class="col-md-4 mt-2">
                <img src="images/main_pic.jpg" alt="image" class="shadow-lg w-100" width="100%">
            </div>
            <div class="col-md-4 mt-2 px-5 py-4 ">
                <h1 class="text-center font">Sign Up</h1>
                <form autocomplete="off" class="signup_form">
                    <input type="text" name="signup_name" id="signup_name" placeholder="Full Name" class="form-control mb-2" required>
                    <div class="email-box">
                        <input type="email" name="signup_email" id="signup_email" placeholder="Email" class="form-control mb-2" required>
                        <i class="fa fa-circle-o-notch fa-spin d-none" id="loader" aria-hidden="true"></i>
                    </div>
                    <div class="passwd-box">
                        <input type="password" name="signup_password" id="signup_password" placeholder="Password" class="form-control mb-2" required>
                        <i class="fa fa-eye" id="eye" aria-hidden="true"></i>
                    </div>
                    <button class="btn text-center float-start float-sm-none" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">CLICK GENERATE TO IMPROVE SECURITY</button>
                    <button class="btn btn-light text-dark float-end rounded-2 generate_btn">GENERATE</button>
                    <button class="btn btn-primary m-3" type="submit" disabled id="register-btn">Register Now</button>
                </form>
                <div class="signup-notice p-2">
                </div>
                <div class="activator d-none px-2 container container-fluid">
                    <span>please check your email</span>
                    <input type="text" name="code" class="my-3" id="code_input" placeholder="Activation Code" autocomplete="off">
                    <button class="btn btn-dark text-light activation-btn">Activate Now</button>
                </div>

            </div>
            <div class="col-md-4 mt-2 px-5 py-4">
                <h1 class="text-center font">Log In</h1>
                <form autocomplete="off" class="login_form">
                    <div class="login_email-box">
                        <input type="email" name="login_email" id="login_email" placeholder="Email" class="form-control mb-2" required>
                        <i class="fa fa-circle-o-notch fa-spin d-none" id="login-loader" aria-hidden="true"></i>
                    </div>
                    <div class="login_passwd-box">
                        <input type="password" name="login_password" id="login_password" placeholder="Password" class="form-control mb-2" required>
                        <i class="fa fa-eye" id="login_eye" aria-hidden="true"></i>
                    </div>
                    <button class="btn btn-primary m-3 float-end" type="submit" id="login-btn">Log In</button>
                </form>
                <div class="login-notice p-2">
                </div>
                <div class="login_activator p-2 mt-1 d-none container container-fluid">
                    <span>please check your email</span>
                    <input type="text" name="code" class="my-3" id="login_code_input" placeholder="Activation Code" autocomplete="off">
                    <button class="btn btn-dark text-light login_activation-btn">Activate Now</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<php

    ?>