<?php
	// Define the feeds
    $feeds = array(
    	"top" => loadFeed("http://feeds.smh.com.au/rssheadlines/top.xml"),
    	"national" => loadFeed("http://www.smh.com.au/rssheadlines/national/article/rss.xml"),
    	"world" => loadFeed("http://www.smh.com.au/rssheadlines/world/article/rss.xml"),
    	"technology" => loadFeed("http://www.smh.com.au/rssheadlines/technology/article/rss.xml"),
    	"entertainment" => loadFeed("http://www.smh.com.au/rssheadlines/entertainment/article/rss.xml"),
    	"lifestyle" => loadFeed("http://www.smh.com.au/rssheadlines/lifestyle/article/rss.xml"),
    	"sport" => loadFeed("http://www.smh.com.au/rssheadlines/sport/article/rss.xml"),
    );
    // Get the current page/news source
    if(isset($_GET['page'])){
		$page = $_GET['page'];
    }else{
		$page = "dashboard";
    }
    // Get the required feed and populate data
    if(isset($_GET['feed'])){
    	$data = $feeds[$_GET['feed']];
    }else{
    	$data = reset($feeds);
    }
?>

<div class='ui top fixed menu'>
	<div class='header item'><?php echo $data['channel']['image']['title']; ?></div>
	<?php
		foreach ($feeds as $key => $feed){
			echo "<a class='item' style='text-transform: capitalize;' href='?page=".$page."&feed=".$key."'>".$key."</a>";
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
						<img src='images/image.jpg'>
					</div>
					<div class='content'>
						<a class='header' href='".$i['link']."' target='_blank'>".$i['title']."</a>
						<div class='meta'><span></span></div>
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