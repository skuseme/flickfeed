<?php
//
// flick.feed - skuse.me - Tom Skuse - 2017
//

session_start();

//
// CONFIGURATION VARIABLES
//
$conf = array(
  "SiteTitle" => "flick.feed",
  "SiteContact" => "site@skuse.me",
  "SiteURL" => "https://skuse.me",
  "PrivacyPolicyURL" => "https://skuse.me/?page=privacy",
  "DefaultFeed" => "merge",
  "GoogleAnalyticsID" => "UA-87410597-3",
  "timezone" => "Australia/NSW",
  "debug" => false
  );

function getPage($page){
  if(isset($page) && $page != null){
    return $page;
  }else{
    return $conf['DefaultFeed'];
  }
}

function getFeed($feeds, $feed){
  if(isset($feed) && $feed != null){
    return $feeds[$feed];
  }else{
    return reset($feeds);
  }
}

function loadFeed($feed) {
  $xmlstr = file_get_contents($feed);
  $doc = new DOMDocument();
  $doc->loadXML($xmlstr);
  $root = $doc->documentElement;
  $output = domnode_to_array($root);
  $output['@root'] = $root->tagName;
  return $output;
}

function validateImage($imgurl){
    if(filter_var($imgurl, FILTER_VALIDATE_URL) === FALSE){
      $imgsrc = "images/image.jpg";
    }else{
      $imgsrc = $imgurl;
    }
    return $imgsrc;
}

function sortbyTimestamp($a, $b){
    return $b['item_timestamp'] - $a['item_timestamp'];
}

function sortByPublished($a, $b){
    return $b['epoch'] - $a['epoch'];
}

function handleJSON($feeds){
  $data = array();
  foreach($feeds as $feed){
    $array = json_decode(file_get_contents($feed), true);
    $source = $array['source'];
    foreach($array['articles'] as $item => $i){
      
      if(isset($i['author'])){
        $author = $i['author'];
      }else{
        $author = "0";
      }

      $epoch = strtotime($i['publishedAt']);
      $publish = date('r', $epoch);

      $srcImage = "images/".$source.".png";

      $article = array(
        "author" => $author,
        "srcImage" => $srcImage,
        "source" => $source,
        "title" => $i['title'],
        "description" => $i['description'],
        "url" => $i ['url'],
        "urlToImage" => $i['urlToImage'],
        "epoch" => $epoch,
        "published" => $publish
      );
      array_push($data, $article);
    }
  }
  usort($data, 'sortByPublished');
  return $data;
}

// XML-string-to-php-array
//github.com @gaarf
//https://github.com/gaarf/XML-string-to-PHP-array/blob/master/xmlstr_to_array.php
function domnode_to_array($node) {
  $output = array();
  switch ($node->nodeType) {

    case XML_CDATA_SECTION_NODE:
    case XML_TEXT_NODE:
      $output = trim($node->textContent);
    break;

    case XML_ELEMENT_NODE:
      for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) {
        $child = $node->childNodes->item($i);
        $v = domnode_to_array($child);
        if(isset($child->tagName)) {
          $t = $child->tagName;
          if(!isset($output[$t])) {
            $output[$t] = array();
          }
          $output[$t][] = $v;
        }
        elseif($v || $v === '0') {
          $output = (string) $v;
        }
      }
      if($node->attributes->length && !is_array($output)) { //Has attributes but isn't an array
        $output = array('@content'=>$output); //Change output into an array.
      }
      if(is_array($output)) {
        if($node->attributes->length) {
          $a = array();
          foreach($node->attributes as $attrName => $attrNode) {
            $a[$attrName] = (string) $attrNode->value;
          }
          $output['@attributes'] = $a;
        }
        foreach ($output as $t => $v) {
          if(is_array($v) && count($v)==1 && $t!='@attributes') {
            $output[$t] = $v[0];
          }
        }
      }
    break;
  }
  return $output;
}

function rsstotime($rss_time) {
    $day = substr($rss_time, 5, 2);
    $month = substr($rss_time, 8, 3);
    $month = date('m', strtotime("$month 1 2011"));
    $year = substr($rss_time, 12, 4);
    $hour = substr($rss_time, 17, 2);
    $min = substr($rss_time, 20, 2);
    $second = substr($rss_time, 23, 2);
    $timezone = substr($rss_time, 26);

    $timestamp = mktime($hour, $min, $second, $month, $day, $year);

    date_default_timezone_set('UTC');

    if(is_numeric($timezone)) {
        $hours_mod = $mins_mod = 0;
        $modifier = substr($timezone, 0, 1);       
        if($modifier == "+"){ $modifier = "-"; } else
        if($modifier == "-"){ $modifier = "+"; }
        $hours_mod = (int) substr($timezone, 1, 2);
        $mins_mod = (int) substr($timezone, 3, 2);
        $hour_label = $hours_mod>1 ? 'hours' : 'hour';
        $strtotimearg = $modifier.$hours_mod.' '.$hour_label;
        if($mins_mod) {
            $mins_label = $mins_mod>1 ? 'minutes' : 'minute';
            $strtotimearg .= ' '.$mins_mod.' '.$mins_label;
        }
        $timestamp = strtotime($strtotimearg, $timestamp);
    }
    //date_default_timezone_set('Australia/NSW');
    return $timestamp;
}
?>