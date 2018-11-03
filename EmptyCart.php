<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 10/27/18
 * Time: 6:45 PM
 */

include_once 'lib/ShoppingCart.php';

session_start();
$shoppingCart = $_SESSION[SHOPPING_CART];
$ref = $_SESSION['ref'];


if($shoppingCart != null)
{
    $shoppingCart->clear();
}

session_write_close();


$pathParts = explode("/", $ref);
$page = end($pathParts);
$hdr = "Location: $page";

header($hdr);