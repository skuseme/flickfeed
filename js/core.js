$( document ).ready(function() {
	$('.ui.accordion').accordion();
	
    $("#debugClose").click(function(){
        $("#debugNotification").fadeOut( "1", function() {
            $("#debugNotification").remove();
        });
    });
    
	$('.sidebar').sidebar({
		dimPage: false,
		closable: false
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
        $("#container").html("<div class='ui active centered text inline loader'><p>"+randomLoadingMessage()+"</p></div>")
        var link = $(this).attr("data-link");
        LoadFeed(link, null)
    });

    $("body").on("click",".feed-link",function(){
        $("#container").html("<div class='ui active centered text inline loader'><p>"+randomLoadingMessage()+"</p></div>")
        var source = $(this).attr("data-source");
        var feed = $(this).attr("data-feed");
        LoadFeed(source, feed)
    });
});

function hamburger(){
	$('.ui.sidebar').sidebar('toggle');
}

function LoadFeed(source, feed){
	curPage = source;
    curFeed = feed;
    $("#container").html("<div class='ui active centered text inline loader'><p>"+randomLoadingMessage()+"</p></div>")
    $.post("views/content-"+source+".php", {page: source, feed: feed}).done(function( data ){
        $("#container").html(data)
        if(feed == null){
        	$(".feed-link").first().addClass("active")
        }else{
        	$("."+source+"-"+feed).addClass("active")
        }
        UpdateTracker(source, feed)
        
        if($(window).width() < 767){
        	$("div.image").removeClass("image").addClass("ui fluid image");
    	}
    });
    console.log("LoadFeed - " + source+"/"+feed)
}

function UpdateTracker(source, feed){
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', gaTrackerID, 'auto');
	ga('send', 'pageview', {
		'page': '#page='+source+'&feed='+feed,
		'title': source+' / '+feed,
		'hitCallback': function() {
			console.log("Hit callback");
		}
	});
}

var curPage = null;
var curFeed = null;

setInterval(function(){
	var now = new Date(Date.now());
	console.log(now + "- Reloading " + curPage + "/" + curFeed)
	LoadFeed(curPage, curFeed);
}, 300000);

var get = [];
var type = window.location.hash.substr(1);
type.replace('#', '').split('&').forEach(function (val) {
    split = val.split("=", 2);
    get[split[0]] = split[1];
});

var randomLoadingMessage = function() {
    var lines = new Array(
        "Locating the required gigapixels to render...",
        "Spinning up the hamster...",
        "Shovelling coal into the server...",
        "Programming the flux capacitor","Adding Hidden Agendas",
		"Adjusting Bell Curves",
		"Aesthesizing Industrial Areas",
		"Aligning Covariance Matrices",
		"Applying Feng Shui Shaders",
		"Applying Theatre Soda Layer",
		"Asserting Packed Exemplars",
		"Attempting to Lock Back-Buffer",
		"Binding Sapling Root System",
		"Breeding Fauna",
		"Building Data Trees",
		"Bureacritizing Bureaucracies",
		"Calculating Inverse Probability Matrices",
		"Calculating Llama Expectoration Trajectory",
		"Calibrating Blue Skies",
		"Charging Ozone Layer",
		"Coalescing Cloud Formations",
		"Cohorting Exemplars",
		"Collecting Meteor Particles",
		"Compounding Inert Tessellations",
		"Compressing Fish Files",
		"Computing Optimal Bin Packing",
		"Concatenating Sub-Contractors",
		"Containing Existential Buffer",
		"Debarking Ark Ramp",
		"Debunching Unionized Commercial Services",
		"Deciding What Message to Display Next",
		"Decomposing Singular Values",
		"Decrementing Tectonic Plates",
		"Deleting Ferry Routes",
		"Depixelating Inner Mountain Surface Back Faces",
		"Depositing Slush Funds",
		"Destabilizing Economic Indicators",
		"Determining Width of Blast Fronts",
		"Deunionizing Bulldozers",
		"Dicing Models",
		"Diluting Livestock Nutrition Variables",
		"Downloading Satellite Terrain Data",
		"Exposing Flash Variables to Streak System",
		"Extracting Resources",
		"Factoring Pay Scale",
		"Fixing Election Outcome Matrix",
		"Flood-Filling Ground Water",
		"Flushing Pipe Network",
		"Gathering Particle Sources",
		"Generating Jobs",
		"Gesticulating Mimes",
		"Graphing Whale Migration",
		"Hiding Willio Webnet Mask",
		"Implementing Impeachment Routine",
		"Increasing Accuracy of RCI Simulators",
		"Increasing Magmafacation",
		"Initializing My Sim Tracking Mechanism",
		"Initializing Rhinoceros Breeding Timetable",
		"Initializing Robotic Click-Path AI",
		"Inserting Sublimated Messages",
		"Integrating Curves",
		"Integrating Illumination Form Factors",
		"Integrating Population Graphs",
		"Iterating Cellular Automata",
		"Lecturing Errant Subsystems",
		"Mixing Genetic Pool",
		"Modeling Object Components",
		"Mopping Occupant Leaks",
		"Normalizing Power",
		"Obfuscating Quigley Matrix",
		"Overconstraining Dirty Industry Calculations",
		"Partitioning City Grid Singularities",
		"Perturbing Matrices",
		"Pixalating Nude Patch",
		"Polishing Water Highlights",
		"Populating Lot Templates",
		"Preparing Sprites for Random Walks",
		"Prioritizing Landmarks",
		"Projecting Law Enforcement Pastry Intake",
		"Realigning Alternate Time Frames",
		"Reconfiguring User Mental Processes",
		"Relaxing Splines",
		"Removing Road Network Speed Bumps",
		"Removing Texture Gradients",
		"Removing Vehicle Avoidance Behavior",
		"Resolving GUID Conflict",
		"Reticulating Splines",
		"Retracting Phong Shader",
		"Retrieving from Back Store",
		"Reverse Engineering Image Consultant",
		"Routing Neural Network Infanstructure",
		"Scattering Rhino Food Sources",
		"Scrubbing Terrain",
		"Searching for Llamas",
		"Seeding Architecture Simulation Parameters",
		"Sequencing Particles",
		"Setting Advisor Moods",
		"Setting Inner Deity Indicators",
		"Setting Universal Physical Constants",
		"Sonically Enhancing Occupant-Free Timber",
		"Speculating Stock Market Indices",
		"Splatting Transforms",
		"Stratifying Ground Layers",
		"Sub-Sampling Water Data",
		"Synthesizing Gravity",
		"Synthesizing Wavelets",
		"Time-Compressing Simulator Clock",
		"Unable to Reveal Current Activity",
		"Weathering Buildings",
		"Zeroing Crime Network"
    );
    return lines[Math.round(Math.random()*(lines.length-1))];
}