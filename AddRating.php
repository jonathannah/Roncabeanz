<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/27/18
 * Time: 9:19 PM
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once 'lib/DBHelper.php';

$dbh = new DBHelper();

$user = $_POST["user"];
$rating = $_POST["rating"];
$comments = $_POST["comments"];
$productCode = $_POST["productCode"];
$domain = $_POST["domain"];
$safeComments = $dbh->escapeString($comments);

$query = "SELECT * FROM Roncabeanz.Ratings WHERE productCode = $productCode AND uid = '$user'";
$result = $dbh->query($query);

if($result->num_rows != 0){
    $query = "UPDATE Roncabeanz.Ratings SET rating = $rating, comments = '$safeComments' WHERE productCode = $productCode AND uid = '$user'";
}
else {
    $query = "INSERT INTO Roncabeanz.Ratings (productCode, uId, domain, rating, comments) VALUES ($productCode, '$user', '$domain', $rating, '$safeComments') ";
}

error_log($query);
$dbh->query($query);


$ret = array();
$ret["peroductCode"] = $productCode;
$ret["user"] = $user;
$ret["rating"] = $rating;
$ret["coments"] = $safeComments;

// set response code - 200 OK
http_response_code(200);

// make it json format
echo json_encode($ret);


