<?php
include_once "Database.php";
header('Content-type: text/html');
$html = file_get_contents("Topics.html");
list($header, $body, $bottom)=explode('<!--===entries===-->' , $html , 3);
$toBeReplaced = array('---no---' ,'---time---','---creator---', '---name---', '---posts---');
$table = '';
$query = "SELECT * FROM Topic ORDER BY Tid DESC";
$result = mysqli_query($conn, $query);
if(empty($result)) {
    $query = "CREATE TABLE Topic (
              Id int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              Name varchar(255) NOT NULL,
              Tid varchar(255) NOT NULL,
              CreatedBy varchar(255) NOT NULL
              )";
              $res = mysqli_query($conn, $query);

    $sql = "CREATE TABLE Post (
              Id int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              Tid varchar(255) NOT NULL,
              CreatedBy varchar(255) NOT NULL,
              Text varchar(255) NOT NULL,
              TopicId int(6) NOT NULL
              )";
              $resul = mysqli_query($conn, $sql);
    $sql2 = "CREATE TABLE Reply (
              Id int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              Tid varchar(255) NOT NULL,
              CreatedBy varchar(255) NOT NULL,
              Text varchar(255) NOT NULL,
              PostId int(6) NOT NULL
              )";
              $resulte = mysqli_query($conn, $sql2);
  }
if ($result) {
    while($row = mysqli_fetch_assoc($result)){
      $query = "SELECT count(*) as total FROM Post WHERE TopicId = $row[Id]";
      $res = mysqli_query($conn, $query);     
      $count = mysqli_fetch_assoc($res);
      $replacement =array($row["Id"],$row["Tid"],$row["CreatedBy"],$row["Name"],$count['total']);
		  $table .= str_replace($toBeReplaced , $replacement  , $body );
    }
}
$body =  $table;
echo $header. $body . $bottom ;
$conn->close();