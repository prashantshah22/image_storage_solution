$(document).ready(()=>{
    $(".generate_btn").click(e=>{
        e.preventDefault();
        document.querySelector("#eye").style.color="black";
        $.ajax({
            type:"POST",
            url:"php/random_pass_generate.php",
            cache:false,
            beforeSend:e=>{
                $("#eye").removeClass("fa fa-eye");
                $("#eye").addClass("fa fa-spinner fa-spin");
            },
            success: response=>{
                $("#eye").removeClass("fa fa-spinner fa-spin");
                $("#eye").addClass("fa fa-eye");
                $("#signup_password").val(response);
            }
        });
    });
});