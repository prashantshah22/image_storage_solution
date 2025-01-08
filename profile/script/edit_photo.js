$(document).ready(()=>{
    $(".edit-icon").each(function(){
        $(this).click(function(){
           var img_path =$(this).attr("data-bs-location");
           var ftr = this.parentElement;
           var span = ftr.getElementsByTagName("span")[0];
           var loader=ftr.getElementsByClassName("loader")[0];
           span.contentEditable=true;
           span.focus();
           var old_name=span.innerHTML;
           var edit_icon=$(this);
           $(this).addClass("d-none");
           var save_icon=ftr.getElementsByClassName("save-icon")[0];
           $(save_icon).removeClass("d-none");
           $(save_icon).click(function(){
            var photo_name=span.innerHTML;
            $.ajax({
                type:"post",
                url:"php/rename.php",
                data:{
                    photo_name:photo_name,
                    photo_path:img_path,
                },
                beforeSend:()=>{
                    $(loader).removeClass("d-none");
                    $(save_icon).removeClass("d-none");
                    span.focus();
                    
                },
                success:response=>{
                    if(response.trim()=="already exist"){
                        alert(response);
                        $(loader).addClass("d-none");
                        $(save_icon).removeClass("d-none");
                    }
                    else if(response.trim()=="success"){
                        span.innerHTML=photo_name;
                        $(loader).addClass("d-none");
                        span.contentEditable="false";
                        $(save_icon).addClass("d-none");
                        $(edit_icon).removeClass("d-none");
                        var prev_down_link=ftr.getElementsByClassName("download-icon")[0].getAttribute("data-bs-location");
                        var current_down_link=prev_down_link.replace(old_name,photo_name);
                        ftr.getElementsByClassName("download-icon")[0].setAttribute("data-bs-location",current_down_link);
                        ftr.getElementsByClassName("download-icon")[0].setAttribute("file-name",photo_name);
                        ftr.getElementsByClassName("delete-icon")[0].setAttribute("data-bs-location",current_down_link);
                        ftr.getElementsByClassName("delete-icon")[0].setAttribute("file-name",photo_name);
                    }
                    else{
                        alert(response);
                    }
                }
            })
           })

        });
    });
});
//downoad image
$(document).ready(()=>{
    $(".download-icon").each(function(){
        $(this).click(function(){
            var downlad_link=$(this).attr("data-bs-location");
            var name=$(this).attr("file-name");
            var a=document.createElement("a");
            a.href=downlad_link;
            a.download=name;
            a.click();

        });
    });
});
// delete image
$(document).ready(()=>{
    $(".delete-icon").each(function(){
        var del_icon=$(this);
        $(this).click(()=>{
            $.ajax({
                type:"post",
                url:"php/delete.php",
                data:{
                    photo_path:$(this).attr("data-bs-location"),
                },
                beforeSend:e=>{
                    $(this).removeClass("fa fa-trash");
                    $(this).addClass("fa fa-spinner fa-spin");
                },
                success:response=>{
                   if(response.trim()=="deleted"){
                    del_icon.parent().parent().remove();
                   }
                   else{
                        alert(response);
                   }
                }
            })
        })
    })
})