<?php
include_once "Database.php";
header('Content-type: text/html');
$html = file_get_contents("Replies.html");
list($header, $body, $bottom)=explode('<!--===entries===-->' , $html , 3);
$toBeReplaced = array('---text---','---time---','---creator---');
$table = '';
$post = $_COOKIE['post'];
if(isset($post)){
    $query = "SELECT * FROM Reply WHERE PostId = $post ORDER BY Tid DESC;" ;
    $result = mysqli_query($conn, $query);
    if ($result) {
        while($row = mysqli_fetch_assoc($result)){
            $replacement =array($row["Text"],$row["Tid"],$row["CreatedBy"]);
            $table .= str_replace($toBeReplaced , $replacement  , $body );
        }
    }
    $body =  $table;
}

echo $header. $body . $bottom ;
$conn->close();