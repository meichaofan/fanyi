$(function(){
    $('#example1').hover(function(){
        $(this).append("<p id='pic'><img src='"+this.href+"' id='pic1'></p>");
        $('#example1').mousemove(function(e){
            $("#pic").css({
                "top":(e.pageY+10)+"px",
                "left":(e.pageX+20)+"px"
                }).fadeIn("fast") ;  
        });
    }.function(){
        $("#pic").remove();
    });
    });
