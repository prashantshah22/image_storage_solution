$(document).ready(()=>{
    $("#signup_email").on("change",()=>{
        if( $("#signup_email").val().trim()!=""){
            $.ajax({
                type:"POST",
                url:"php/check_user.php",
                data:{
                    username:btoa($("#signup_email").val().trim())
                },
                cache:false,
                beforeSend:e=>{
                    $("#loader").removeClass("d-none");
                },
                success:response=>{
                    if(response.trim()=="user found"){
                        // $("#loader").addClass("d-none");
                        $("#loader").removeClass("fa fa-circle-o-notch fa-spin");
                        $("#loader").addClass("fa fa-times-circle text-danger");
                        $("#register-btn").attr("disabled","disabled");
                    }
                    else{
                        $("#loader").removeClass("fa fa-circle-o-notch fa-spin");
                        $("#loader").addClass("fa fa-check-circle text-primary");
                        $("#register-btn").removeAttr("disabled");
                    }
                }
            });
        }
    });
});