<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 11/9/18
 * Time: 10:45 PM
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once 'lib/Coffee.php';
include_once 'lib/DBHelper.php';


$dbh = new DBHelper();

$query = "SELECT country, name, price, units, description, productCode, thumbnail, viewCount FROM `Coffee` ORDER BY country, name ASC";

$result = $dbh->query($query);

$products = array();

while ($row = mysqli_fetch_array($result)){

    $curRet = array();
    $curProd = Coffee::fromRow($row);

    $curRet["country"] = $curProd->country;
    $curRet["name"] = $curProd->name;
    $curRet["price"] = $curProd->price;
    $curRet["units"] = $curProd->units;
    $curRet["productCode"] = $curProd->productCode;
    $curRet["viewCount"] = $curProd->viewCount;
    $curRet["description"] = $curProd->description;

    array_push($products, $curRet);
}

// set response code - 200 OK
http_response_code(200);

// make it json format
echo json_encode($products);



