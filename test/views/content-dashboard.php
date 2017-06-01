<?php
	require('../config.php');
	// Define the feeds
    $feeds = array(
    	"latest" => loadFeed("http://www.abc.net.au/news/feed/51120/rss.xml"),
    	"top" => loadFeed("http://www.abc.net.au/news/feed/45910/rss.xml"),
    	"australia" => loadFeed("http://www.abc.net.au/news/feed/46182/rss.xml"),
    	"world" => loadFeed("http://www.abc.net.au/news/feed/52278/rss.xml"),
    	"business" => loadFeed("http://www.abc.net.au/news/feed/51892/rss.xml"),
    	"entertainment" => loadFeed("http://www.abc.net.au/news/feed/46800/rss.xml"),
    	"sport" => loadFeed("http://www.abc.net.au/news/feed/45924/rss.xml")
    );

    $page = GetPage($_POST['page']);
    $data = getFeed($feeds, $_POST['feed']);
?>

<div id="navbar" class='ui top fixed menu'>
	<div class='header item'><?php echo $data['channel']['image']['title']; ?></div>
	<?php
		foreach ($feeds as $key => $feed){
			echo "<a data-feed='".$key."' data-source=".$page." class='item feed-link' style='text-transform: capitalize;' href='#page=".$page."'>".$key."</a>";
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
				echo "
				<div class='item'>
					<div class='image'>
						<img src='".$i['media:group']['media:thumbnail']['@attributes']['url']."'>
					</div>
					<div class='content'>
						<a class='header' href='".$i['link']."' target='_blank'>".$i['title']."</a>
						<div class='meta'><span>".$i['media:group']['media:description']."</span></div>
						<div class='description'><p>".$i['description']."</p></div>
						<div class='extra'>".$i['pubDate']."</div>
					</div>
				</div>
				";
			}
		?>
		</div>
	</div>
</div>