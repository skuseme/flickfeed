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
  "SiteURL" => "https://skuse.me/flickfeed",
  "PrivacyPolicyURL" => "https://skuse.me/flickfeed/?page=privacy"
  );

function loadPage($page){
  if(isset($page)){
    return "views/content-".$page.".php";
  }else{
    return "views/content-dashboard.php";
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
?>