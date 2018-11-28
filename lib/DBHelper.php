<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 10/31/18
 * Time: 4:08 PM
 */

define('DB_HOST',"localhost");
define('DB_USER',"roncabeanz");
define('DB_PASS',"C0ff33");
define('DB_NAME',"Roncabeanz");

class DBHelper
{
    private  $mySqliCon = null;

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Connect failed: %s\n" . $conn->error);

        if (!$conn->set_charset("utf8")) {
            printf("Error loading character set utf8: %s\n", $conn->error);
            exit();
        }

        $this->mySqliCon = $conn;
    }

    public function __destruct(){
        if($this->mySqliCon != null)
        {
            $this->mySqliCon->close();
            $this->mySqliCon = null;
        }
    }

    public function close()
    {
        if($this->mySqliCon != null)
        {
            $this->mySqliCon->close();
            $this->mySqliCon = null;
        }
    }

    function query($query)
    {
        if($this->mySqliCon == null)
        {
            die("DBHelper has not been initialized");
        }

        $result = $this->mySqliCon->query($query);
        if($result == null)
        {
            die("Error querying database: $query : $this->mySqliCon->error");
        }
        return$result;

    }

    public function escapeString($str){
        return $this->mySqliCon->real_escape_string($str);
    }

}



