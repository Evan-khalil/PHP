<?php
include_once "6.3.2.php";
header('Content-type: text/html');
$html = file_get_contents("6.1.html");
$body =  session_id();
list($header, $body, $bottom)=explode('<!--===entries===-->' , $html , 3);
$toBeReplaced = array('---no---' , '---name---','---image_src---','---homepage---','---time---','---email---','---comment---');
$table = '';
$query = "SELECT * FROM Comments2";
$result = mysqli_query($conn, $query);
if(empty($result)) {
    $query = "CREATE TABLE Comments2 (
              Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              Name varchar(255) NOT NULL,
              Website varchar(255) NOT NULL,
              Tid varchar(255) NOT NULL,
              Email varchar(255) NOT NULL,
              Comment varchar(255) NOT NULL
              )";
              $res = mysqli_query($conn, $query);

              $sql = "CREATE TABLE Images (
                id int(6) NOT NULL AUTO_INCREMENT,
                image MEDIUMBLOB NOT NULL,
                PRIMARY KEY (id)
              )";
              $resultat = mysqli_query($conn, $sql);
  }
if ($result) {
    while($row = mysqli_fetch_assoc($result)){
        $sql = "SELECT image FROM Images where id = $row[Id]";       
        $resultat = mysqli_query($conn, $sql);
        if($resultat){
            while ($rows = mysqli_fetch_assoc($resultat)){
                $replacement =array($row["Id"],$row["Name"],'data:image/jpeg;base64,'.base64_encode( $rows['image'] ).'',
                $row["Website"],$row["Tid"],$row["Email"],$row["Comment"]);
                $table .= str_replace($toBeReplaced , $replacement  , $body );
            }
        }
    }
}
$body =  $table;
echo $header. $body . $bottom ;
$conn->close();