<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/17/18
 * Time: 4:23 PM
 */
include_once 'lib/DBHelper.php';
include_once 'lib/Coffee.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

error_log("MostPopularProducts");

$dbh = new DBHelper();

$query = "SELECT country, name, price, description, productCode, thumbnail, viewCount FROM `Coffee` ORDER BY country, name ASC";
$result = $dbh->query($query);


$paramCount = htmlspecialchars($_GET["maxProd"]);

$numItems = 0;

$query = "SELECT productCode, name, country, price, description, thumbnail, viewCount FROM `Coffee` WHERE 1 ORDER BY viewCount DESC";
$result = $dbh->query($query);

if(isset($paramCount) && strlen($paramCount) > 0) {
    $prodCount = $paramCount;
}
else{
    $prodCount = $result->num_rows;
}

$products = array();

while (($row = mysqli_fetch_array($result)) && $numItems < $prodCount) {
    $coffee = Coffee::fromRow($row);
    $curRet["name"] = $coffee->country." ".$coffee->name;
    $curRet["price"] = $coffee->price;
    $curRet["productCode"] = $coffee->productCode;
    $curRet["averageRating"] = $coffee->avgRating;
    $curRet["viewCount"] = $coffee->viewCount;
    $curRet["thumbnail"] = "http://roncabeanz.com/Roncabeanz/$coffee->thumbnail";
    $curRet["clickTo"] = "http://roncabeanz.com/Roncabeanz/ShowCoffee.php?productCode=$coffee->productCode";
    $curRet["description"] = $coffee->description;

    array_push($products, $curRet);
    ++$numItems;
}


// set response code - 200 OK
http_response_code(200);

// make it json format
echo json_encode($products);