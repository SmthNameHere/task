<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
  {
  $username = trim(filter_var($_POST['username'],FILTER_SANITIZE_STRING));
    $username = strip_tags($username);
    $username = htmlspecialchars($username);
  $useremail = trim(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));
  $userlogin = trim(filter_var($_POST['login'],FILTER_SANITIZE_STRING));
    $userlogin = strip_tags($userlogin);
    $userlogin = htmlspecialchars($userlogin);
    //$userlogin = addslashes($userlogin);
  $userpass = trim(filter_var($_POST['pass'],FILTER_SANITIZE_STRING));
  $userpassagain = trim(filter_var($_POST['passagain'],FILTER_SANITIZE_STRING));
  $fileName = 'test1.xml';
  $error = '';
  $data = simplexml_load_file($fileName);

  if(strlen($username) <= 3 or strlen($username) >= 15 )
    $error = 'Некорректное имя';
    //$error = $username;
  else if(strlen($useremail) <= 3 or strlen($useremail) >= 30)
    $error = 'Некорректный email';
  else if(strlen($userlogin) <= 3 or strlen($userlogin) >= 15)
    $error = 'Некорректный логин';
  else if(strlen($userpass) <= 3 or strlen($userpass) >= 30)
    $error = 'Некорректный пароль';
  elseif ($userpass != $userpassagain)
    $error = 'Пароли не совпадают';
  else {
    foreach ($data->user as $checkrow) {
  	$checklogin = strval($checkrow->login);
    $checkemail = strval($checkrow->email);
    if($checklogin == $userlogin){
      $error = 'Такой логин уже используется';break;}

    else if($checkemail == $useremail){
      $error = 'Такой email уже зарегистрирован'; break;}

    else {
      $hash = "gfyfewf2asdfslLmgsgsr";
      $hashpass = md5($userpass . $hash);
      $xml = simplexml_load_file($fileName);
      $user = $xml->addChild('user');
      $user->addChild('login',$userlogin);
      $user->addChild('name',$username);
      $user->addChild('email',$useremail);
      $user->addChild('pass',$hashpass);
      $xml->asXML();
      $dom = dom_import_simplexml($xml)->ownerDocument;
      $dom->formatOutput = true;
      $dom->preserveWhiteSpace = false;
      $dom->loadXML($dom->saveXML());
      $dom->save($fileName);
      break;
    }
  }
}

  if($error != '') {
    $response = array('result' => $error );
  }
  else {
    $response = array('result' => 'ok' );
  }
  $json_response = json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
  echo $json_response;
}
?>
