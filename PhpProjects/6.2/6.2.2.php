<?php
 include "6.2.3.php";
$sender = InputProtection($_POST["name"]);
$page = InputProtection($_POST["homepage"]);
$mail = InputProtection($_POST["email"]);
$text  = InputProtection($_POST["comment"]); 
$date = date('Y-m-d H:i:s');
$stmt = $conn->prepare("INSERT INTO Comments (Name, Website,Tid, Email, Comment) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss",$sender, $page, $date, $mail, $text);
$stmt->execute();
$stmt->close();
function InputProtection($input){
    return htmlspecialchars(strip_tags($input));
}
include "6.2.1.php";
