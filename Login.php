<?php
/**
 * Created by PhpStorm.
 * User: dronca
 * Date: 10/20/18
 * Time: 8:51 PM
 */

include 'lib/DBHelper.php';
include 'lib/Cookies.php';

session_start();

$dbh = new DBHelper();

$msg = "hmmm!";

if(isset($_POST['email']) AND isset($_POST['psw'])) {
    $query = "SELECT firstName, lastName, emailAddress, groupID, password FROM Roncabeanz.User WHERE emailAddress='{$_POST['email']}' ";
    $result = $dbh->query($query);

    $fields = mysqli_fetch_fields($result);

    $row = mysqli_fetch_array($result);
    $pwd = $row[$fields[4]->name];


    if ($pwd == $_POST['psw']) {
        setcookie(COOKIE_EMAIL, $row[$fields[2]->name], time() + (86400 * 30), "/");
        setcookie(COOKIE_NAME, $row[$fields[0]->name], time() + (86400 * 30), "/");
         //header("Refresh:$secondsWait");
        $msg = "Login successful";
    } else {
        $msg = "The email '{$_POST['email']}' or password '{$_POST['psw']}'' you entered is not valid ({$pwd})";
    }
}

    $ref = $_SESSION['ref'];
    $pathParts = explode("/", $ref);
    $page = end($pathParts);
    $hdr = "Location: $page";

    header($hdr);
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>

    <script language="JavaScript">
        if($page != null) {
            var time = null

            function move() {

                window.location = "<?php echo $page ?>";

            }
        }
        //-->
    </script>
</head>
<body onload="timer=setTimeout('move()',1)">

    <?php echo($page); ?>
    <?php echo($msg); ?>
</body>
</html>

<?php
//Step 4
$dbh->close();
?>

