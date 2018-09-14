<?php
	include_once('../config.php');
	// Define the feeds
    $feeds = array(
    	"all" => loadFeed("http://feeds.gizmodo.com.au/gizmodoaustralia")
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
	<div onClick="hamburger()" class='header item'><i class='icon bars'></i><?php echo $data['channel']['title']; ?></div>
	<?php
		foreach ($feeds as $key => $feed){
			echo "<a data-feed='".$key."' data-source=".$page." class='item feed-link ".$page."-".$key."' style='text-transform: capitalize;' href='#page=".$page."'>".$key."</a>";
		}
	?>
</div>

<div id='content' class='ui'>
	<div class='ui raised segment'>
		<h3 class='ui header'>
			<?php echo "<img class='ui circular image' src='".$data['channel']['image']['url']."'>"; ?>
			<div class='content'>
				<?php echo $data['channel']['image']['title']; ?>
				<?php echo "<div class='sub header'><a href='".$data['channel']['image']['link']."' target='_blank'>".$data['channel']['image']['link']."</a></div>"; ?>
			</div>
		</h3>
		<div class='ui items'>
		<?php
			foreach($data['channel']['item'] as $item => $i){
				$imgurl = $i['media:thumbnail']['@attributes']['url'];
				if(filter_var($imgurl, FILTER_VALIDATE_URL) === FALSE){
					$imgsrc = "images/image.jpg";
				}else{
					$imgsrc = $imgurl;
				}
				echo "
				<div class='item'>
					<div id='itemimage' class='image'>
						<img src='".$imgsrc."'>
					</div>
					<div class='content'>
						<a class='header' href='".$i['link']."' target='_blank'>".$i['title']."</a>
						<div class='meta'><span></span></div>
						<div class='description'><p>".strip_tags($i['description'])."</p></div>
						<div class='extra'>".$i['pubDate']."</div>
					</div>
				</div>
				";
			}
		?>
		</div>
	</div>
</div>