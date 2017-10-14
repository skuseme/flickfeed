<?php
	include_once('../config.php');
	// Define the feeds
    $feeds = array(
    	"All" => loadFeed("https://skuse.me/feed.php")
    );

    $page = GetPage($_POST['page']);
    $data = getFeed($feeds, $_POST['feed']);
    
    if($conf['debug'] == true){
	    echo "<pre>";
	    print_r($data);
	    echo "</pre>";
    }
?>

<div id="navbar" class='ui top fixed menu'>
	<div class='header item'>Dashboard</div>
	<div class="ui category search item">
		<div class="ui transparent icon input">
			<input class="prompt" type="text" placeholder="Search...">
			<i class="search icon"></i>
		</div>
		<div class="results"></div>
	</div>
</div>

<div id='content' class='ui'>
	<div class='ui raised segment'>
		<div class='ui items'>
		<?php
			foreach($data['item'] as $item => $i){
				echo "
				<div class='item'>
					<div id='itemimage' class='image'>
						<img src='".$i['item_image']."'>
					</div>
					<div class='content'>
						<a class='header' href='".$i['item_link']."' target='_blank'>".$i['item_title']."</a>";

						if($i['item_imagedesc'] != "0"){echo "<div class='meta'><span>".$i['item_imagedesc']."</span></div>";}

						echo "
						<div class='description'><p>".$i['item_desc']."</p></div>
						<div class='extra'>
						<img class='ui circular image mini left floated' src='".$i['channel_image']."'>
						".$i['item_pubdate']."<br />
						<a href='".$i['channel_link']."' target='_blank'>".$i['channel_link']."</a>
						</div>
					</div>
				</div>
				";
			}
		?>
		</div>
	</div>
</div>