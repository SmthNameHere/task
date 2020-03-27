<?php
setcookie('login','',time()-5);
$seed = $_SESSION['csrf_seed'];
$token = md5($seed.$_SERVER['USER_AGENT'].$_SERVER['REMOTE_ADDR']);

$fileName = 'test1.xml';
$data = simplexml_load_file($fileName);
foreach ($data->user as $m) {
  if (strval($m->token) == $token) {
     //unset($m);
     $data->remove_child($m);
     $data->asXML();
     $dom = dom_import_simplexml($data)->ownerDocument;
     $dom->formatOutput = true;
     $dom->preserveWhiteSpace = false;
     $dom->loadXML($dom->saveXML());
     $dom->save($fileName);
     break; }
}
session_start();
session_unset();
session_destroy();
echo true;
 ?>
