<?php
 include "6.3.2.php";
 
 try{
$sender = InputProtection($_POST["name"]);
$page = InputProtection($_POST["homepage"]);
$mail = InputProtection($_POST["email"]);
$text  = InputProtection($_POST["comment"]); 
$date = date('Y-m-d H:i:s');
$fileName = basename($_FILES["image"]["name"]); 
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
$allowTypes = array('jpg','png','jpeg');
if(!in_array($fileType, $allowTypes)){
    echo "Image type not allowed! <br> only jpg,png and jpeg image types are allowed";
} 
else{
    try{
        $image = $_FILES['image']['tmp_name'];
        $img = file_get_contents($image);
        $stmt = $conn->prepare("INSERT INTO Comments2 (Name, Website,Tid, Email, Comment) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss",$sender, $page, $date, $mail, $text);
        $stmt->execute();
        $stmt = $conn->prepare("INSERT INTO Images (image) VALUES (?)");
        $stmt->bind_param("s",$img);
        $stmt->execute();
        $stmt->close();
        $conn->commit();
    }
    catch(\Throwable $e){
        $conn->rollback();
        echo "Couldn't insert.";
    }

    }
}
function InputProtection($input){
    return htmlspecialchars(strip_tags($input));
}
include "6.3.3.php";