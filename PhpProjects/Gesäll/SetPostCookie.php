<?php
$cookie_name = "post";
setcookie($cookie_name, $_GET["id"], time()+60*60*2);
$_COOKIE['post'] = $_GET["id"];
include("Replies.php");