<?php
include_once "6.2.3.php";
header('Content-type: text/html');
$html = file_get_contents("6.1.html");
$body =  session_id();
list($header, $body, $bottom)=explode('<!--===entries===-->' , $html , 3);
$toBeReplaced = array('---no---' , '---name---','---homepage---','---time---','---email---','---comment---');
$table = '';
$query = "SELECT * FROM Comments";
$result = mysqli_query($conn, $query);
if(empty($result)) {
    $query = "CREATE TABLE Comments (
              Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              Name varchar(255) NOT NULL,
              Website varchar(255) NOT NULL,
              Tid varchar(255) NOT NULL,
              Email varchar(255) NOT NULL,
              Comment varchar(255) NOT NULL
              )";
    $result = mysqli_query($conn, $query);
  }
if ($result) {
    while($row = mysqli_fetch_assoc($result)){
        $replacement = array($row["Id"],
        $row["Name"],
        $row["Website"],
        $row["Tid"],
        $row["Email"],
        $row["Comment"]);
        $table .= str_replace($toBeReplaced , $replacement  , $body );
    }
}
$body =  $table;
echo $header. $body . $bottom ;
$conn->close();







