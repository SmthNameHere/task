<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])
&& !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
    $login = trim(filter_var($_POST['login'],FILTER_SANITIZE_STRING));
    $pass = trim(filter_var($_POST['pass'],FILTER_SANITIZE_STRING));

  $fileName = 'test1.xml';
  $data = simplexml_load_file($fileName);
  $error = 'Пользователь не найден';


  if(strlen($login) <= 3 or strlen($login) >= 15){
    $error = 'Некорректный логин';

      }
  else if(strlen($pass) <= 3) {
    $error = 'Введите пароль';
     }
  else {
    session_start();
    $hash = "gfyfewf2asdfslLmgsgsr";
    $hashpass = md5($pass . $hash);

    foreach ($data->user as $checkrow) {

      if(strval($checkrow->login) == strval($login) and strval($checkrow->pass) == $hashpass){
        $error = '';
        $cipher = base64_encode($login);
        setcookie("login", $cipher, time()+3600*24*7,"/");


        $seed = $_SESSION['csrf_seed'] = mt_rand(0, PHP_INT_MAX);
        $token = md5($seed.$_SERVER['USER_AGENT'].$_SERVER['REMOTE_ADDR']);

        if(strval($checkrow->cookie) == $cipher or strval($checkrow->token) == $token){
          break; }
        else {
        $checkrow->addchild('cookie',$cipher);
        $checkrow->addchild('token',$token);
        $data->asXML();
        $dom = dom_import_simplexml($data)->ownerDocument;
        $dom->formatOutput = true;
        $dom->preserveWhiteSpace = false;
        $dom->loadXML($dom->saveXML());
        $dom->save($fileName);

        break;
          }

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
