<?php
$cookie_name = "topic";
setcookie($cookie_name, $_GET["id"], time()+60*60*2);
$_COOKIE['topic'] = $_GET["id"];
include("Posts.php");