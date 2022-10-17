<?php
header('Content-type: text/plain');
foreach (getenv() as $Name => $Value) {
    echo "$Name: $Value\n";
}
foreach ($_SERVER as $Name => $Value) {
    echo "$Name: $Value\n";
}


