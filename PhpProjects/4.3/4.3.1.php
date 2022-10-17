<?php
session_start();
session_regenerate_id();
header('Content-type: text/html');
$html = file_get_contents("4.3.html");
$html = str_replace('---session-id---', session_id(), $html);
echo $html;
