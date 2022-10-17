<?php 
$session_id = rand();
$html = file_get_contents("4.1.html");
$html = str_replace('---session-id---', $session_id, $html);
echo $html;
?>