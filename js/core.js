$( document ).ready(function() {
	$('.ui.accordion').accordion();
	
    $("#debugClose").click(function(){
        $("#debugNotification").fadeOut( "1", function() {
            $("#debugNotification").remove();
        });
    });

    page = get["page"];
    if(page == null){
        $(".dashboard").addClass("active");
    }else{
        $("." + page).addClass("active");
    }
    $(".sidebar-link").click(function(){$(".sidebar-link").removeClass("active")});
    $(".sidebar-link").click(function(){
        var link = $(this).attr("data-link");
        $("." + link).addClass("active");
        console.log(link);
    });
});

var get = [];
location.search.replace('?', '').split('&').forEach(function (val) {
    split = val.split("=", 2);
    get[split[0]] = split[1];
});
