<?php
header('content-type: text/plain');
while(!$Count = @fopen("Count.txt", "r+"))
    $Count = @fopen("Count.txt", "w+");
flock ($Count, LOCK_EX);
$Visitor = (int)fgets($Count);
++$Visitor;
ftruncate($Count, 0);
rewind($Count);
fputs($Count, $Visitor);
echo $Visitor;
fclose($Count);
?>

