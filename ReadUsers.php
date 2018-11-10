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

include_once 'lib/User.php';
include_once 'lib/DBHelper.php';


$dbh = new DBHelper();

$query = "SELECT lastName, firstName, emailAddress, password, groupID FROM  `User` WHERE groupID = 'Customer' ORDER BY lastname, firstName";

$result = $dbh->query($query);

$users = array();

while ($row = mysqli_fetch_array($result)){

    $cur = array();
    $user = User::fromRow($row);

    $cur["firstName"] = $user->fname;
    $cur["lastName"] = $user->lname;
    $cur["emailAddress"] = $user->email;

    array_push($users, $cur);
}

// set response code - 200 OK
http_response_code(200);

// make it json format
echo json_encode($users);



