<?php
 include "Database.php";
 session_start();
 function InputProtection($input){
   return htmlspecialchars(strip_tags($input));
 }
 try{
$name = InputProtection($_POST["name"]);
$creator = $_SESSION['username']; 
$date = date('Y-m-d H:i:s');
if(!empty($name)){
   $stmt = $conn->prepare("INSERT INTO Topic (Name, Tid, CreatedBy) VALUES (?, ?, ?)");
   $stmt->bind_param("sss",$name, $date, $creator);
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
include "Topics.php";