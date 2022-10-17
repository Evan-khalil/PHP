<?php 
header('Content-type: text/plain');
echo 'session-id: '.$_GET["session-id"],"\n";
if(isset($_GET["name"])){
    echo 'Namn: '.$_GET["name"], "\n";
echo 'button: '.$_GET["button"], "\n";
}
?>
