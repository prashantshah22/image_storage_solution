$(document).ready(()=>{
    $(".pic").each(function(){
        $(this).click(()=>{
            var img=document.createElement("img");
            img.src=$(this).attr("src");
            $(img).css({style:"100%",
                width:"100%",
            });
            $(".modal-body").html(img);
            var modal = new bootstrap.Modal(document.getElementById('modal-view'));
            modal.show();
        });
    });
});