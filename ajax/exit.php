<?php
session_start();
$seed = $_SESSION['csrf_seed'];
$token = md5($seed.$_SERVER['USER_AGENT'].$_SERVER['REMOTE_ADDR']);
$cookie = $_COOKIE['login'];
setcookie("login",null, -1, '/');
setcookie("PHPSESSID", null, -1,'/');
$fileName = "test1.xml";
$dom_xml = new DomDocument();
$dom->preserveWhiteSpace = false;
$dom_xml->load($fileName);

$tok=$dom_xml->getElementsByTagName("token");
Foreach ($tok as $element){
if (strval($element->nodeValue) == strval($token)){
    $del=$element->firstChild;
    $element->removeChild($del);
    }
  }
$dom_xml->save($fileName);
$cok=$dom_xml->getElementsByTagName("cookie");
Foreach ($cok as $element){
if (strval($element->nodeValue) == strval($cookie)){
    $del=$element->firstChild;
    $element->removeChild($del);
    }
  }

$xpath = new DOMXpath($dom_xml);
foreach( $xpath->query('//*[not(node())]') as $node ) {
    $node->parentNode->removeChild($node);
}
$dom_xml->formatOutput = true;
$dom_xml->preserveWhiteSpace = false;
$dom_xml->save($fileName);



$_SESSION = array();
session_destroy();
echo true;
 ?>
