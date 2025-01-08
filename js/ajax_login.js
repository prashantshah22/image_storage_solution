$(document).ready(() => {
    $("#login-btn").click(e => {
        e.preventDefault();
        var password = btoa($("#login_password").val().trim());
        var username = btoa($("#login_email").val().trim());
        $.ajax({
            type: "post",
            url: "php/login.php",
            data: {
                username: username,
                password: password,
            },
            beforeSend: () => {
                $("#login-btn").html("please wait ");
                $("#login-btn").attr("disabled", "disabled")
            },
            success: response => {
                if (response.trim() == "login success") {
                    window.location = "profile/profile.php";
                }
                else if (response.trim() == "login pending") {
                    $(".login_form").fadeOut(500, () => {
                        $(".login_activator").removeClass("d-none");
                    });
                    $(".login_activation-btn").off("click").click((pd) => {
                        pd.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "php/activator.php",
                            data: {
                                username: btoa($("#login_email").val().trim()),
                                code: btoa($("#login_code_input").val().trim())
                            },
                            cache:false,
                            beforeSend: e => {
                                $(".login_activation-btn").html("please wait validating");
                                $(".login_activation-btn").attr("disabled", "disabled");
                            },
                            success: response => {
                                if (response.trim() == "user verified") {
                                    window.location = "profile/profile.php";
                                } else {
                                    $(".login_activation-btn").html("Activate Now");
                                    $(".login_activation-btn").removeAttr("disabled");
                                    $("#login_code_input").val("");
                                    var warning = document.createElement("div");
                                    warning.className = "alert alert-warning";
                                    warning.innerHTML = "<b>Wrong Activation Code</b>";
                                    $(".login-notice").append(warning);
                                    setTimeout(() => {
                                        $(".login-notice").html("");
                                    }, 5000)
                                }
                            }
                        });
                    });
                }
                else if (response.trim() == "wrong password") {
                    var message = document.createElement("div");
                    message.className = "alert alert-warning";
                    message.innerHTML = "<b>Wrong Password</b>";
                    $(".login-notice").append(message);
                    $("#login-btn").html("Log In");
                    $(".login_form").trigger("reset");
                    $("#login-btn").removeAttr("disabled");
                    setTimeout(() => {
                        $(".login-notice").html("");
                    }, 5000)
                }
                else if (response.trim() == "User Not found") {
                    message = document.createElement("div");
                    message.className = "alert alert-warning";
                    message.innerHTML = "<b>User Not Found please Sign In</b>";
                    $(".login-notice").append(message);
                    $("#login-btn").html("Log In");
                    $(".login_form").trigger("reset");
                    $("#login-btn").removeAttr("disabled");
                    setTimeout(() => {
                        $(".login-notice").html("");
                    }, 5000)
                }
            }
        });
    })
});