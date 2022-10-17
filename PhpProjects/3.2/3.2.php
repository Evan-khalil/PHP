<?php
$html = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/3.2/3.2.html");
$body =  session_id();
list($header, $body, $bottom)=explode('<!--===xxx===-->' , $html , 3);
echo $header . generateTable($body) . $bottom ;
function generateTable($body){  
    $toBeReplaced = array('---name---' , '---value---');
    $table = '';
    foreach (getenv() as $key => $value) {
        $replacement = array(htmlentities(rtrim($key,
            "\n\r")), htmlentities(rtrim($value, "\n\r")));
        $table .= str_replace($toBeReplaced , $replacement , $body );
    }
    foreach ($_SERVER as $key => $value) {
        $replacement = array(htmlentities(rtrim($key,
            "\n\r")), htmlentities(rtrim($value, "\n\r")));
        $table .= str_replace($toBeReplaced , $replacement , $body );
    }
    return $table;
}

?>