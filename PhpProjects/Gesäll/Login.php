<?php
include_once "Database.php";
function InputProtection($input){
    return htmlspecialchars(strip_tags($input));
  }
  session_start();
if (isset($_POST['login'])) {
    $email = InputProtection($_POST["email"]);
    $password = InputProtection($_POST["password"]);
    if (empty($email)) {
        echo '<script> alert("Email is required"); location.replace(document.referrer);</script>';
    }
    if (empty($password)) {
        echo '<script> alert("Password is required"); location.replace(document.referrer);</script>';
    }
  
    if (!empty($email) && !empty($password)) {
        $password = md5($password);
        $query = "SELECT * FROM Users WHERE email='$email' AND password='$password'";
        $results = mysqli_query($conn, $query);
        if($results == false){
          echo '<script> alert("Couldnt find account with that username"); location.replace(document.referrer);</script>';
        }
        else{
          if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $email;
            $_SESSION['success'] = "You are now logged in";
            include("Topics.php");
          }else {
              echo '<script> alert("Wrong username/password combination"); location.replace(document.referrer);</script>';
          }
        } 
    }
  }
  ?>