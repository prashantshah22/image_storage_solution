$(document).ready(()=>{
        $("#register-btn").click((e)=>{
            e.preventDefault();
            var fullName = $("#signup_name").val().trim();
            if(fullName === '') {
                    var message=document.createElement("div");
                        message.className="alert alert-warning";
                        message.innerHTML="<b>Full Name is required!</b>";
                        $(".signup-notice").append(message);
                        setTimeout(()=>{
                            $(".signup-notice").html("");
                            $("#signup_name").focus();

                        },5000);
            }
            else{
            $.ajax({
                type:"POST",
                url:"php/signup.php",
                data:{
                    fullname:btoa($("#signup_name").val().trim()),
                    email:btoa($("#signup_email").val().trim()),
                    password:btoa($("#signup_password").val().trim())
                },
                cache:false,
                beforeSend:e=>{
                    $("#register-btn").html("Please wait");
                    $("#register-btn").attr("disabled","disabled");
                },
                success:response=>{
                    if(response.trim()=="sending success"){
                        $(".signup_form").fadeOut(500,()=>{
                            $(".activator").removeClass("d-none");
                        });

                    }
                    else{
                        var message=document.createElement("div");
                        message.className="alert alert-warning";
                        message.innerHTML="<b>Something Went wrong PLease try again..</b>";
                        $(".signup-notice").append(message);
                        $("#register-btn").html("Register Now");
                        $(".signup_form").trigger("reset");
                        $("#loader").removeClass("fa fa-times-circle text-danger");
                        $("#loader").addClass("fa fa-circle-o-notch fa-spin d-none");
                        setTimeout(()=>{
                            $(".signup-notice").html("");
                        },5000)
                       
                    }
                }
            });
        }})
});