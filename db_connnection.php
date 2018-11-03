<?php

header('Content-type: text/html; charset=UTF-8');

define('DB_HOST',"localhost");
define('DB_USER',"roncabeanz");
define('DB_PASS',"C0ff33");
define('DB_NAME',"Roncabeanz");

function OpenCon()
{

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Connect failed: %s\n". $conn -> error);

    if (!$conn->set_charset("utf8")) {
       printf("Error loading character set utf8: %s\n", $conn->error);
       exit();
    }
 
     return $conn;
}
 
function CloseCon($conn)
{
    $conn->close();
}

   
