<?php
function databaseConnection(){
    $mysql_host = 'host';
    $mysql_user = 'user';
    $mysql_password = 'pass';
    $mysql_db = 'db';
    $mysql_port = 3306;
    return @mysqli_connect($mysql_host, $mysql_user,$mysql_password, $mysql_db, $mysql_port);
}
$conn = databaseConnection();
?>