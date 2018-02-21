<?php
	include_once('../config.php');
	// Define the feeds

    $data = handleJSON(array(
		"https://newsapi.org/v1/articles?source=abc-news-au&sortBy=top&apiKey=f9bb5ef86ddb458cb2efaf6ebac16eef",
		"https://newsapi.org/v1/articles?source=al-jazeera-english&sortBy=top&apiKey=f9bb5ef86ddb458cb2efaf6ebac16eef",
		"https://newsapi.org/v1/articles?source=bbc-news&sortBy=top&apiKey=f9bb5ef86ddb458cb2efaf6ebac16eef",
		"https://newsapi.org/v1/articles?source=business-insider&sortBy=top&apiKey=f9bb5ef86ddb458cb2efaf6ebac16eef",
		"https://newsapi.org/v1/articles?source=cnn&sortBy=top&apiKey=f9bb5ef86ddb458cb2efaf6ebac16eef",
		"https://newsapi.org/v1/articles?source=daily-mail&sortBy=top&apiKey=f9bb5ef86ddb458cb2efaf6ebac16eef",
		"https://newsapi.org/v1/articles?source=google-news&sortBy=top&apiKey=f9bb5ef86ddb458cb2efaf6ebac16eef",
		"https://newsapi.org/v1/articles?source=the-guardian-au&sortBy=top&apiKey=f9bb5ef86ddb458cb2efaf6ebac16eef"
	));

    $page = GetPage($_POST['page']);

    if($conf['debug'] == true){
	    echo "<pre>";
	    print_r($data);
	    echo "</pre>";
    }
?>

<div id="navbar" class='ui top fixed menu'>
	<div onClick="hamburger()" class='header item'><i class='icon bars'></i>News API</div>
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
			foreach($data as $item => $i){
				echo "
				<div class='item'>
					<div id='itemimage1' class='ui circular image mini left floated'>
						<img src='".$i['srcImage']."'>
					</div>
					<div class='content'>
						<a class='header' href='".$i['url']."' target='_blank'>".$i['title']."</a>
						<div class='meta'><span>".$i['published']."</span></div>
						<div class='description'><p>".$i['description']."</p></div>
					</div>
				</div>
				";
			}
		?>
		</div>
	</div>
</div>