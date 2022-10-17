<?php
 include "Database.php";
 session_start();
 try{
$text = $_POST["name"];
$creator = $_SESSION['username']; 
$date = date('Y-m-d H:i:s');
$topic = $_COOKIE['topic'];
if(!empty($text)){
$stmt = $conn->prepare("INSERT INTO Post (Tid, CreatedBy, Text, TopicId) VALUES (?, ?, ?,?)");
$stmt->bind_param("ssss",$date, $creator, $text,$topic);
$stmt->execute();
$stmt->close();
$conn->commit();

 }
 else{
    echo '<script>alert("No name is given")</script>';
 }
}
 catch(\Throwable $e){
    $conn->rollback();
    echo $e;
 }
include "Posts.php";