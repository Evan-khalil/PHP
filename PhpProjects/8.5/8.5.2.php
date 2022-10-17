<?php
$cookie_name = "Session_Id";
$value  = rand();
setcookie($cookie_name, $value, time()+60*60*3,'','',TRUE);
$_COOKIE['Session_Id'] = $value;
header('Content-type: text/html');
$html = file_get_contents("8.5.html");
if(isset($_COOKIE['Session_Id'])){
    $html = str_replace('---session-id-secure---', $_COOKIE['Session_Id'], $html);
    echo $html;
}




