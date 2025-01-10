$(document).ready(() => {
    $(".activation-btn").click(e => {
        var code = btoa($("#code_input").val().trim());
        var username = btoa($("#signup_email").val().trim());
        $.ajax({
            type: "post",
            url: "php/activator.php",
            data: {
                code: code,
                username: username,
            },
            cache:false,
            before: e => {
                $(".activation-btn").html("please wait ! Checking in progress..");
            },
            success: response => {
                if (response.trim() == "user verified") {
                    window.location = "profile/profile.php";
                } else {
                    $(".activation-btn").html("Activate Now");
                    $(".activation-btn").removeAttr("disabled");
                    $("#code_input").val("");
                    var warning = document.createElement("div");
                    warning.className = "alert alert-warning";
                    warning.innerHTML = "<b>"+response+"</b>";
                    $(".signup-notice").append(warning);
                    setTimeout(() => {
                        $(".signup-notice").html("");
                    }, 5000)
                }
            }
        });
    })
});