<?php
while(!$Count = @fopen("Count.txt", "r+"))
    $Count = @fopen("Count.txt", "w+");
flock ($Count, LOCK_EX);
$Visitor = (int)fgets($Count);
++$Visitor;
ftruncate($Count, 0);
rewind($Count);
fputs($Count, $Visitor);
fclose($Count);
$html = file_get_contents('3.1.html');
$html = str_replace('---$hits---' , $Visitor , $html );
echo $html;
?>
