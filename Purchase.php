<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 10/27/18
 * Time: 6:45 PM
 */

include_once 'lib/ShoppingCart.php';
include_once 'lib/DBHelper.php';
include_once 'lib/Cookies.php';
include_once 'lib/User.php';

error_log("start purchase");
session_start();
$shoppingCart = $_SESSION[SHOPPING_CART];
$ref = $_SESSION['ref'];

$user = $_COOKIE[COOKIE_EMAIL];
if($user == null || strlen($user) == 0)
{
    // check for market user
    $mktUsrToken = $_COOKIE[COOKIE_TAM_UTOKEN];
    error_log("User token: $mktUsrToken");
    if($mktUsrToken != null && strlen($mktUsrToken) > 0){
        // get user data and add to Roncabeanz
        $mktUser = User::fromToken($mktUsrToken);

        // note that user will only be added if not currently exist
        $mktUser->writeUser();

        // now, switch from mkt user to Roncabeanz user
        setcookie(COOKIE_EMAIL, $mktUser->email, time() + (86400 * 30), "/");
        setcookie(COOKIE_NAME, $mktUser->fname, time() + (86400 * 30), "/");
        $_COOKIE[COOKIE_TAM_UTOKEN] = "";
    }
}

//BEGIN;
//INSERT INTO Orders (customerId) VALUES ('jqp@gmail.com');
//INSERT INTO OrderItem(orderId, itemNumber, productCode, quantity, price) VALUES (LAST_INSERT_ID(), 1, 1, 1, 6.95);
//COMMIT;
?>
<!doctype html>
<html>
<body>



<?php
/**
 * Open the database connection
 */
function openPDO() {
    $conStr = sprintf("mysql:host=%s;dbname=%s", DB_HOST, DB_NAME);
    try {
        return new PDO($conStr, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

$pdo = openPDO();

try {
    error_log("start xact");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->beginTransaction();
    $insert = "INSERT INTO Orders (customerId) values ('$user');";
    error_log($insert);
    $pdo
        ->exec($insert);

    $count = 0;
    foreach($shoppingCart->getCartItems() as $item) {
        $insert = "INSERT into OrderItem (orderId, itemNumber, productCode, quantity, price)";
        $values = "values (LAST_INSERT_ID(), $count, $item->productId, 1, $item->cost);";
        error_log($insert." ".$values);

        $pdo->exec("$insert $values");
        ++$count;
    }

    $pdo->commit();
    $shoppingCart->clear();

} catch (Exception $e) {
    $pdo->rollBack();
    $pdo = null;
    echo "Failed: " . $e->getMessage();
    syslog(LOG_ERR, $e->getMessage());
}

$pathParts = explode("/", $ref);
$page = end($pathParts);
$hdr = "Location: $page";
session_write_close();
$pdo = null;
header($hdr);
?>
</body>
</html>

