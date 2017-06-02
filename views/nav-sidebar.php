<?php
	$links = array(
		array(
			"title" => "Dashboard",
			"shortname" => "dashboard",
			"icon" => "dashboard"
		),
		array(
			"title" => "ABC News",
			"shortname" => "abc",
			"icon" => "newspaper"
		),
		array(
			"title" => "BBC News",
			"shortname" => "bbc",
			"icon" => "newspaper"
		),
		array("title" => "Daily Mail",
			"shortname" => "dailymail",
			"icon" => "newspaper"
		),
		array(
			"title" => "Sydney Morning Herald",
			"shortname" => "smh",
			"icon" => "newspaper"
		),
		array(
			"title" => "Aljazeera",
			"shortname" => "aljazeera",
			"icon" => "newspaper"
		),
		array("title" => "Gizmodo Australia",
			"shortname" => "gizmodo",
			"icon" => "rss"
		)
	);

	foreach($links as $link){
		echo "<a class='item sidebar-link ".$link['shortname']."' data-link='".$link['shortname']."' href='#page=".$link['shortname']."'><i class='icon ".$link['icon']."'></i>".$link['title']."</a>";
	}
?>