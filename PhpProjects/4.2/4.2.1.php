<?php
$cookie_name = "Session_Id";
$value  = rand();
setcookie($cookie_name, $value, time()+60*60*3);
$_COOKIE['Session_Id'] = $value;
header('Content-type: text/html');
$html = file_get_contents("4.2.html");
if(isset($_COOKIE['Session_Id'])){
    $html = str_replace('---session-id---', $_COOKIE['Session_Id'], $html);
    echo $html;
}

