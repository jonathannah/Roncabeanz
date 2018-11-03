<?php

include_once 'lib/ShoppingCart.php';


$item = null;
if(isset($_POST['productId']) AND isset($_POST['count']) AND isset($_POST['amount']) AND isset($_POST['cost'])) {

    $item = new CartItem($_POST['productId'], $_POST['count'], $_POST['amount'], $_POST['cost']);

}

session_start();
$shoppingCart = $_SESSION[SHOPPING_CART];
if($shoppingCart != null AND $item != null){
    $shoppingCart->push($item);
}
session_write_close();

$prodCode=$_POST['productId'];
$hdr = "Location: ShowCoffee.php?productCode=$prodCode";

header($hdr);
?>
<!doctype html>
<html>
<body> add to cart</body>
</html>




