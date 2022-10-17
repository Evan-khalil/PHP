<?php
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = 'mejl@gmail.com';
$mail->Password = '****';
$mail->SMTPSecure = 'ssl';
$mail->SMTPOptions = array(
  'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
  )
);
  $file1Type = pathinfo($_FILES["file1"]["name"], PATHINFO_EXTENSION);
  $file1Name = basename($_FILES["file1"]["name"], $file1Type);
  $file2Type = pathinfo($_FILES["file2"]["name"], PATHINFO_EXTENSION);
  $file2Name = basename($_FILES["file2"]["name"], $file2Type);
  $mail->addAttachment('$file1Name$file1Type');
  $mail->addAttachment('$file2Name$file2Type');
  $mail->addAddress($_POST["to"]);
  $mail->addCC($_POST["cc"]);
  $mail->addBCC($_POST["bcc"]);
  $mail->Body = $_POST["message"] ."<br> Observera! Detta meddelande är sänt från ett formulär på Internet och avsändaren kan vara felaktig!";
  $mail->setFrom($_POST["from"]);
  $mail->Subject = $_POST["subject"];
  if(!$mail->send()) {
    echo "Meddelande kunde inte sändas! <br>";
    echo "Felmeddelande:" . $mail->ErrorInfo;
    }
     else {    
    echo "Meddelande skickats<br>";
    }  
?>