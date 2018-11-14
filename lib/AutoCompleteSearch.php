<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/11/18
 * Time: 8:28 PM
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
include_once 'DBHelper.php';

$sType = htmlspecialchars($_GET["sType"]);
$sVal= utf8_decode($_GET["sVal"]);


class AutoCompleteSearch
{
    public static function nameSearch($initial)
    {
        $lInitial = mb_strtolower($initial);
        $query = "SELECT lastName, firstName, emailAddress FROM `User` WHERE LOWER(firstName) LIKE '$lInitial%' OR LOWER(lastName) LIKE '$lInitial%' ORDER BY lastName, firstName";
        $dbh = new DBHelper();

        $result = $dbh->query($query);

        $ret = array();

        while(($cur = mysqli_fetch_array($result)) != null){
            $curRet = array();
            $curRet["lastName"] = $cur["lastName"];
            $curRet["firstName"] = $cur["firstName"];
            $curRet["emailAddress"] = $cur["emailAddress"];
            array_push($ret, $curRet);
        }

        return $ret;
    }

    public static function productSearch($initial)
    {
        $lInitial = mb_strtolower($initial);
        $query = "SELECT productCode, name, country FROM `Coffee` WHERE LOWER(name) LIKE '$lInitial%' OR LOWER(country) LIKE '$lInitial%' ORDER BY country, name";
        $dbh = new DBHelper();

        $result = $dbh->query($query);

        $ret = array();

        while(($cur = mysqli_fetch_array($result)) != null){
            $curRet = array();
            $curRet["productCode"] = $cur["productCode"];
            $curRet["country"] = $cur["country"];
            $curRet["name"] = $cur["name"];
            array_push($ret, $curRet);
        }

        return $ret;
    }

}

$ret = array();

if(strcasecmp($sType, 'user') == 0){
    $ret = AutoCompleteSearch::nameSearch($sVal);

}
else if(strcasecmp($sType, 'product') == 0){
    $ret = AutoCompleteSearch::productSearch($sVal);

}
else{
    $ret[0] = "Invalid search type";
}

// set response code - 200 OK
http_response_code(200);

// make it json format
echo json_encode($ret);
