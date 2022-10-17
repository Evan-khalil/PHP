<?php
include_once "Database.php";
$email = $_POST["email"];
$query = "SELECT * FROM Users WHERE email='$email'";
$result = mysqli_query($conn, $query);
if(empty($result)) {
    $query = "CREATE TABLE Users (
              Id int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              name varchar(255) NOT NULL,
              email varchar(255) NOT NULL,
              password varchar(255) NOT NULL
              )";
              $res = mysqli_query($conn, $query);
  }
  if (mysqli_num_rows($result) >0) {
    echo '<script> alert("There is already a registered username with the emailaddress you provided."); location.replace(document.referrer);</script>';
  }
  else{
    session_start();
function InputProtection($input){
  return htmlspecialchars(strip_tags($input));
}
if (isset($_POST['Submit'])) {
  $name = InputProtection($_POST["name"]);
  $email = InputProtection($_POST["email"]);
  $password = InputProtection($_POST["password"]);
  if (empty($name)) { 
    echo '<script> alert("Name is required"); location.replace(document.referrer);</script>';
      }
  if (empty($email)) {
    echo '<script> alert("Email is required"); location.replace(document.referrer);</script>';
    }
  if (empty($password)) { 
    echo '<script> alert("Password is required"); location.replace(document.referrer);</script>';
 }
  if (!empty($name) && !empty($email) && !empty($password)) {
    try{
      $Encpassword = md5($password);
      $stmt = $conn->prepare("INSERT INTO Users (name, email, password) VALUES (?, ?, ?)");
      $stmt->bind_param("sss",$name, $email, $Encpassword);
      $stmt->execute();
      $stmt->close();
      $conn->commit();
      $_SESSION['username'] = $email;
      include("Topics.php");
    }
    catch(\Throwable $e){
      $conn->rollback();
      echo "Couldn't insert.";
    }
  }
}
  }
