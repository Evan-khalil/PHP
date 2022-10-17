<?php
$fileType = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
$fileName = basename($_FILES["file"]["name"], $fileType); 
$image = $_FILES['file']['tmp_name'];
$img = file_get_contents($image);
$fileSize = $_FILES["file"]["size"];
define('MB', 1000000);

if (($_FILES['file']['size'] > 35*MB)){
    echo 'File size is big, try with a smaller file';
    die;
}

else{
    if($fileType == 'png' || $fileType == 'jpeg'){
        echo '<img src="data:image/'.$fileType.';base64,'.base64_encode($img).'" />';
    }
    else if($fileType == 'txt'){
        header('Content-type: text/plain');
        $fh = fopen($image, 'r');
        $data = fread($fh, $fileSize);
        echo $data;
    }
    else{
        echo "Name : $fileName <br>";
        echo "Type : $fileType <br>";
        echo "Size : $fileSize";
    }
}



