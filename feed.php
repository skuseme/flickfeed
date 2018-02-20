<?php

include_once('config.php');

$xml = new SimpleXMLElement('<xml/>');

function handleABC($feed){
	$data = loadFeed($feed);
	$items = array();
	$channel_title = $data['channel']['image']['title'];
	$channel_image = "images/abc-icon.jpg";
	$channel_link = $data['channel']['image']['link'];

	foreach($data['channel']['item'] as $item => $i){
		$item_link = $i['link'];
		$item_title = $i['title'];
		$item_desc = $i['description'];
		$item_imgsrc = validateImage($i['media:group']['media:thumbnail']['@attributes']['url']);
		if($i['media:group']['media:description'] != null){
			$item_imagedesc = $i['media:group']['media:description'];
		}else{
			$item_imagedesc = "0";
		}
		$item_timestamp = rsstotime($i['pubDate']);
		$item_pubdate = date('r', $item_timestamp);

		$array = array(
			"channel_title" => $channel_title,
			"channel_image" => $channel_image,
			"channel_link" => $channel_link,
			"item_title" => $item_title,
			"item_link" => $item_link,
			"item_desc" => $item_desc,
			"item_image" => $item_imgsrc,
			"item_imagedesc" => $item_imagedesc,
			"item_timestamp" => $item_timestamp,
			"item_pubdate" => $item_pubdate
		);

		array_push($items, $array);
	}
	return $items;
}

function handleBBC($feed){
	$data = loadFeed($feed);
	$items = array();
	$channel_title = $data['channel']['image']['title'];
	$channel_image = "images/bbc-icon.jpg";
	$channel_link = $data['channel']['image']['link'];

	foreach($data['channel']['item'] as $item => $i){
		$item_link = $i['link'];
		$item_title = $i['title'];
		$item_desc = $i['description'];
		$item_imgsrc = validateImage($i['media:thumbnail']['@attributes']['url']);
		if($i['media:group']['media:description'] != null){
			$item_imagedesc = $i['media:group']['media:description'];
		}else{
			$item_imagedesc = "0";
		}
		$item_timestamp = rsstotime($i['pubDate']);
		$item_pubdate = date('r', $item_timestamp);

		$array = array(
			"channel_title" => $channel_title,
			"channel_image" => $channel_image,
			"channel_link" => $channel_link,
			"item_title" => $item_title,
			"item_link" => $item_link,
			"item_desc" => $item_desc,
			"item_image" => $item_imgsrc,
			"item_imagedesc" => $item_imagedesc,
			"item_timestamp" => $item_timestamp,
			"item_pubdate" => $item_pubdate
		);

		array_push($items, $array);
	}
	return $items;
}

function handleDaily($feed){
	$data = loadFeed($feed);
	$items = array();
	$channel_title = $data['channel']['image']['title'];
	$channel_image = "images/dailymail-icon.png";
	$channel_link = $data['channel']['atom:link']['@attributes']['href'];


	foreach($data['channel']['item'] as $item => $i){
		$item_link = $i['link'];
		$item_title = $i['title'];
		$item_desc = $i['description'];
		$item_imgsrc = validateImage($i['media:thumbnail']['@attributes']['url']);
		if($i['media:description'] != null){
			$item_imagedesc = $i['media:description'];
		}else{
			$item_imagedesc = "0";
		}
		$item_timestamp = rsstotime($i['pubDate']);
		$item_pubdate = date('r', $item_timestamp);

		$array = array(
			"channel_title" => $channel_title,
			"channel_image" => $channel_image,
			"channel_link" => $channel_link,
			"item_title" => $item_title,
			"item_link" => $item_link,
			"item_desc" => $item_desc,
			"item_image" => $item_imgsrc,
			"item_imagedesc" => $item_imagedesc,
			"item_timestamp" => $item_timestamp,
			"item_pubdate" => $item_pubdate
		);

		array_push($items, $array);
	}
	return $items;
}

//ABC FEEDS
$abc = handleABC("http://www.abc.net.au/news/feed/45910/rss.xml");

//BBC FEEDS
$bbc = handleBBC("http://feeds.bbci.co.uk/news/world/rss.xml");

//DAILY MAIL
$daily = handleDaily("http://www.dailymail.co.uk/news/afghanistan/index.rss");

$data = array_merge($abc, $bbc, $daily);
usort($data, 'sortbyTimestamp');

foreach($data as $item => $i){
    $item = $xml->addChild('item');
    $item->channel_title = $i['channel_title'];
    $item->channel_image = $i['channel_image'];
    $item->channel_link = $i['channel_link'];
    $item->item_title = $i['item_title'];
    $item->item_link = $i['item_link'];
    $item->item_desc = $i['item_desc'];
    $item->item_image = $i['item_image'];
    $item->item_imagedesc = $i['item_imagedesc'];
    $item->item_pubdate = $i['item_pubdate'];
}

Header('Content-type: text/xml');
print($xml->asXML());

/*
echo "<pre>";
print_r($data);
echo "</pre>";
*/
?>