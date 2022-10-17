<?php 
header('Content-type: text/plain');
echo 'session-id: '.$_COOKIE['Session_Id'],"\n";
if(isset($_GET["name"])){
    echo 'Namn: '.$_GET["name"], "\n";
echo 'button: '.$_GET["button"], "\n";
}
?>