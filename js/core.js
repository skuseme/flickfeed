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
        LoadFeed("dashboard", null)
    }else{
        $("." + page).addClass("active");
        LoadFeed(page, null)
    }
    
    $(".sidebar-link").click(function(){
        $(".sidebar-link").removeClass("active")
        var link = $(this).attr("data-link");
        $("." + link).addClass("active");
    });

    $(".sidebar-link").click(function(){
        $("#container").html("<div class='ui active centered text inline loader'><p>Loading</p></div>")
        var link = $(this).attr("data-link");
        LoadFeed(link, null)
    });

    $("body").on("click",".feed-link",function(){
        $("#container").html("<div class='ui active centered text inline loader'><p>Loading</p></div>")
        var source = $(this).attr("data-source");
        var feed = $(this).attr("data-feed");
        LoadFeed(source, feed)
    });
});

function LoadFeed(source, feed){
    $("#container").html("<div class='ui active centered text inline loader'><p>Loading</p></div>")
    $.post("views/content-"+source+".php", {page: source, feed: feed}).done(function( data ){
        $("#container").html(data)
    });
}

var get = [];
var type = window.location.hash.substr(1);
type.replace('#', '').split('&').forEach(function (val) {
    split = val.split("=", 2);
    get[split[0]] = split[1];
});