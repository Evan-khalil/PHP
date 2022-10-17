<?php
header('Content-type: text/plain');
foreach ($_POST as $_KEY => $value){
    echo $_KEY .': '.$value ."\n";
}
?>