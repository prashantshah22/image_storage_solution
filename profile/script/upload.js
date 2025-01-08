$(document).ready(()=>{
    $(".upload-icon").click(()=>{
        var input=document.createElement("INPUT");
        input.type="file";
        // input.name="data";
        input.accept="image/*";
        input.click();
        input.onchange=e=>{
            var file=new FormData();
            file.append("data",e.target.files[0]);
            $.ajax({
                type:"post",
                url:"php/upload.php",
                data:file,
                contentType:false,
                processData:false,
                cache:false,
                xhr:function (){
                    var request=new XMLHttpRequest();
                    request.upload.onprogress=function(e){
                        var loaded=e.loaded/1024/1024;
                        var total=e.total/1024/1024;
                        var per=((loaded/total)*100).toFixed(2);
                        $(".progress_control").css({width:per+"%",});
                        $(".progress_per").html(per+"%");
                    }
                    return request;
                },
                beforeSend:e=>{
                    $(".upload_header").html("Uploading..");
                    $(".upload-icon").css({
                        opacity:"0.5",
                        PointerEvents:"none",
                    }),
                    $(".upload_progress_con").removeClass("d-none");
                    $(".progress_detail").removeClass("d-none");
                },
                success:response=>{
                    if(response.trim()=="success"){
                        var message=document.createElement("div");
                        message.className="alert alert-success shadow-lg rounded-0";
                        message.innerHTML=`<b>${response}</b>`;
                        $(".upload_notice").html(message);
                        setTimeout(()=>{
                            $(".upload_progress_con").addClass("d-none");
                            $(".progress_detail").addClass("d-none");
                            $(".upload-icon").css({opacity:"1",PointerEvents:"inherit",});
                            $(".upload_header").html("Upload Files");
                            $(".upload_notice").html("");
                        },3000);
                        $.ajax({
                            type:"post",
                            url:"php/count_photo.php",
                            beforeSend:e=>{
                                $(".count_pic").html("updating ..");
                            },
                            success:responsse=>{
                                $(".count_pic").html(responsse);
                            }
                        });
                        $.ajax({
                            type:"post",
                            url:"php/memory.php",
                            beforeSend:e=>{
                                $(".used_memory").html("updating .."); 
                                $(".free_memory").html("updating ..");
                            },
                            success:respons=>{
                                var json_response=JSON.parse(respons);
                                $(".used_memory").html(json_response[0]);
                                var percentage=json_response[2]+"%";
                                $(".free_memory").html("FREE SPACE: "+json_response[1]+"MB");
                                $(".memory-progress").css("width",percentage);
                            }
                        })
                    }
                    else{
                        var message=document.createElement("div");
                        message.className="alert alert-danger shadow-lg rounded-0";
                        message.innerHTML=`<b>${response}</b>`;
                        $(".upload_notice").html(message);
                        setTimeout(()=>{
                            $(".upload_progress_con").addClass("d-none");
                            $(".progress_detail").addClass("d-none");
                            $(".upload-icon").css({opacity:"1",PointerEvents:"inherit",});
                            $(".upload_header").html("Upload Files");
                            $(".upload_notice").html("");
                        },3000);
                    }

                }
            });
        };
    });
});