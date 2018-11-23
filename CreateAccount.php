<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 10/20/18
 * Time: 8:51 PM
 */

include_once 'lib/DBHelper.php';
include_once 'lib/Cookies.php';
include_once 'lib/User.php';

session_start();

$msg = "hmmm!";

if(isset($_POST['email']) AND isset($_POST['psw'])) {
    $user = new User();
    $user->fname = $_POST['firstName'];
    $user->lname = $_POST['lastName'];
    $user->email = $_POST['email'];
    $user->password = $_POST['psw'];
    $cpwd = $_POST['psw_c'];
    $user->address = $_POST['addr'];
    $user->apt = $_POST['apt'];
    $user->city = $_POST['city'];
    $user->state = $_POST['state'];
    $user->zipCode = $_POST['zip'];
    $user->homePhone = $_POST['phone'];
    $user->cellPhone = $_POST['cellPhone'];

    $ref = $_SESSION['ref'];
    $pathParts = explode("/", $ref);
    $page = end($pathParts);


    if($user->password == $cpwd)
    {
        $user->writeUser();
        $hdr = "Location: $page";
        header($hdr);
    }
    else if($pwd != $cpwd)
    {
        $msg = "Passwords do not match";
    }
    else
    {
        $msg = "Account already exists";
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>


</head>
<body >

    <?php echo($page); ?>
    <?php echo($msg); ?>
</body>
</html>

<?php
//Step 4
$dbh->close();
?>

