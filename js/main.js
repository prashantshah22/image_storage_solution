$(document).ready(()=>{
    $("#eye").click(()=>{
        if($("#signup_password").attr("type")=="password"){
            $("#signup_password").attr("type" ,"text");
            document.querySelector("#eye").style.color="black";
        }
        else{
            $("#signup_password").attr("type" ,"password");
            document.querySelector("#eye").style.color="#ccc";
        }
    });
});
$(document).ready(()=>{
    $("#login_eye").click(()=>{
        if($("#login_password").attr("type")=="password"){
            $("#login_password").attr("type" ,"text");
            document.querySelector("#login_eye").style.color="black";
        }
        else{
            $("#login_password").attr("type" ,"password");
            document.querySelector("#login_eye").style.color="#ccc";
        }
    });
})