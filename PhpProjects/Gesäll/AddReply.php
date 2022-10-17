<?php
 include "Database.php";
 session_start();
 try{
$text = $_POST["name"];
$creator = $_SESSION['username']; 
$date = date('Y-m-d H:i:s');
$post = $_COOKIE['post'];
if(!empty($text)){
    $stmt = $conn->prepare("INSERT INTO Reply (Tid, CreatedBy, Text, PostId) VALUES (?, ?, ?,?)");
    $stmt->bind_param("ssss",$date, $creator, $text,$post);
    $stmt->execute();
    $stmt->close();
    $conn->commit();
}
else{
    echo '<script>alert("Reply is empty")</script>';
}
 }
 catch(\Throwable $e){
    $conn->rollback();
    echo $e;
 }
include "Replies.php";