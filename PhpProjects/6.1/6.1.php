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
$query = "SELECT * FROM guest";
$result = mysqli_query($conn, $query);
if(empty($result)) {
  $query = "CREATE TABLE guest (        
            TID varchar(255) NOT NULL,
            REMOTE_ADDR varchar(255) NOT NULL,
            REMOTE_USER_AGENT varchar(255) NOT NULL
            )";
  $result = mysqli_query($conn, $query);
}
else{
  $date = date('Y-m-d H:i:s');
  $REMOTE_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
  $REMOTE_ADDR= $_SERVER['REMOTE_ADDR'];
  $sql = "INSERT INTO guest (TID, REMOTE_ADDR, REMOTE_USER_AGENT)
VALUES ('$date', '$REMOTE_ADDR', '$REMOTE_USER_AGENT')";
$conn->query($sql);
}

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo 'TID : '.$row["TID"].'<br>'.
    ' REMOTE_ADDR : '.$row["REMOTE_ADDR"].'<br>'.
    ' REMOTE_USER_AGENT : '.$row["REMOTE_USER_AGENT"].'<br><br>';
  }
}
?>

