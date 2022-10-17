<?php
include_once "Database.php";
header('Content-type: text/html');
$html = file_get_contents("Posts.html");
list($header, $body, $bottom)=explode('<!--===entries===-->' , $html , 3);
$toBeReplaced = array('---no---' , '---text---','---time---','---creator---', '---reply---');
$table = '';
$topic = $_COOKIE['topic'];
if(isset($topic)){
    $query = "SELECT * FROM Post WHERE TopicId = $topic ORDER BY Tid DESC";
    $result = mysqli_query($conn, $query);
    if ($result) {
        while($row = mysqli_fetch_assoc($result)){
            $query = "SELECT count(*) as total FROM Reply WHERE PostId = $row[Id]";
            $res = mysqli_query($conn, $query);     
            $count = mysqli_fetch_assoc($res);
            $replacement =array($row["Id"],$row["Text"],$row["Tid"],$row["CreatedBy"], $count['total']);
            $table .= str_replace($toBeReplaced , $replacement  , $body );
        }
    }
    $body =  $table;
}
echo $header. $body . $bottom ;
$conn->close();